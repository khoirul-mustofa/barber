@extends('kuga.layouts.app')

@section('content')

    <!-- HERO SECTION -->
    <section id="home" class="relative min-h-screen flex flex-col items-center justify-center text-center overflow-hidden bg-cover bg-center bg-fixed"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url('{{ asset('images/hero-main.jpg') }}');">
        
        <!-- Animated Blobs -->
        <div class="absolute top-[-200px] right-[-200px] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-green-900 to-green-600 blur-[150px] opacity-30 animate-pulse"></div>
        <div class="absolute bottom-[-150px] left-[-150px] w-[400px] h-[400px] rounded-full bg-gradient-to-br from-yellow-600 to-yellow-300 blur-[150px] opacity-20 animate-pulse"></div>

        <div class="relative z-10 max-w-4xl px-8 flex flex-col items-center">
            <span class="inline-block py-2 px-6 rounded-full text-sm font-bold bg-yellow-600/15 text-yellow-500 border border-yellow-600/30 mb-8 animate-fade-in-up">
                Premium Experience at KUGA Barbershop
            </span>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-bold leading-tight mb-6 text-white text-shadow-lg font-heading">
                Life Begins <br><span class="text-yellow-500">After Haircut</span>
            </h1>
            <p class="text-lg sm:text-xl text-white/85 max-w-2xl mx-auto mb-10 leading-relaxed font-light">
                Transformasi gaya Anda dengan layanan barbershop premium yang teliti dan berkelas.
                Temukan versi terbaik diri Anda di tangan para expert kami.
            </p>
            <div class="flex gap-6 justify-center animate-fade-in-up delay-200">
                <a href="{{ route('booking') }}" class="group flex items-center gap-3 px-8 py-4 bg-green-900 text-white rounded-lg font-bold hover:scale-105 hover:shadow-[0_0_40px_rgba(6,78,59,0.4)] transition-all duration-300">
                    Booking Sekarang <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
                <a href="#layanan" class="group flex items-center gap-3 px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-black transition-all duration-300">
                    Lihat Layanan <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-80">
            <div class="w-6 h-10 border-2 border-white/80 rounded-full flex justify-center pt-2">
                <div class="w-1 h-2 bg-white rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- MAP & REVIEWS -->
    <section id="lokasi" class="py-20 bg-white dark:bg-emerald-950 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
            <!-- Map -->
            <div class="w-full">
                <div class="relative rounded-3xl overflow-hidden shadow-xl border-l-4 border-yellow-500">
                    <iframe src="https://www.google.com/maps?q=KUGA+Barber+Jl.+Melanti+No.23+Palaran+Samarinda&output=embed"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="bg-green-900 text-white p-4 text-center font-medium text-sm">
                        📍 Jl. Melanti RT. 37 No. 23, Palaran
                    </div>
                </div>
            </div>
            
            <!-- Reviews -->
            <div class="w-full">
                <div class="bg-gray-50 dark:bg-emerald-900 p-10 rounded-3xl border border-gray-200 dark:border-emerald-800 shadow-md text-center hover:-translate-y-2 hover:border-yellow-500 hover:shadow-xl transition-all duration-300">
                    <div class="text-yellow-500 text-2xl mb-4">⭐⭐⭐⭐⭐</div>
                    <h3 class="text-2xl font-bold text-green-900 dark:text-white mb-4 font-heading">Customer Experience</h3>
                    <p class="italic text-gray-600 dark:text-emerald-100/80 text-lg mb-8 leading-relaxed">
                        "Potongan rambut paling detail dan rapi di Samarinda. Pelayanan ramah, tempat nyaman, dan sangat profesional!"
                    </p>
                    <div class="flex justify-center gap-12 mb-8">
                        <div class="flex flex-col">
                            <span class="text-4xl font-extrabold text-yellow-500">5.0</span>
                            <span class="text-xs uppercase tracking-widest text-gray-500 dark:text-emerald-300 mt-1">Rating</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-extrabold text-yellow-500">200+</span>
                            <span class="text-xs uppercase tracking-widest text-gray-500 dark:text-emerald-300 mt-1">Review</span>
                        </div>
                    </div>
                    <a href="https://maps.google.com" target="_blank" class="inline-block px-6 py-3 border border-green-900 dark:border-yellow-500 text-green-900 dark:text-yellow-500 rounded-full font-semibold hover:bg-green-900 hover:text-white dark:hover:bg-yellow-500 dark:hover:text-emerald-950 transition-all duration-300">
                        Baca Semua Ulasan →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="tentang" class="py-24 relative min-h-screen flex items-center bg-gray-900 bg-cover bg-center bg-fixed"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/team-photo.jpg') }}');">
        <div class="max-w-4xl mx-auto px-6 text-center text-white relative z-10">
            <h2 class="text-4xl sm:text-5xl font-bold mb-8 font-heading">
                Tentang <span class="text-yellow-500">KUGA Barbershop</span>
            </h2>
            <div class="space-y-6 text-lg text-white/90 leading-relaxed font-light">
                <p>
                    KUGA Barbershop adalah destinasi grooming premium yang menghadirkan pengalaman berbeda
                    dalam perawatan rambut dan penampilan pria. Dengan konsep modern dan pelayanan profesional,
                    kami berkomitmen memberikan hasil terbaik untuk setiap klien.
                </p>
                <p>
                    Tim barber kami terdiri dari profesional berpengalaman yang telah terlatih dengan teknik
                    terkini dalam dunia barbering. Kami menggunakan produk berkualitas premium dan peralatan
                    modern untuk memastikan kepuasan Anda.
                </p>
                <p>
                    Di KUGA, kami percaya bahwa setiap pria berhak mendapatkan penampilan terbaik mereka.
                    Lebih dari sekedar potong rambut, kami memberikan pengalaman yang membuat Anda merasa
                    percaya diri dan siap menaklukkan dunia.
                </p>
            </div>
            <div class="mt-10">
                <a href="#layanan" class="inline-block px-8 py-4 bg-gradient-to-r from-green-900 to-green-700 text-white rounded-lg font-bold shadow-[0_0_20px_rgba(6,78,59,0.3)] hover:-translate-y-1 hover:shadow-[0_0_40px_rgba(6,78,59,0.6)] transition-all duration-300">
                    Jelajahi Layanan Kami
                </a>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="layanan" class="py-24 bg-white dark:bg-emerald-950 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 font-heading text-gray-900 dark:text-white">
                    Layanan <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-900 to-green-600 dark:from-yellow-400 dark:to-yellow-600">Premium</span> Kami
                </h2>
                <p class="text-gray-500 dark:text-emerald-200 text-lg">Pilihan perawatan terbaik untuk penampilan maksimal Anda</p>
            </div>

            @foreach ($categories as $category)
                <h3 class="mt-12 mb-8 text-2xl font-bold text-green-900 dark:text-white border-l-4 border-green-900 dark:border-yellow-500 pl-4 font-heading">
                    {{ $category->name }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($category->services as $service)
                        <div class="group relative bg-white dark:bg-emerald-900 p-8 rounded-3xl border border-gray-200 dark:border-emerald-800 shadow-sm hover:border-yellow-500 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                            <div class="text-4xl mb-4 grayscale group-hover:grayscale-0 transition-all duration-300">{{ $service->emoji }}</div>
                            <h3 class="text-xl font-bold text-green-900 dark:text-white mb-2 font-heading">{{ $service->name }}</h3>
                            <p class="text-gray-500 dark:text-emerald-200/70 mb-4 text-sm leading-relaxed min-h-[40px]">{{ $service->description }}</p>
                            <p class="text-lg font-bold text-green-900 dark:text-yellow-500">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section id="galeri" class="py-24 bg-white dark:bg-emerald-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 font-heading text-gray-900 dark:text-white">
                    Galeri <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-900 to-green-600 dark:from-yellow-400 dark:to-yellow-600">Hasil Karya</span> Kami
                </h2>
                <p class="text-gray-500 dark:text-emerald-200 text-lg">Lihat transformasi gaya yang telah kami ciptakan</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($galeris as $galeri)
                    <div class="group relative overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer">
                        <img src="{{ asset('storage/' . $galeri->image) }}" alt="{{ $galeri->name }}" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold text-lg tracking-wide transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                {{ $galeri->name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PRICING SECTION -->
    <section id="harga" class="py-24 bg-gray-50 dark:bg-emerald-950 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 font-heading text-gray-900 dark:text-white">
                    Paket <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-900 to-green-600 dark:from-yellow-400 dark:to-yellow-600">Spesial</span>
                </h2>
                <p class="text-gray-500 dark:text-emerald-200 text-lg">Pilih paket terbaik untuk kebutuhan grooming Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Basic -->
                <div class="bg-white dark:bg-emerald-900 p-8 rounded-3xl border border-gray-200 dark:border-emerald-800 shadow-sm hover:-translate-y-2 hover:shadow-lg transition-all duration-300 text-center flex flex-col">
                    <h3 class="text-xl font-bold text-green-900 dark:text-white mb-4 font-heading">Basic Package</h3>
                    <div class="text-4xl font-extrabold text-yellow-600 dark:text-yellow-500 mb-2">150K</div>
                    <p class="text-sm text-gray-500 dark:text-emerald-200 mb-8 uppercase tracking-widest">Per Kunjungan</p>
                    <ul class="space-y-4 text-gray-600 dark:text-emerald-100 text-left mb-8 flex-1">
                        @foreach(['Classic Haircut', 'Hair Wash & Tonic', 'Hot Towel Treatment', 'Basic Styling', 'Complimentary Coffee'] as $feature)
                            <li class="flex items-center gap-3">
                                <span class="text-green-500 text-lg">✓</span> {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booking') }}" class="w-full py-3 px-6 rounded-xl border-2 border-green-900 text-green-900 font-bold hover:bg-green-900 hover:text-white transition-all duration-300">
                        Pilih Paket
                    </a>
                </div>

                <!-- Premium -->
                <div class="relative bg-white p-8 rounded-3xl border-2 border-yellow-500 shadow-xl transform md:-translate-y-4 text-center flex flex-col z-10">
                    <span class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-yellow-500 text-white text-xs font-bold px-4 py-1 rounded-full tracking-widest shadow-md">
                        MOST POPULAR
                    </span>
                    <h3 class="text-xl font-bold text-green-900 dark:text-white mb-4 font-heading">Premium Package</h3>
                    <div class="text-5xl font-extrabold text-yellow-600 dark:text-yellow-500 mb-2">275K</div>
                    <p class="text-sm text-gray-500 dark:text-emerald-200 mb-8 uppercase tracking-widest">Per Kunjungan</p>
                    <ul class="space-y-4 text-gray-600 dark:text-emerald-100 text-left mb-8 flex-1">
                        @foreach(['Premium Haircut & Styling', 'Beard Grooming', 'Hair Treatment', 'Head Massage (15 menit)', 'Premium Hair Products', 'Complimentary Beverage'] as $feature)
                            <li class="flex items-center gap-3">
                                <span class="text-yellow-500 text-lg">✓</span> <span class="font-medium text-gray-800">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booking') }}" class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-green-900 to-green-700 text-white font-bold hover:shadow-lg hover:from-green-800 hover:to-green-600 transition-all duration-300 shadow-green-900/20">
                        Pilih Paket
                    </a>
                </div>

                <!-- Ultimate -->
                <div class="bg-white dark:bg-emerald-900 p-8 rounded-3xl border border-gray-200 dark:border-emerald-800 shadow-sm hover:-translate-y-2 hover:shadow-lg transition-all duration-300 text-center flex flex-col">
                    <h3 class="text-xl font-bold text-green-900 dark:text-white mb-4 font-heading">Ultimate Package</h3>
                    <div class="text-4xl font-extrabold text-yellow-600 dark:text-yellow-500 mb-2">450K</div>
                    <p class="text-sm text-gray-500 dark:text-emerald-200 mb-8 uppercase tracking-widest">Per Kunjungan</p>
                    <ul class="space-y-4 text-gray-600 dark:text-emerald-100 text-left mb-8 flex-1">
                        @foreach(['Luxury Haircut & Styling', 'Complete Beard Care', 'Hair Coloring/Treatment', 'Full Body Massage (30 menit)', 'Facial Treatment', 'Take Home Products', 'Priority Booking'] as $feature)
                            <li class="flex items-center gap-3">
                                <span class="text-green-500 text-lg">✓</span> {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booking') }}" class="w-full py-3 px-6 rounded-xl border-2 border-green-900 text-green-900 font-bold hover:bg-green-900 hover:text-white transition-all duration-300">
                        Pilih Paket
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG/JOURNAL SECTION -->
    <section id="journal" class="py-24 bg-white dark:bg-emerald-900 transition-colors duration-300" x-data="{
        scrollContainer: null,
        init() {
            this.scrollContainer = this.$refs.journalContainer;
        },
        scrollNext() {
            this.scrollContainer.scrollBy({ left: 350, behavior: 'smooth' });
        },
        scrollPrev() {
            this.scrollContainer.scrollBy({ left: -350, behavior: 'smooth' });
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 font-heading text-gray-900 dark:text-white">
                    Style <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-900 to-green-600 dark:from-yellow-400 dark:to-yellow-600">Journal</span>
                </h2>
                <p class="text-gray-500 dark:text-emerald-200 text-lg">Inspirasi & Tips Grooming Terkini</p>
            </div>

            <!-- Slider Container -->
            <div class="relative group">
                <div class="flex gap-8 overflow-x-auto pb-8 snap-x scrollbar-hide" x-ref="journalContainer">
                    @foreach ($journals as $journal)
                        <div class="min-w-[320px] bg-white dark:bg-emerald-950 rounded-3xl border border-gray-100 dark:border-emerald-800 shadow-sm hover:translate-y-[-5px] hover:border-yellow-500 hover:shadow-xl transition-all duration-300 overflow-hidden snap-center">
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $journal->image) }}" alt="{{ $journal->title }}" 
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <h4 class="text-xl font-bold text-green-900 dark:text-white mb-2 truncate font-heading">{{ $journal->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-emerald-200/70 mb-4 line-clamp-2 h-10">{{ $journal->summary }}</p>
                                <a href="{{ route('journal.view', $journal->title) }}" class="text-green-700 font-bold text-sm hover:text-green-900 inline-flex items-center gap-1 group/link">
                                    Selengkapnya <span class="group-hover/link:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Controls -->
                <div class="flex justify-center gap-4 mt-6">
                    <button @click="scrollPrev" class="w-12 h-12 rounded-full border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-700 dark:text-white flex items-center justify-center hover:bg-green-900 hover:text-white hover:border-green-900 dark:hover:bg-yellow-500 dark:hover:text-emerald-900 transition-all shadow-sm">
                        ←
                    </button>
                    <button @click="scrollNext" class="w-12 h-12 rounded-full border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-700 dark:text-white flex items-center justify-center hover:bg-green-900 hover:text-white hover:border-green-900 dark:hover:bg-yellow-500 dark:hover:text-emerald-900 transition-all shadow-sm">
                        →
                    </button>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('journal.index') }}" class="inline-block px-8 py-3 border-2 border-green-900 text-green-900 rounded-full font-bold hover:bg-green-900 hover:text-white transition-all duration-300">
                    Lihat Semua Style Journal ({{ $journalCount }}+) →
                </a>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="kontak" class="py-24 bg-gray-50 dark:bg-emerald-950 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 font-heading text-gray-900 dark:text-white">
                    Hubungi <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-900 to-green-600 dark:from-yellow-400 dark:to-yellow-600">Kami</span>
                </h2>
                <p class="text-gray-500 dark:text-emerald-200 text-lg">Booking appointment atau tanyakan informasi lebih lanjut</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-start max-w-5xl mx-auto">
                <!-- Contact Info -->
                <div class="bg-white dark:bg-emerald-950 p-10 rounded-3xl shadow-[0_20px_50px_rgba(6,78,59,0.05)] border border-emerald-50 dark:border-emerald-900">
    <h3 class="text-2xl font-black text-emerald-900 dark:text-white mb-8 font-heading tracking-tight">
        Informasi Kontak
    </h3>
    
    <div class="space-y-8">
        {{-- Item Alamat --}}
        <div class="flex items-start gap-5 group">
            <div class="w-12 h-12 shrink-0 rounded-2xl bg-emerald-50 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-emerald-900 dark:text-emerald-50 mb-1">Alamat</h4>
                <p class="text-gray-500 dark:text-emerald-200/60 leading-relaxed text-sm">
                    Jl. melanti RT. 37. No. 23<br>
                    Palaran Samarinda, 75243
                </p>
            </div>
        </div>

        {{-- Item Telepon --}}
        <div class="flex items-start gap-5 group">
            <div class="w-12 h-12 shrink-0 rounded-2xl bg-emerald-50 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-emerald-900 dark:text-emerald-50 mb-1">Telepon</h4>
                <p class="text-gray-500 dark:text-emerald-200/60 text-sm font-medium">+62 812 5662 6112</p>
            </div>
        </div>

        {{-- Item Email --}}
        <div class="flex items-start gap-5 group">
            <div class="w-12 h-12 shrink-0 rounded-2xl bg-emerald-50 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-emerald-900 dark:text-emerald-50 mb-1">Email</h4>
                <p class="text-gray-500 dark:text-emerald-200/60 text-sm">kuga03042022@gmail.com</p>
            </div>
        </div>

        {{-- Item Jam Operasional --}}
        <div class="flex items-start gap-5 group">
            <div class="w-12 h-12 shrink-0 rounded-2xl bg-emerald-50 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-emerald-900 dark:text-emerald-50 mb-1">Jam Operasional</h4>
                <div class="text-sm text-gray-500 dark:text-emerald-200/60">
                    <p><span class="text-emerald-700 dark:text-emerald-400 font-semibold">Senin - Sabtu:</span> 09.00 - 21.00</p>
                    <p><span class="text-emerald-700 dark:text-emerald-400 font-semibold">Minggu:</span> 10.00 - 18.00</p>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Contact Form -->
                    <div class="bg-white dark:bg-emerald-900 p-10 rounded-3xl shadow-[0_20px_50px_rgba(6,78,59,0.05)] border border-emerald-50 dark:border-emerald-900">
                        <form id="contactForm" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-emerald-200 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-yellow-500 focus:ring-2 focus:ring-green-200 dark:focus:ring-yellow-500/50 outline-none transition-all">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-emerald-200 mb-2">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" required placeholder="Masukkan nomor telepon"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-yellow-500 focus:ring-2 focus:ring-green-200 dark:focus:ring-yellow-500/50 outline-none transition-all">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-emerald-200 mb-2">Email</label>
                                <input type="email" id="email" name="email" required placeholder="Masukkan email Anda"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-yellow-500 focus:ring-2 focus:ring-green-200 dark:focus:ring-yellow-500/50 outline-none transition-all">
                            </div>
                            <div>
                                <label for="service" class="block text-sm font-medium text-gray-700 dark:text-emerald-200 mb-2">Layanan yang Diminati</label>
                                <input type="text" id="service" name="service" placeholder="Contoh: Classic Haircut"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-yellow-500 focus:ring-2 focus:ring-green-200 dark:focus:ring-yellow-500/50 outline-none transition-all">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-emerald-200 mb-2">Pesan</label>
                                <textarea id="message" name="message" rows="4" placeholder="Tulis pesan atau pertanyaan Anda..."
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-emerald-800 bg-white dark:bg-emerald-950 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-yellow-500 focus:ring-2 focus:ring-green-200 dark:focus:ring-yellow-500/50 outline-none transition-all"></textarea>
                            </div>
                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-green-900 to-green-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </section>

@endsection