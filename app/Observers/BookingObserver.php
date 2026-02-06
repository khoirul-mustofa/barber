<?php

namespace App\Observers;

use App\Enums\StatusBookingEnum;
use App\Models\Booking;
use App\Models\Setting;
use App\Services\FonnteService;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        // Kirim notifikasi ke Admin bahwa ada booking baru
        $adminPhone = Setting::get('ADMIN_PHONE');

        if ($adminPhone) {
            $message = "🔔 *BOOKING BARU!*\n\n".
                       "Kode: {$booking->booking_code}\n".
                       "Nama: {$booking->name}\n".
                       "Layanan: {$booking->service->name}\n".
                       "Waktu: {$booking->booking_date->format('d M Y')} jam {$booking->booking_time->format('H:i')}\n\n".
                       "Segera cek admin panel untuk konfirmasi.\n".
                       'https://kuga.id/dashboard';

            FonnteService::sendWhatsApp($adminPhone, $message);
        }
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {

        if ($booking->wasChanged('status')) {
            $newStatus = $booking->status;

            // 1. CONFIRMED
            if ($newStatus === StatusBookingEnum::CONFIRMED) {
                $message = "✅ *BOOKING DIKONFIRMASI*\n\n".
                           "Halo {$booking->name}, booking Anda telah dikonfirmasi!\n\n".
                           "Kode: *{$booking->booking_code}*\n".
                           "Layanan: {$booking->service->name}\n".
                           "Barber: {$booking->barber->name}\n".
                           "Waktu: {$booking->booking_date->format('d M Y')} jam {$booking->booking_time->format('H:i')}\n\n".
                           'Mohon datang 10 menit sebelum jadwal. Terima kasih!';

                FonnteService::sendWhatsApp($booking->phone, $message);
            }

            // 2. REJECTED
            elseif ($newStatus === StatusBookingEnum::REJECTED) {
                $message = "❌ *BOOKING DITOLAK*\n\n".
                           "Halo {$booking->name}, maaf booking Anda dengan kode *{$booking->booking_code}* tidak dapat kami proses saat ini.\n\n".
                           'Silakan hubungi admin atau buat booking ulang untuk waktu yang berbeda.';

                FonnteService::sendWhatsApp($booking->phone, $message);
            }

            // 3. COMPLETED
            elseif ($newStatus === StatusBookingEnum::COMPLETED) {
                $message = "💇‍♂️ *TERIMA KASIH*\n\n".
                           "Terima kasih telah mencukur di tempat kami, Bro {$booking->name}!\n".
                           'Semoga puas dengan layanannya. Ditunggu kedatangannya kembali! 😎';

                FonnteService::sendWhatsApp($booking->phone, $message);
            }
        }
    }
}
