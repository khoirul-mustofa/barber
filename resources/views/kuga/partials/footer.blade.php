<footer class="bg-emerald-950 border-t border-emerald-900 dark:border-emerald-900 text-white mt-auto transition-colors duration-300" id="footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Brand & Social -->
            <div class="space-y-4">
                <a href="#home" class="flex items-center gap-3 group">
                    <div class="flex flex-col" translate="no">
                        <span class="text-2xl font-bold tracking-wide text-green-500 font-heading">KUGA</span>
                        <span class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-yellow-500">Barbershop</span>
                    </div>
                </a>
                <p class="text-emerald-100/70 text-sm leading-relaxed">
                    Barbershop modern dengan pelayanan premium untuk penampilan maksimal Anda. Life begins after haircut!
                </p>
                <div class="flex space-x-4">
                    <a href="https://www.instagram.com/kuga.gallery" target="_blank" class="text-emerald-100/70 hover:text-pink-500 transition-colors duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://wa.me/6281256626112" target="_blank" class="text-emerald-100/70 hover:text-green-500 transition-colors duration-300">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="https://www.facebook.com/share/17qoGkZkY6" target="_blank" class="text-emerald-100/70 hover:text-blue-500 transition-colors duration-300">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                </div>

            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Link Cepat</h3>
                <ul class="space-y-2">
                    @foreach(['Tentang Kami' => '#tentang', 'Layanan' => '#layanan', 'Galeri' => '#galeri', 'Harga' => '#harga'] as $label => $link)
                    <li>
                        <a href="{{ $link }}" class="text-emerald-100/60 hover:text-yellow-500 transition-colors text-sm">{{ $label }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Layanan</h3>
                <ul class="space-y-2">
                    @foreach(\App\Models\Service::take(4)->get() as $service)
                    <li>
                        <a href="#layanan" class="text-emerald-100/60 hover:text-yellow-500 transition-colors text-sm">{{ $service->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Kontak</h3>
                <div class="space-y-3 text-sm text-emerald-100/60">
                    <p class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1 text-green-500"></i>
                        <span>Jl. melanti RT. 37. No. 23<br>Palaran Samarinda</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-phone text-green-500"></i>
                        <span>+62 812 5662 6112</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-envelope text-green-500"></i>
                        <span>kuga03042022@gmail.com</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="border-t border-emerald-900 pt-8 mt-8 text-center text-sm text-emerald-100/40">
            <p>&copy; 2026 KUGA Barbershop. Design by PALCUMPING.GL</p>
        </div>
    </div>
</footer>