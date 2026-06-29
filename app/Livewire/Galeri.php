<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout; // 1. Import class Layout-nya di sini

class Galeri extends Component
{
    public array $galeri = [];

    public function mount(FirebaseService $fb)
    {
        $this->galeri = $fb->all('galeri');
    }

    #[Layout('layouts.app')] // 2. Pasang attribute ini tepat di atas render()
    public function render()
    {
        // 3. Hapus ->layout(...) di bawah ini, biarkan view() biasa aja
        return view('livewire.galeri');
    }
}