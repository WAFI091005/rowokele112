<?php

namespace App\Livewire; // FIX: Cukup satu kali App saja

use Livewire\Component;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class AnggotaList extends Component
{
    public array $anggota = [];

    public function mount(FirebaseService $fb)
    {
        // Mengambil seluruh node data di dalam 'anggota' dari Firebase
        $rawData = $fb->all('anggota') ?? [];
        $processedAnggota = [];

        foreach ($rawData as $item) {
            // Validasi: Pastikan record minimal memiliki field 'nama' agar aman dari error null
            if (isset($item['nama'])) {
                $processedAnggota[] = [
                    'id'      => $item['id'] ?? null, 
                    'nama'    => $item['nama'],
                    'jabatan' => $item['jabatan'] ?? 'Anggota',
                    'jurusan' => $item['jurusan'] ?? '-',
                    'nim'     => $item['nim'] ?? '-',
                    
                    // Pemetaan field gambar sesuai murni dengan yang ada di database Firebase
                    'foto'    => $item['foto'] ?? null,
                ];
            }
        }

        $this->anggota = $processedAnggota;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.anggota-list');
    }
}