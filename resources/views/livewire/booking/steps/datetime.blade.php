<div class="space-y-6 animate-fade-in-up">
    <div>
        <label for="booking_date" class="block text-sm font-medium text-emerald-900 dark:text-emerald-100 mb-2">Pilih Tanggal</label>
        <div class="relative">
             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <input type="date" id="booking_date" wire:model.live="booking_date" min="{{ now()->format('Y-m-d') }}"
                class="block w-full pl-10 pr-3 py-3 border border-emerald-200 rounded-lg leading-5 bg-white dark:bg-emerald-900/40 dark:border-emerald-700 placeholder-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition duration-150 ease-in-out text-emerald-900 dark:text-emerald-100 shadow-sm">
        </div>
        @error('booking_date') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
    </div>

    @if($booking_date)
        <div class="mt-6">
            <label class="block text-sm font-medium text-emerald-900 dark:text-emerald-100 mb-3">Jadwal Tersedia</label>
            
            @if(count($timeSlots) > 0)
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                    @foreach($timeSlots as $slot)
                        @php
                            // Use the display_time calculated in component (H:i) or format start_time
                            // The component now sets display_time to H:i
                            $timeValue = isset($slot->display_time) ? $slot->display_time : \Carbon\Carbon::parse($slot->start_time)->format('H:i'); 
                            $displayTime = $timeValue;
                            $isTaken = $slot->is_taken;
                            $isSelected = $booking_time === $timeValue;
                        @endphp
                        <button type="button" 
                            wire:click="selectTime('{{ $timeValue }}')"
                            @if($isTaken) disabled @endif
                            class="px-4 py-3 text-sm font-medium rounded-lg border transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500
                            {{ $isSelected 
                                ? 'bg-emerald-600 border-yellow-500 text-white shadow-md transform scale-105 ring-2 ring-yellow-400' 
                                : ($isTaken 
                                    ? 'bg-gray-100 border-gray-200 text-gray-400 cursor-not-allowed opacity-60' 
                                    : 'bg-white dark:bg-emerald-900/30 border-emerald-200 dark:border-emerald-700 text-emerald-700 dark:text-emerald-200 hover:border-emerald-400 hover:text-emerald-900') 
                            }}">
                            {{ $displayTime }}
                        </button>
                    @endforeach
                </div>
            @elseif(isset($holiday_description))
                <div class="text-center py-10 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-dashed border-red-200 dark:border-red-800">
                    <div class="flex flex-col items-center">
                        <svg class="h-12 w-12 text-red-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-bold text-red-800 dark:text-red-200">Mohon Maaf, Kami Tutup</h3>
                        <p class="text-red-600 dark:text-red-400 mt-1">{{ $holiday_description }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-8 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg border border-dashed border-emerald-200 dark:border-emerald-700">
                    <p class="text-emerald-500 dark:text-emerald-400">Tidak ada jadwal tersedia untuk tanggal ini.</p>
                </div>
            @endif
             @error('booking_time') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>
    @endif
</div>
