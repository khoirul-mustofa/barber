<div class="space-y-6 animate-fade-in-up">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        @foreach($services as $service)
            <div wire:click="selectService({{ $service->id }}, {{ $service->price }} )"
                 class="relative block p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 group disable
                {{ $service_id == $service->id 
                    ? 'border-yellow-500 bg-emerald-50 dark:bg-emerald-900/50 shadow-md ring-1 ring-yellow-500' 
                    : 'border-emerald-100 dark:border-emerald-800 hover:border-emerald-300 dark:hover:border-emerald-600 bg-white dark:bg-emerald-900/30' 
                }}">{{-- Checkmark for selected --}}
                @if($service_id == $service->id)
                    <div class="absolute top-4 right-4 text-emerald-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                @endif

                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-14 w-14 rounded-full bg-emerald-100 dark:bg-emerald-900 text-3xl">
                            {{ $service->emoji ?? '✂️' }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-emerald-950 dark:text-white mb-1 group-hover:text-emerald-700 transition-colors">
                    {{ $service->name }}
                </h3>
                <p class="text-sm text-emerald-600 dark:text-emerald-300 mb-3 line-clamp-2">
                    {{ $service->description }}
                </p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-emerald-100 dark:border-emerald-800 flex justify-between items-center">
                    <div class="flex items-center text-sm text-emerald-500 dark:text-emerald-400">
                        <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $service->duration }} menit
                    </div>
                    <div class="text-lg font-bold text-emerald-900 dark:text-white">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
