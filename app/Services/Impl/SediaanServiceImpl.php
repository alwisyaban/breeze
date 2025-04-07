<?php

namespace App\Services\Impl;

use App\Models\Sediaan;
use App\Services\SediaanService;

class SediaanServiceImpl implements SediaanService
{
    public function saveSediaan(array $data): void
    {
        Sediaan::create([
            'sediaan' => $data['sediaan']
        ]);
    }

    public function getSediaan(): array
    {
        return Sediaan::query()->get()->toArray();
    }

    public function removeSediaan($id)
    {
        $sediaan = Sediaan::query()->find($id);
        if ($sediaan != null) {
            $sediaan->delete();
        }
    }

    public function updateSediaan(string $id, array $data): void
    {
        $sediaan = Sediaan::findOrFail($id);
        $sediaan->update($data);
    }
}
