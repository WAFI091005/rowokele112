<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class BeritaList extends Component
{
    public array $berita = [];

    public function mount(FirebaseService $fb)
    {
        $rawBerita = $fb->all('berita') ?? [];
        
        // Memformat data dari Firebase agar sesuai dengan properti yang dipanggil di Blade
        $this->berita = array_map(function($item) {
            // 1. Format tanggal untuk Alpine.js
            if (!empty($item['tanggal'])) {
                $item['tanggal_formatted'] = date('d M Y', strtotime($item['tanggal']));
            } else {
                $item['tanggal_formatted'] = '-';
            }

            // 2. Hubungkan 'thumbnail' dari Firebase ke properti 'gambar' di Blade
            $item['gambar'] = $item['thumbnail'] ?? null;

            // 3. Hubungkan 'isi' dari Firebase ke properti 'deskripsi' di Blade
            $item['deskripsi'] = $item['isi'] ?? 'Deskripsi berita belum tersedia.';

            return $item;
        }, $rawBerita);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.berita-list');
    }
}