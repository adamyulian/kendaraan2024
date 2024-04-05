<?php

namespace App\Filament\Resources\KendaraanResource\Widgets;

use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $userId = Auth::id();
        $user = auth()->user();

        if ($user && ($user->name === 'admin')) {
            // Admin gets all data
            return [
                    // Stat::make('Total Kendaraan', Kendaraan::count())->color('primary'),
                    Stat::make('Total Sudah Datang', Kendaraan::whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Total Belum Datang', Kendaraan::where('tgl_masuk', NULL)->count()),
                    Stat::make('Sudah Datang Balaikota', Kendaraan::where('lokasi', 'Balaikota Dalam')->whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Belum Datang Balaikota', Kendaraan::where('lokasi', 'Balaikota Dalam')->where('tgl_masuk', NULL)->count()),
                    Stat::make('Sudah Datang Jimerto', Kendaraan::where('lokasi', 'Jimerto')->whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Belum Datang Jimerto', Kendaraan::where('lokasi', 'Jimerto')->where('tgl_masuk', NULL)->count()),
                    Stat::make('Sudah Datang Lantai 7', Kendaraan::where('lokasi', 'Siola Lantai 7')->whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Belum Datang Siola Lantai 7', Kendaraan::where('lokasi', 'Siola Lantai 7')->where('tgl_masuk', NULL)->count()),
                    Stat::make('Sudah Datang Lantai 8', Kendaraan::where('lokasi', 'Siola Lantai 8')->whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Belum Datang Siola Lantai 8', Kendaraan::where('lokasi', 'Siola Lantai 8')->where('tgl_masuk', NULL)->count()),
                    Stat::make('Sudah Datang Convention Hall', Kendaraan::where('lokasi', 'Convention Hall')->whereNot('tgl_masuk', NULL)->count()),
                    Stat::make('Belum Datang Convention Hall', Kendaraan::where('lokasi', 'Convention Hall')->where('tgl_masuk', NULL)->count())
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
