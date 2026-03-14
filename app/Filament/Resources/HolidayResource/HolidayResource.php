<?php

namespace App\Filament\Resources\HolidayResource;

use App\Models\Holiday;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static string|\UnitEnum|null $navigationGroup = 'Management';

    protected static ?string $navigationLabel = 'Tanggal Libur';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Tanggal Libur'),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->label('Keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->label('Keterangan'),
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
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHolidays::route('/'),
        ];
    }
}
