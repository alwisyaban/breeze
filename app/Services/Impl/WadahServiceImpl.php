<?php

namespace App\Services\Impl;

use App\Models\Wadah;
use App\Services\WadanService;

class WadahServiceImpl implements WadanService
{
    public function getWadah(): array
    {
        return Wadah::query()->get()->toArray();
    }

    public function saveWadah(array $data): void
    {
        Wadah::create([
            'wadah' => $data['wadah']
        ]);
    }

    public function updateWadah($id, array $data)
    {
        $wadah = Wadah::findOrFail($id);
        $wadah->update($data);
    }

    public function removeWadah($id)
    {
        $wadah = Wadah::query()->find($id);
        if ($wadah != null) {
            $wadah->delete();
        }
    }
}
