<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    use WithFileUploads;

    public string $activeTab = 'settings';
    public array $state = [];
    public $newImage;
    public ?string $editKey = null;

    // Menampung list data dari Firebase
    public array $settings = [];
    public array $kegiatan = [];
    public array $prokers = [];
    public array $anggota = [];
    public array $berita = [];
    public array $galeri = [];

    public function mount(FirebaseService $fb)
    {
        $this->refreshData($fb);
        $this->switchTab($this->activeTab);
    }

    public function refreshData(FirebaseService $fb)
    {
        $this->settings = $fb->settings() ?? [];
        $this->kegiatan = $fb->all('kegiatan') ?? [];
        $this->prokers  = $fb->all('prokers') ?? [];
        $this->anggota  = $fb->all('anggota') ?? [];
        $this->berita   = $fb->all('berita') ?? [];
        $this->galeri   = $fb->all('galeri') ?? [];
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->editKey = null;
        $this->newImage = null;
        
        if ($tab === 'settings') {
            $this->state = $this->settings;
        } else {
            $this->state = [
                'status' => 'rencana'
            ];
        }
    }

    public function saveSettings(FirebaseService $fb)
    {
        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS', 'storage/app/firebase/firebase_credentials.json')));
        $db = $factory->withDatabaseUri(env('FIREBASE_DATABASE_URL'))->createDatabase();
        $db->getReference('settings')->set($this->state);

        session()->flash('success', 'Pengaturan umum desa berhasil diperbarui!');
        $this->refreshData($fb);
    }

    public function startEdit($id)
    {
        $this->editKey = $id;
        $currentItems = $this->{$this->activeTab} ?? [];
        
        foreach ($currentItems as $item) {
            if (($item['id'] ?? null) === $id) {
                $this->state = $item;
                
                if ($this->activeTab === 'anggota') {
                    $this->state['judul'] = $item['nama'] ?? '';
                } elseif ($this->activeTab === 'berita') {
                    $this->state['judul'] = $item['judul'] ?? '';
                    $this->state['deskripsi'] = $item['isi'] ?? '';
                } elseif ($this->activeTab === 'kegiatan') {
                    $this->state['judul'] = $item['judul'] ?? ($item['title'] ?? '');
                } else {
                    $this->state['judul'] = $item['judul'] ?? '';
                }
                break;
            }
        }
    }

    public function cancelEdit()
    {
        $this->editKey = null;
        $this->state = ['status' => 'rencana'];
        $this->newImage = null;
    }

    public function saveData(FirebaseService $fb)
    {
        $path = $this->activeTab;
        $payload = [];
        
        // 1. Proses upload gambar agar disimpan dengan opsi disk 'public' secara eksplisit
        $urlGambar = null;
        if ($this->newImage) {
            $filename = time() . '_' . $this->newImage->getClientOriginalName();
            
            // Menggunakan parameter ke-2 untuk nama file, dan parameter ke-3 'public' sebagai nama disk storage
            $this->newImage->storeAs('uploads', $filename, 'public');
            
            // Menghasilkan URL absolut public resmi (misal: http://127.0.0.1:8000/storage/uploads/namafile.jpg)
            $urlGambar = asset('storage/uploads/' . $filename);
        }

        // 2. Mapping data mentah $this->state ke struktur asli database JSON
        if ($path === 'prokers') {
            $payload = [
                'judul'       => $this->state['judul'] ?? '',
                'deskripsi'   => $this->state['deskripsi'] ?? '',
                'status'      => $this->state['status'] ?? 'rencana',
                'tanggal'     => $this->state['tanggal'] ?? '',
                'thumbnail'   => $urlGambar ?? ($this->state['thumbnail'] ?? ''), // Menambahkan field gambar/thumbnail untuk proker
                'created_at'  => $this->state['created_at'] ?? time(),
            ];
        } elseif ($path === 'kegiatan') {
            $payload = [
                'judul'     => $this->state['judul'] ?? '',
                'title'     => $this->state['judul'] ?? '', 
                'deskripsi' => $this->state['deskripsi'] ?? '',
                'status'    => $this->state['status'] ?? 'rencana',
                'tanggal'   => $this->state['tanggal'] ?? '',
                'img'       => $urlGambar ?? ($this->state['img'] ?? 'https://images.unsplash.com/photo-1511578314322-379afb476865'),
            ];
        } elseif ($path === 'anggota') {
            $payload = [
                'nama'        => $this->state['judul'] ?? '',
                'nim'         => $this->state['nim'] ?? '',
                'jabatan'     => $this->state['jabatan'] ?? '',
                'jurusan'     => $this->state['jurusan'] ?? '',
                'foto'        => $urlGambar ?? ($this->state['foto'] ?? ''),
                'created_at'  => $this->state['created_at'] ?? time(),
            ];
        } elseif ($path === 'berita') {
            $payload = [
                'judul'       => $this->state['judul'] ?? '',
                'isi'         => $this->state['deskripsi'] ?? '', 
                'tanggal'     => $this->state['tanggal'] ?? '',
                'thumbnail'   => $urlGambar ?? ($this->state['thumbnail'] ?? ''),
                'created_at'  => $this->state['created_at'] ?? time(),
            ];
        } elseif ($path === 'galeri') {
            $payload = [
                'caption'     => $this->state['caption'] ?? '',
                'image_url'   => $urlGambar ?? ($this->state['image_url'] ?? ''),
                'created_at'  => $this->state['created_at'] ?? time(),
            ];
        }

        // 3. Simpan Perubahan Menggunakan Firebase
        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS', 'storage/app/firebase/firebase_credentials.json')));
        $db = $factory->withDatabaseUri(env('FIREBASE_DATABASE_URL'))->createDatabase();

        if ($this->editKey !== null && $this->editKey !== '') {
            $db->getReference($path . '/' . $this->editKey)->set($payload);
        } else {
            $db->getReference($path)->push($payload);
        }

        session()->flash('success', 'Data Master ' . ucfirst($path) . ' Berhasil Diperbarui!');
        $this->cancelEdit();
        $this->refreshData($fb);
    }

    public function deleteData(FirebaseService $fb, $path, $key)
    {
        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS', 'storage/app/firebase/firebase_credentials.json')));
        $db = $factory->withDatabaseUri(env('FIREBASE_DATABASE_URL'))->createDatabase();
        
        $db->getReference($path . '/' . $key)->remove();

        session()->flash('success', 'Data berhasil dihapus dari sistem Cloud!');
        $this->refreshData($fb);
    }

    /**
     * Fitur Keluar (Logout) Sistem Admin
     */
    public function logout()
    {
        // Hapus penanda session login admin
        session()->forget(['admin_logged_in', 'admin_username']);
        session()->flush();

        session()->flash('success', 'Anda telah berhasil keluar dari sistem.');
        
        // redirect ke /login dengan fitur SPA (Single Page Application) Livewire
        return $this->redirect('/login', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}