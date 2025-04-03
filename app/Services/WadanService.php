<?php

namespace App\Services;

interface WadanService
{
    public function saveWadah(array $data): void;
    public function getWadah(): array;
    public function removeWadah($id);
    public function updateWadah($id, array $data);
}
