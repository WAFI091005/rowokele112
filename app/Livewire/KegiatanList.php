<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class KegiatanList extends Component
{
    public string $filter = 'semua';
    public array $allKegiatan = [];
    public array $statusFilters = [
        'semua' => 'Semua Kegiatan',
        'rencana' => 'Rencana',
        'berjalan' => 'Berjalan',
        'selesai' => 'Selesai'
    ];

    // Untuk modal
    public $selectedKegiatan = null;
    public $showModal = false;

    public function mount(FirebaseService $fb)
    {
        $this->allKegiatan = $fb->all('kegiatan') ?? [];

        // Pastikan semua data memiliki status
        foreach ($this->allKegiatan as &$kegiatan) {
            if (!isset($kegiatan['status']) || empty($kegiatan['status'])) {
                $kegiatan['status'] = $this->determineStatus($kegiatan['tanggal'] ?? null);
            }
        }

        // Urutkan berdasarkan tanggal terbaru
        usort($this->allKegiatan, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : 0;
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : 0;
            return $tglB <=> $tglA;
        });
    }

    private function determineStatus($tanggal)
    {
        if (!$tanggal) return 'rencana';
        
        $today = strtotime(date('Y-m-d'));
        $tglEvent = strtotime($tanggal);
        
        if ($tglEvent < $today) return 'selesai';
        if ($tglEvent == $today) return 'berjalan';
        return 'rencana';
    }

    public function getListProperty()
    {
        if ($this->filter === 'semua') {
            return array_values($this->allKegiatan);
        }

        $filtered = array_filter($this->allKegiatan, function ($item) {
            $status = strtolower($item['status'] ?? 'rencana');
            return $status === $this->filter;
        });

        return array_values($filtered);
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function resetFilter()
    {
        $this->filter = 'semua';
    }

    public function openModal($index)
    {
        $list = $this->list;
        if (isset($list[$index])) {
            $this->selectedKegiatan = $list[$index];
            $this->showModal = true;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedKegiatan = null;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.kegiatan-list', [
            'list' => $this->list
        ]);
    }
}