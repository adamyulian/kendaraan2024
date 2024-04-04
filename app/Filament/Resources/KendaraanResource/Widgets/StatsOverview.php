<?php

namespace App\Filament\Resources\KendaraanResource\Widgets;

use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();
        $user = auth()->user();

        if ($user && ($user->name === 'admin')) {
            // Admin gets all data
            return [
                    Stat::make('Total Kendaraan', Kendaraan::count()),
                    Stat::make('Total Sudah Datang', Kendaraan::whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Total Belum Datang', Kendaraan::where('tgl_masuk', NULL)->count()),
                    Stat::make('Total Balaikota', Kendaraan::where('lokasi', 'Balaikota Dalam')->count()),
                    Stat::make('Total Jimerto', Kendaraan::where('lokasi', 'Jimerto')->count()),
                    Stat::make('Total Siola Lantai 7', Kendaraan::where('lokasi', 'Siola Lantai 7')->count()),
                    Stat::make('Total Siola Lantai 8', Kendaraan::where('lokasi', 'Siola Lantai 8')->count()),
                    Stat::make('Total Convention Hall', Kendaraan::where('lokasi', 'Convention Hall')->count())
            ];
        }
        else {
            $lokasi = $user->lokasi;

                return [
                    Stat::make('Total Sudah Datang', Kendaraan::where('lokasi', $lokasi)->whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Total Belum Datang', Kendaraan::where('lokasi', $lokasi)->where('tgl_masuk', NULL)->count()),
                // Stat::make('Sisa Target Survey', Target::where('user_id', $userId)->where('user_id',0)->count()),
            ];
        }
    }
}
