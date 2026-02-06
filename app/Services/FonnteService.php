<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Kirim pesan WhatsApp menggunakan Fonnte
     *
     * @param  string  $targets  Nomor HP tujuan (format 08xx,08xx atau 628xx)
     * @param  string  $message  Isi pesan
     * @return array|mixed
     */
    public static function sendWhatsApp(array|string $targets, string $message)
    {
        $token = Setting::get('FONNTE_TOKEN');

        if (empty($token)) {
            Log::warning('Fonnte Token belum disetting di database');

            return null;
        }

        if (is_array($targets)) {
            $targets = implode(',', $targets);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $targets,
                'message' => $message,
                'countryCode' => '62', // Default country code
            ]);

            $result = $response->json();

            Log::info('Fonnte response:', $result);

            return $result;
        } catch (\Exception $e) {
            Log::error('Gagal mengirim WA via Fonnte: '.$e->getMessage());

            return null;
        }
    }
}
