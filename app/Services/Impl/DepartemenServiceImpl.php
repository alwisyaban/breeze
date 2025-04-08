<?php

namespace App\Services\Impl;

use App\Models\Departemen;
use App\Services\DepartemenService;

class DepartemenServiceImpl implements DepartemenService
{
    public function saveDepartemen(array $data): void
    {
        Departemen::create([
            'departemen' => $data['departemen']
        ]);
    }

    public function getDepertemen(): array
    {
        return Departemen::query()->get()->toArray();
    }

    public function updateDepartemen(string $id, array $data): void
    {
        $departemen = Departemen::findOrFail($id);
        $departemen->update($data);
    }

    public function removeDepartemen($id)
    {
        $departemen = Departemen::query()->find($id);
        if ($departemen != null) {
            $departemen->delete();
        }
    }
}
