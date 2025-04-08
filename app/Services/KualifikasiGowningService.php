<?php

namespace App\Services;

interface KualifikasiGowningService
{
    public function saveKualifikasiGwoning(array $data): void;

    public function getKualifikasiGowning(): array;

    public function updateKualifikasiGowning(string $id, $data): void;

    public function removeKualifikasiGowning(string $id);
}
