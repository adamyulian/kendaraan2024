<?php

namespace App\Filament\Exports;

use App\Models\Kendaraan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class KendaraanExporter extends Exporter
{
    protected static ?string $model = Kendaraan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nopol'),
            ExportColumn::make('opd'),
            ExportColumn::make('tahun'),
            ExportColumn::make('merk'),
            ExportColumn::make('tipe'),
            ExportColumn::make('lokasi'),
            ExportColumn::make('tgl_masuk'),
            ExportColumn::make('kunci_mobil'),
            ExportColumn::make('stnk'),
            ExportColumn::make('dongkrak'),
            ExportColumn::make('kunci_ban'),
            ExportColumn::make('ban_serep'),
            ExportColumn::make('headunit'),
            ExportColumn::make('foto_kendaraan'),
            ExportColumn::make('tgl_keluar'),
            ExportColumn::make('lokasi_new'),
            ExportColumn::make('lepas_aki'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your kendaraan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
