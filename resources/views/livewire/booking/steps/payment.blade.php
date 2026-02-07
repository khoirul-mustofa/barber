<div class="space-y-8 animate-fade-in-up">
    <!-- Payment Methods -->
    <div>
        <h3 class="text-lg font-medium text-emerald-950 dark:text-emerald-100 mb-4">Pilih Metode Pembayaran</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            @foreach($payment_methods as $method)
                <div wire:click="$set('payment_method', '{{ $method->code->value }}')"
                     class="relative block p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 group
                {{ $payment_method === $method->code->value
                    ? 'border-yellow-500 bg-emerald-50 dark:bg-emerald-900/50 shadow-md ring-1 ring-yellow-500'
                    : 'border-emerald-100 dark:border-emerald-800 hover:border-emerald-300 dark:hover:border-emerald-600 bg-white dark:bg-emerald-900/30'
                }}">
                    <div class="flex-shrink-0">
                         @if($method->icon && Storage::exists($method->icon))
                            <img src="{{ Storage::url($method->icon) }}" class="h-8 w-8 object-contain">
                         @else
                            <span class="text-2xl">{{ $method->icon ?? '💳' }}</span>
                         @endif
                    </div>
                    <div class="flex-1 mt-2">
                        <p class="text-sm font-bold text-emerald-900 dark:text-white">{{ $method->name }}</p>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400">{{ $method->description }}</p>
                        @if($method->account_number)
                            <p class="text-xs font-mono text-emerald-500 mt-1">{{ $method->account_number }}</p>
                        @endif
                    </div>
                     {{-- Check circle --}}
                    <div class="absolute top-4 right-4 text-emerald-500 {{ $payment_method === $method->code->value ? 'opacity-100' : 'opacity-0' }} transition-opacity">
                         <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            @endforeach
        </div>
        @error('payment_method') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
    </div>

    <!-- QRIS Display -->
    @if($payment_method && $selectedMethod = $payment_methods->firstWhere('code.value', $payment_method))
        @if($selectedMethod->code === \App\Enums\PaymentMethods::QRIS || $selectedMethod->image)
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-dashed border-2 border-emerald-500 text-center shadow-inner mt-6">
                <h4 class="text-emerald-800 dark:text-emerald-400 font-bold mb-2">Scan QR Code</h4>
                <div class="bg-white p-3 inline-block rounded-lg shadow-sm">
                    @if($selectedMethod->image)
                        <img src="{{ Storage::url($selectedMethod->image) }}" alt="QR Code" class="w-48 h-48 mx-auto object-contain">
                    @else
                        <img src="{{ asset('images/qr-code.svg') }}" alt="QRIS" class="w-48 h-48 mx-auto">
                    @endif
                </div>
                 <p class="text-sm text-gray-500 mt-2">Scan untuk melakukan pembayaran.</p>
            </div>
        @endif
    @endif

    <!-- Payment Proof Upload -->
    <div class="border-t border-emerald-100 dark:border-emerald-800 pt-6">
        <h3 class="text-lg font-medium text-emerald-900 dark:text-emerald-100 mb-2">Upload Bukti Pembayaran</h3>
        <p class="text-sm text-emerald-600 dark:text-emerald-400 mb-4">Silakan upload screenshot bukti transfer Anda.</p>

        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-emerald-300 dark:border-emerald-700 border-dashed rounded-xl hover:border-emerald-500 transition-colors bg-emerald-50 dark:bg-emerald-900/30">
            <div class="space-y-1 text-center">
                @if($payment_proof)
                     {{-- Preview --}}
                     <div class="relative inline-block">
                         <img src="{{ $payment_proof->temporaryUrl() }}" class="h-32 rounded-md object-cover mx-auto" alt="Preview">
                         <button wire:click="$set('payment_proof', null)" type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-sm hover:bg-red-600">
                             <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                         </button>
                     </div>
                     <p class="text-xs text-green-600 mt-2">File terpilih!</p>
                @else
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-emerald-600 justify-center">
                        <label for="file-upload" class="relative cursor-pointer bg-white dark:bg-emerald-900/50 rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                            <span>Upload file</span>
                            <input id="file-upload" wire:model.live="payment_proof" type="file" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1 text-emerald-500 dark:text-emerald-400">atau tarik dan lepas</p>
                    </div>
                    <p class="text-xs text-emerald-500 dark:text-emerald-400">PNG, JPG, GIF up to 2MB</p>
                @endif
            </div>
        </div>
        @error('payment_proof') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
    </div>

    <!-- Confirm Button -->
    <button wire:click="submit"
        wire:loading.attr="disabled"
        class="w-full mt-6 bg-emerald-600 border border-transparent rounded-lg shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
        <span wire:loading.remove>Konfirmasi & Booking</span>
        <span wire:loading class="flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            Memproses...
        </span>
    </button>
</div>
