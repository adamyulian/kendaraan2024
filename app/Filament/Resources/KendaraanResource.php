<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kendaraan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KendaraanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KendaraanResource\RelationManagers;
use Filament\Forms\Components\Section;

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
                        Forms\Components\TextInput::make('opd')
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
