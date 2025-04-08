<?php

namespace App\Services;

interface DepartemenService
{
    public function saveDepartemen(array $data): void;

    public function getDepertemen(): array;

    public function removeDepartemen($id);

    public function updateDepartemen(string $id, array $data): void;
}
