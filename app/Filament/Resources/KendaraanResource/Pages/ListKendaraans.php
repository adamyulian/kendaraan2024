<?php

namespace App\Filament\Resources\KendaraanResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KendaraanResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListKendaraans extends ListRecords
{
    protected static string $resource = KendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make('Semua')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->name === 'admin') {
                        return $query;
                    }
                    // Non-admin users can only view their own component
                    // return
                        $lokasi = Auth::user()->lokasi;
                        $query->where('lokasi', $lokasi);
                    }),
            'Sudah' => Tab::make('Sudah Datang')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->name === 'admin') {
                        return $query->whereNot('tgl_masuk', NULL);
                    }
                    // Non-admin users can only view their own component
                    // return
                        $lokasi = Auth::user()->lokasi;
                        $query->where('lokasi', $lokasi)->whereNot('tgl_masuk', NULL);
                    }),
            'Belum' => Tab::make('Belum Datang')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->name === 'admin') {
                        return $query->where('tgl_masuk', NULL);
                    }
                    // Non-admin users can only view their own component
                    // return
                        $lokasi = Auth::user()->lokasi;
                        $query->where('lokasi', $lokasi)->where('tgl_masuk', NULL);;
                    }),
        ];
    }
}
