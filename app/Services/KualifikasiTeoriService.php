<?php

namespace App\Services;

interface KualifikasiTeoriService
{
    public function saveKualifikasiTeori(array $data): void;

    public function getKualifikasiTeori(): array;

    public function removeKualifikasiTeori($id);

    public function updateKualifikasiTeori(string $id, array $data);
}
