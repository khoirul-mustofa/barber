<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Enums\StatusBookingEnum;
use App\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_code')
                    ->label('Kode')
                    ->copyable()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Booking $record) => $record->phone),

                TextColumn::make('service.name')
                    ->label('Layanan')
                    ->searchable()
                    ->description(fn (Booking $record) => $record->barber->name)
                    ->icon('heroicon-m-scissors')
                    ->wrap(),

                TextColumn::make('booking_date')
                    ->label('Jadwal')
                    ->date('d M Y')
                    ->description(fn (Booking $record) => $record->booking_time->format('H:i'))
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('DP')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Lunas' : 'Belum')
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    ->icon(fn ($state) => $state ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle'),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->striped()
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                ViewAction::make()
                    ->label('Detail')
                    ->modalHeading('Detail Booking')
                    ->modalHeading('Detail Booking')
                    ->color('info'),
                Action::make('verify')
                    ->label('Konfirmasi')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Booking')
                    ->modalDescription('Apakah Anda yakin ingin mengonfirmasi booking ini? Pesan WhatsApp akan dikirim ke pelanggan.')
                    ->action(function (Booking $record) {
                        $record->update(['status' => StatusBookingEnum::CONFIRMED]);

                        Notification::make()
                            ->title('Booking Dikonfirmasi')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Booking $record) => $record->status === StatusBookingEnum::WAITING_PAYMENT || $record->status === StatusBookingEnum::WAITING_VERIFICATION),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Booking')
                    ->modalDescription('Apakah Anda yakin ingin menolak booking ini?')
                    ->action(function (Booking $record) {
                        $record->update(['status' => StatusBookingEnum::REJECTED]);

                        Notification::make()
                            ->title('Booking Ditolak')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (Booking $record) => ! in_array($record->status, [StatusBookingEnum::CONFIRMED, StatusBookingEnum::REJECTED, StatusBookingEnum::COMPLETED])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
