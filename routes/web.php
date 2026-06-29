<?php

use App\Livewire\Home;
use App\Livewire\ProkerList;
use App\Livewire\KegiatanList; 
use App\Livewire\AnggotaList;
use App\Livewire\BeritaList;
use App\Livewire\Galeri;
use App\Livewire\Auth\Login; // Memanggil Class Login manual
use App\Livewire\Admin\Dashboard as AdminDashboard;
use Illuminate\Support\Facades\Route;

// Guest / Public Routes
Route::get('/', Home::class);
Route::get('/proker', ProkerList::class);
Route::get('/kegiatan', KegiatanList::class); 
Route::get('/anggota', AnggotaList::class);
Route::get('/berita', BeritaList::class);
Route::get('/galeri', Galeri::class);
Route::get('/login', Login::class)->name('login');

// Protected Routes (Hanya Admin yang bisa masuk)
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class);
});