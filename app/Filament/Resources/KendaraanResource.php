<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kendaraan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\KendaraanExporter;
use App\Filament\Resources\KendaraanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KendaraanResource\RelationManagers;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kendaraan')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('nopol')
                            ->columnSpan(1),
                        Forms\Components\Select::make('opd')
                            ->options([
                                'BAGIAN HUKUM DAN KERJASAMA'=>'BAGIAN HUKUM DAN KERJASAMA',
                                'BAGIAN ORGANISASI'=>'BAGIAN ORGANISASI',
                                'BAGIAN PEREKONOMIAN DAN SUMBER DAYA ALAM'=>'BAGIAN PEREKONOMIAN DAN SUMBER DAYA ALAM',
                                'BAGIAN UMUM, PROTOKOL DAN KOMUNIKASI PIMPINAN'=>'BAGIAN UMUM, PROTOKOL DAN KOMUNIKASI PIMPINAN',
                                'DINAS PERUMAHAN RAKYAT DAN PEMUKIMAN SERTA PERTANAHAN'=>'DINAS PERUMAHAN RAKYAT DAN PEMUKIMAN SERTA PERTANAHAN',
                                'DINAS SUMBER DAYA AIR DAN BINA MARGA'=>'DINAS SUMBER DAYA AIR DAN BINA MARGA',
                                'INSPEKTORAT'=>'INSPEKTORAT',
                                'BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA'=>'BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA',
                                'BADAN KESATUAN BANGSA, POLITIK DAN PERLINDUNGAN MASYARAKAT'=>'BADAN KESATUAN BANGSA, POLITIK DAN PERLINDUNGAN MASYARAKAT',
                                'BADAN PENDAPATAN DAN PAJAK DAERAH'=>'BADAN PENDAPATAN DAN PAJAK DAERAH',
                                'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH'=>'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH',
                                'BADAN PERENCANAAN PEMBANGUNAN DAERAH, PENELITIAN DAN PENGEMBANGAN'=>'BADAN PERENCANAAN PEMBANGUNAN DAERAH, PENELITIAN DAN PENGEMBANGAN',
                                'BAGIAN PEMERINTAHAN DAN KESEJAHTERAAN RAKYAT'=>'BAGIAN PEMERINTAHAN DAN KESEJAHTERAAN RAKYAT',
                                'BAGIAN PENGADAAN BARANG/JASA DAN ADMINISTRASI PEMBANGUNAN'=>'BAGIAN PENGADAAN BARANG/JASA DAN ADMINISTRASI PEMBANGUNAN',
                                'DINAS KOMUNIKASI DAN INFORMATIKA'=>'DINAS KOMUNIKASI DAN INFORMATIKA',
                                'DINAS PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK SERTA PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA'=>'DINAS PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK SERTA PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA',
                                'KECAMATAN ASEMROWO'=>'KECAMATAN ASEMROWO',
                                'KECAMATAN BENOWO'=>'KECAMATAN BENOWO',
                                'KECAMATAN BUBUTAN'=>'KECAMATAN BUBUTAN',
                                'KECAMATAN BULAK'=>'KECAMATAN BULAK',
                                'KECAMATAN DUKUH PAKIS'=>'KECAMATAN DUKUH PAKIS',
                                'KECAMATAN GAYUNGAN'=>'KECAMATAN GAYUNGAN',
                                'KECAMATAN GENTENG'=>'KECAMATAN GENTENG',
                                'KECAMATAN GUBENG'=>'KECAMATAN GUBENG',
                                'KECAMATAN GUNUNG ANYAR'=>'KECAMATAN GUNUNG ANYAR',
                                'KECAMATAN JAMBANGAN'=>'KECAMATAN JAMBANGAN',
                                'KECAMATAN KARANGPILANG'=>'KECAMATAN KARANGPILANG',
                                'KECAMATAN KENJERAN'=>'KECAMATAN KENJERAN',
                                'KECAMATAN KREMBANGAN'=>'KECAMATAN KREMBANGAN',
                                'KECAMATAN LAKARSANTRI'=>'KECAMATAN LAKARSANTRI',
                                'KECAMATAN MULYOREJO'=>'KECAMATAN MULYOREJO',
                                'KECAMATAN PABEAN CANTIAN'=>'KECAMATAN PABEAN CANTIAN',
                                'KECAMATAN PAKAL'=>'KECAMATAN PAKAL',
                                'KECAMATAN RUNGKUT'=>'KECAMATAN RUNGKUT',
                                'KECAMATAN SAMBIKEREP'=>'KECAMATAN SAMBIKEREP',
                                'KECAMATAN SAWAHAN'=>'KECAMATAN SAWAHAN',
                                'KECAMATAN SEMAMPIR'=>'KECAMATAN SEMAMPIR',
                                'KECAMATAN SIMOKERTO'=>'KECAMATAN SIMOKERTO',
                                'KECAMATAN SUKOLILO'=>'KECAMATAN SUKOLILO',
                                'KECAMATAN SUKOMANUNGGAL'=>'KECAMATAN SUKOMANUNGGAL',
                                'KECAMATAN TAMBAKSARI'=>'KECAMATAN TAMBAKSARI',
                                'KECAMATAN TANDES'=>'KECAMATAN TANDES',
                                'KECAMATAN TEGALSARI'=>'KECAMATAN TEGALSARI',
                                'KECAMATAN TENGGILIS MEJOYO'=>'KECAMATAN TENGGILIS MEJOYO',
                                'KECAMATAN WIYUNG'=>'KECAMATAN WIYUNG',
                                'KECAMATAN WONOCOLO'=>'KECAMATAN WONOCOLO',
                                'KECAMATAN WONOKROMO'=>'KECAMATAN WONOKROMO',
                                'SEKRETARIAT DPRD'=>'SEKRETARIAT DPRD',
                                'DINAS PERHUBUNGAN'=>'DINAS PERHUBUNGAN',
                                'SATUAN POLISI PAMONG PRAJA'=>'SATUAN POLISI PAMONG PRAJA',
                                'DINAS KEBUDAYAAN, KEPEMUDAAN DAN OLAH RAGA SERTA PARIWISATA'=>'DINAS KEBUDAYAAN, KEPEMUDAAN DAN OLAH RAGA SERTA PARIWISATA',
                                'DINAS KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA SERTA PARIWISATA'=>'DINAS KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA SERTA PARIWISATA',
                                'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL'=>'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL',
                                'DINAS KOPERASI USAHA KECIL DAN MENENGAH DAN PERDAGANGAN'=>'DINAS KOPERASI USAHA KECIL DAN MENENGAH DAN PERDAGANGAN',
                                'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN'=>'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN',
                                'DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU'=>'DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU',
                                'DINAS PERPUSTAKAAN DAN KEARSIPAN'=>'DINAS PERPUSTAKAAN DAN KEARSIPAN',
                                'RSUD BHAKTI DHARMA HUSADA'=>'RSUD BHAKTI DHARMA HUSADA',
                                'RSUD DR SOEWANDHIE'=>'RSUD DR SOEWANDHIE',
                                'BADAN PENANGGULANGAN BENCANA DAERAH'=>'BADAN PENANGGULANGAN BENCANA DAERAH',
                                'DINAS KESEHATAN'=>'DINAS KESEHATAN',
                                'DINAS KETAHANAN PANGAN DAN PERTANIAN'=>'DINAS KETAHANAN PANGAN DAN PERTANIAN',
                                'DINAS LINGKUNGAN HIDUP'=>'DINAS LINGKUNGAN HIDUP',
                                'DINAS PENDIDIKAN'=>'DINAS PENDIDIKAN',
                                'DINAS PERINDUSTRIAN DAN TENAGA KERJA'=>'DINAS PERINDUSTRIAN DAN TENAGA KERJA',
                                'DINAS SOSIAL'=>'DINAS SOSIAL',
                            ])
                            ->native(false)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('tahun')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('merk')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('tipe')
                            ->columnSpan(1),
                        Forms\Components\Select::make('lokasi')
                            ->options([
                                'Balaikota Dalam' => 'Balaikota Dalam',
                                'Jimerto' => 'Jimerto',
                                'Siola Lantai 7' => 'Siola Lantai 7',
                                'Siola Lantai 8' => 'Siola Lantai 8',
                                'Convention Hall' => 'Convention Hall'
                            ])
                            ->native(false),
                    ]),
                Section::make('Checklist Kendaraan')
                    ->columns(1)
                    ->schema([
                        Forms\Components\DatePicker::make('tgl_masuk')
                            ->required(),
                        Forms\Components\Select::make('lokasi_new')
                            ->options([
                                'Balaikota Dalam' => 'Balaikota Dalam',
                                'Jimerto' => 'Jimerto',
                                'Siola Lantai 7' => 'Siola Lantai 7',
                                'Siola Lantai 8' => 'Siola Lantai 8',
                                'Convention Hall' => 'Convention Hall'
                            ])
                            ->native(false),
                        Forms\Components\Toggle::make('kunci_mobil'),
                        Forms\Components\Toggle::make('stnk'),
                        Forms\Components\Toggle::make('dongkrak'),
                        Forms\Components\Toggle::make('kunci_ban'),
                        Forms\Components\Toggle::make('ban_serep'),
                        Forms\Components\Toggle::make('headunit'),
                        Forms\Components\Toggle::make('lepas_aki')
                            ->columnSpan(1),
                        Forms\Components\FileUpload::make('foto_kendaraan')
                            ->image(),
                        Forms\Components\DatePicker::make('tgl_keluar'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(KendaraanExporter::class)
            ])
            ->modifyQueryUsing(function (Builder $query) {

                if (Auth::user()->name === 'admin') {
                    return $query;
                }

                // Non-admin users can only view their own component
                // return
                    $lokasi = Auth::user()->lokasi;
                    $query->where('lokasi', $lokasi);
                })
            ->columns([
                Tables\Columns\TextColumn::make('nopol')
                    ->searchable(),
                Tables\Columns\TextColumn::make('opd')
                    ->wrap()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('tahun')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('merk')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('tipe')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('lokasi')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('tgl_masuk')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\IconColumn::make('kunci_mobil')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('stnk')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('dongkrak')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('kunci_ban')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('ban_serep')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('headunit')
                //     ->boolean(),
                // Tables\Columns\TextColumn::make('foto_kendaraan')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('tgl_keluar')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lokasi_new')
                //     ->searchable(),
                // Tables\Columns\IconColumn::make('lepas_aki')
                //     ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label('Cek'),
            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'view' => Pages\ViewKendaraan::route('/{record}'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}
