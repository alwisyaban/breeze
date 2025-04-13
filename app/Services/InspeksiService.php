<?php

namespace App\Services;

interface InspeksiService
{
    public function saveInspeksi(array $data): void;

    public function getInspeksi(): array;

    public function removeInspeksi($id);

    public function updateInspeksi(string $id, array $data);
}
