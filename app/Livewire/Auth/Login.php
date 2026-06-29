<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public string $username = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 1. Konek ke Firebase
        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS', 'storage/app/firebase/firebase_credentials.json')));
        $db = $factory->withDatabaseUri(env('FIREBASE_DATABASE_URL'))->createDatabase();

        // 2. Ambil data admin dari node 'admin'
        $adminData = $db->getReference('admin')->getValue();

        // 3. Validasi Kecocokan data input dengan data Firebase
        if ($adminData && $this->username === ($adminData['username'] ?? null) && $this->password === ($adminData['password'] ?? null)) {
            
            // Set session tanda sukses login
            Session::put('admin_logged_in', true);
            Session::put('admin_username', $this->username);

            session()->flash('success', 'Selamat datang kembali, Admin!');
            return $this->redirect('/admin/dashboard', navigate: true);
        }

        // Jika salah, kirim error flash
        session()->flash('error', 'Username atau password admin salah!');
    }

    #[Layout('layouts.app')] // Menyesuaikan dengan layout utama web kamu
    public function render()
    {
        return view('livewire.auth.login');
    }
}