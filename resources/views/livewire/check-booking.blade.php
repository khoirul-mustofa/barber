<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 min-h-screen">
    <div class="max-w-md mx-auto">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-emerald-900 dark:text-white mb-2">Cek Status Booking</h1>
            <p class="text-emerald-600 dark:text-emerald-400">Masukkan kode booking dan nomor WA Anda</p>
        </div>

        {{-- Search Form --}}
        <div class="bg-white dark:bg-emerald-900 shadow-xl rounded-2xl p-8 border border-emerald-100 dark:border-emerald-800">
            <form wire:submit.prevent="check">
                <div class="space-y-6">
                    {{-- Kode Booking --}}
                    <div>
                        <label for="booking_code" class="block text-sm font-medium text-emerald-900 dark:text-emerald-100 mb-2">Kode Booking</label>
                        <input type="text" id="booking_code" wire:model="booking_code"
                            class="w-full rounded-lg border-emerald-200 p-2 focus:border-yellow-500 focus:ring-yellow-500 dark:bg-emerald-950 dark:border-emerald-700 dark:text-white dark:placeholder-emerald-400 dark:focus:border-yellow-500 dark:focus:ring-yellow-500 transition-colors"
                            placeholder="Contoh: BKG-12345">
                        @error('booking_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-emerald-900 dark:text-emerald-100 mb-2">Nomor WhatsApp</label>
                        <input type="text" id="phone" wire:model="phone"
                            class="w-full rounded-lg border-emerald-200 p-2 focus:border-yellow-500 focus:ring-yellow-500 dark:bg-emerald-950 dark:border-emerald-700 dark:text-white dark:placeholder-emerald-400 dark:focus:border-yellow-500 dark:focus:ring-yellow-500 transition-colors"
                            placeholder="Contoh: 08123456789">
                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-800 dark:hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors mt-4">
                    <span wire:loading.remove>Cek Status</span>
                    <span wire:loading>Memproses...</span>
                </button>
            </form>
        </div>

        {{-- Result --}}
        <div class="mt-8">
            @if($notFound)
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 text-center animate-fade-in-up">
                    <p class="text-red-600 dark:text-red-400 font-medium">Data tidak ditemukan. Periksa kembali kode dan nomor telepon Anda.</p>
                </div>
            @endif

            @if($booking)
                <div class="bg-white dark:bg-emerald-900 shadow-xl rounded-2xl overflow-hidden border border-emerald-100 dark:border-emerald-800 animate-fade-in-up">
                    <div class="bg-emerald-50 dark:bg-emerald-800 p-4 border-b border-emerald-100 dark:border-emerald-700 flex justify-between items-center">
                        <span class="text-sm font-medium text-emerald-600 dark:text-emerald-300">Status</span>
                        <div class="flex items-center space-x-2">
                             <a href="{{ route('booking.pdf', $booking->booking_code) }}" target="_blank" class="p-1 text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-200 transition" title="Download PDF">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>
                            @if($booking->status->value == 'waiting_payment')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold uppercase tracking-wide">Menunggu Pembayaran</span>
                            @elseif($booking->status->value == 'waiting_verification')
                                 <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold uppercase tracking-wide">Menunggu Verifikasi</span>
                            @elseif($booking->status->value == 'confirmed')
                                 <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase tracking-wide">Dikonfirmasi</span>
                            @elseif($booking->status->value == 'rejected')
                                 <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase tracking-wide">Ditolak</span>
                            @elseif($booking->status->value == 'completed')
                                 <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold uppercase tracking-wide">Selesai</span>
                            @elseif($booking->status->value == 'expired')
                                 <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase tracking-wide">Kadaluarsa</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-emerald-600 dark:text-emerald-400">Atas Nama</span>
                            <span class="font-medium text-emerald-900 dark:text-white">{{ $booking->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-emerald-600 dark:text-emerald-400">Layanan</span>
                            <span class="font-medium text-emerald-900 dark:text-white">{{ $booking->service->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-emerald-600 dark:text-emerald-400">Barber</span>
                            <span class="font-medium text-emerald-900 dark:text-white">{{ $booking->barber->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-emerald-600 dark:text-emerald-400">Jadwal</span>
                            <div class="text-right">
                                <div class="font-medium text-emerald-900 dark:text-white">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                <div class="text-sm text-emerald-500">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</div>
                            </div>
                        </div>

                         @if($booking->status == 'waiting_payment')
                            <div class="mt-6 pt-4 border-t border-emerald-100 dark:border-emerald-800">
                                <a href="#" class="block w-full py-2 text-center bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition">Upload Bukti Pembayaran</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
