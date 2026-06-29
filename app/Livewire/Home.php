<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class Home extends Component
{
    public array $settings = [];
    public array $prokers = [];
    public array $berita = [];
    public array $kegiatan = [];
    public array $galeri = []; 
    public array $stats = [];

    public function mount(FirebaseService $fb)
    {
        // 1. Ambil Pengaturan Umum Desa
        $this->settings = $fb->settings();

        // 2. Tarik Semua Data dari Firebase
        $rawProkers = $fb->all('prokers') ?? [];
        $rawBerita   = $fb->all('berita') ?? [];
        $rawKegiatan = $fb->all('kegiatan') ?? [];
        $anggota  = $fb->all('anggota') ?? [];
        $rawGaleri   = $fb->all('galeri') ?? []; 

        // === PROSES SORTING UNTUK MEMASTIKAN YANG TERBARU DI ATAS ===

        // Urutkan Galeri berdasarkan created_at terbaru
        usort($rawGaleri, function ($a, $b) {
            $tglA = $a['created_at'] ?? 0;
            $tglB = $b['created_at'] ?? 0;
            return $tglB <=> $tglA;
        });

        // Urutkan Berita berdasarkan tanggal/created_at terbaru
        usort($rawBerita, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : ($a['created_at'] ?? 0);
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : ($b['created_at'] ?? 0);
            return $tglB <=> $tglA;
        });

        // Urutkan Kegiatan berdasarkan tanggal terbaru
        usort($rawKegiatan, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : 0;
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : 0;
            return $tglB <=> $tglA;
        });

        // Map data prokers agar key 'thumbnail' dialias menjadi 'gambar' untuk template
        $prokers = array_map(function($item) {
            $item['gambar'] = $item['thumbnail'] ?? null;
            return $item;
        }, $rawProkers);

        // Map data galeri agar key gambar diduplikat ke 'image_url' demi kelancaran template 3D
        $mappedGaleri = array_map(function($item) {
            $item['image_url'] = $item['image_url'] ?? ($item['thumbnail'] ?? ($item['url'] ?? null));
            return $item;
        }, $rawGaleri);

        // 3. Potong Data Sesuai Kebutuhan Tampilan Home Screen
        $this->prokers  = array_slice($prokers, 0, 3);  
        $this->berita   = array_slice($rawBerita, 0, 3);   
        $this->kegiatan = array_slice($rawKegiatan, 0, 6); 
        
        // UBAH: Mengambil 6 data galeri (bukan 7)
        $this->galeri   = array_slice($mappedGaleri, 0, 6);   

        // 4. Hitung Statistik untuk Counter Box
        $this->stats = [
            'proker'  => count($rawProkers),
            'anggota' => count($anggota),
            'berita'  => count($rawBerita),
            'galeri'  => count($rawGaleri),
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.home');
    }
}