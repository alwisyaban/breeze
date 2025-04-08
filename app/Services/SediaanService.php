<?php

namespace App\Services;

interface SediaanService
{
    public function saveSediaan(array $data): void;
    public function getSediaan(): array;
    public function removeSediaan($id);
    public function updateSediaan(string $id, array $data): void;
}
