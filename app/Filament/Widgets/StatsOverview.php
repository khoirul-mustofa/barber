<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendapatan', 'IDR '.number_format(\App\Models\Booking::where('status', 'completed')->sum('dp_amount'), 0, ',', '.'))
                ->description('Total pendapatan dari booking selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Total Booking', \App\Models\Booking::count())
                ->description('Semua booking')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Menunggu Pembayaran', \App\Models\Booking::where('status', 'waiting_payment')->count())
                ->description('Menunggu pembayaran customer')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Menunggu Verifikasi', \App\Models\Booking::where('status', 'waiting_verification')->count())
                ->description('Menunggu verifikasi admin')
                ->descriptionIcon('heroicon-m-document-magnifying-glass')
                ->color('warning'),

            Stat::make('Terkonfirmasi', \App\Models\Booking::where('status', 'confirmed')->count())
                ->description('Booking siap dikerjakan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),

            Stat::make('Selesai', \App\Models\Booking::where('status', 'completed')->count())
                ->description('Layanan telah selesai')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Ditolak', \App\Models\Booking::where('status', 'rejected')->count())
                ->description('Booking ditolak')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Kadaluarsa', \App\Models\Booking::where('status', 'expired')->count())
                ->description('Booking expired')
                ->descriptionIcon('heroicon-m-trash')
                ->color('danger'),
        ];
    }
}
