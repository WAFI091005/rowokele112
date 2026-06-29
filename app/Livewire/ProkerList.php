<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class ProkerList extends Component
{
    public array $prokers = [];
    public string $filter = 'semua';
    public $selectedProker = null;
    public $showModal = false;

    public function mount(FirebaseService $fb)
    {
        $rawProkers = $fb->all('prokers') ?? [];
        
        // Memetakan data agar key 'thumbnail' bisa dibaca sebagai 'gambar' di Blade
        $this->prokers = array_map(function($item) {
            $item['gambar'] = $item['thumbnail'] ?? null;
            // Pastikan status ada
            if (!isset($item['status']) || empty($item['status'])) {
                $item['status'] = $this->determineStatus($item['tanggal'] ?? null);
            }
            return $item;
        }, $rawProkers);
        
        // Urutkan proker berdasarkan tanggal terbaru
        usort($this->prokers, function ($a, $b) {
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
            return array_values($this->prokers);
        }

        $filtered = array_filter($this->prokers, function ($item) {
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
            $this->selectedProker = $list[$index];
            $this->showModal = true;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedProker = null;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.proker-list', [
            'list' => $this->list
        ]);
    }
}