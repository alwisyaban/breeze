<?php

namespace App\Services;

interface KaryawanService
{
    public function saveKaryawan(array $data): void;

    public function getKaryawan(): array;

    public function updateKaryawan(string $id, array $data): void;

    public function removeKaryawan(string $id);
}
