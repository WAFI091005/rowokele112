<?php

namespace App\Services;

use Kreait\Firebase\Contract\Database;

/**
 * Pusat akses ke Firebase Realtime Database.
 * Semua komponen Livewire cukup panggil service ini.
 */
class FirebaseService
{
    protected Database $db;

    public function __construct()
    {
        $this->db = app('firebase.database');
    }

    /** Ambil semua item dari sebuah node, lengkap dengan id-nya, terbaru di atas. */
    public function all(string $path): array
    {
        $data = $this->db->getReference($path)->getValue() ?? [];

        return collect($data)
            ->map(fn ($item, $id) => array_merge(['id' => $id], (array) $item))
            ->sortByDesc('created_at')
            ->values()
            ->toArray();
    }

    /** Ambil satu item berdasarkan id. */
    public function find(string $path, string $id): ?array
    {
        $item = $this->db->getReference("$path/$id")->getValue();

        return $item ? array_merge(['id' => $id], (array) $item) : null;
    }

    /** Ambil node settings (info desa, sosmed, dll). */
    public function settings(): array
    {
        return (array) ($this->db->getReference('settings')->getValue() ?? []);
    }

    /** Tambah item baru (return id-nya). */
    public function create(string $path, array $data): string
    {
        $data['created_at'] = now()->timestamp;

        return $this->db->getReference($path)->push($data)->getKey();
    }

    /** Update item. */
    public function update(string $path, string $id, array $data): void
    {
        $this->db->getReference("$path/$id")->update($data);
    }

    /** Hapus item. */
    public function delete(string $path, string $id): void
    {
        $this->db->getReference("$path/$id")->remove();
    }
}
