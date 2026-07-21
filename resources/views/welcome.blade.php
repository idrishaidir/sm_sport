@extends('layouts.main')

@section('title', 'SM Sport Center - Pusat Olahraga Premium')

@section('content')
    <section class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-[minmax(180px,auto)]">
        <div class="bento-card col-span-1 md:col-span-3 md:row-span-2 relative min-h-[400px] md:min-h-0 flex flex-col justify-end p-8 md:p-12 group overflow-hidden">
            <img src="{{ asset('images/header.png') }}" alt="Fasilitas Olahraga" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/60 to-transparent"></div>
            
            <div class="relative z-10 max-w-2xl text-white">
                <span class="inline-block py-1.5 px-4 rounded-full glass-panel-dark text-xs font-bold uppercase tracking-wider mb-4">
                    Pusat Olahraga Premium
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    SM Sport Center
                </h1>
                <h2 class="text-xl md:text-2xl font-medium text-accent mb-4">
                    Destinasi Modern untuk Olahraga, Kebugaran, dan Komunitas.
                </h2>
                <p class="text-white/80 mb-8 max-w-xl text-sm md:text-base leading-relaxed">
                    Kami menyediakan fasilitas lapangan futsal dan badminton terbaik untuk Anda. Nikmati gaya hidup sehat di lingkungan yang profesional, bersih, dan nyaman.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('ketersediaan') }}" class="bg-white text-primary hover:bg-background px-6 py-3 rounded-xl font-semibold transition-colors shadow-md">
                        Cek Ketersediaan
                    </a>
                    <a href="{{ route('register') }}" class="glass-panel-dark hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                        Pesan Lapangan
                    </a>
                </div>
            </div>
        </div>

        <div class="bento-card col-span-1 p-6 flex items-center gap-4 bg-primary text-white">
            <div class="w-12 h-12 glass-panel-dark rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">date_range</span>
            </div>
            <div>
                <h4 class="font-bold text-lg">Buka Setiap Hari</h4>
                <p class="text-white/70 text-xs">08:00 - 23:00</p>
            </div>
        </div>
        
        <div class="bento-card col-span-1 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined">award_star</span>
            </div>
            <div>
                <h4 class="font-bold text-primary text-sm">Standar Profesional</h4>
                <p class="text-text/60 text-xs">Lantai & pencahayaan premium</p>
            </div>
        </div>
        
        <div class="bento-card col-span-1 md:col-span-2 p-6 flex items-center gap-4 bg-[url('https://images.unsplash.com/photo-1596328329606-44439050d535?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center relative overflow-hidden text-white">
            <div class="absolute inset-0 bg-primary/80"></div>
            <div class="relative z-10 flex items-center gap-4 w-full">
                <div class="w-12 h-12 glass-panel-dark rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">sentiment_very_satisfied</span>
                </div>
                <div>
                    <h4 class="font-bold text-lg">Lingkungan Nyaman</h4>
                    <p class="text-white/80 text-xs mt-1 max-w-sm">Area tunggu luas, fasilitas bersih, dan suasana yang ramah untuk tim serta keluarga Anda.</p>
                </div>
            </div>
        </div>
        
        <div class="bento-card col-span-1 p-6 flex flex-col justify-center items-start bg-gradient-to-br from-white to-green-50 relative overflow-hidden group">
            <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                <span class="w-6 h-6 material-symbols-outlined">sports_and_outdoors</span>
            </div>
            <h3 class="text-3xl font-bold text-primary mb-1">2</h3>
            <p class="text-text font-medium text-sm">Lapangan Futsal</p>
        </div>

        <div class="bento-card col-span-1 p-6 flex flex-col justify-center items-start bg-gradient-to-br from-white to-green-50 relative overflow-hidden group">
            <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                <span class="w-6 h-6 material-symbols-outlined">badminton</span>
            </div>
            <h3 class="text-3xl font-bold text-primary mb-1">3</h3>
            <p class="text-text font-medium text-sm">Lapangan Badminton</p>
        </div>
    </section>

    <section id="about" class="mt-16 pt-8 scroll-mt-28">
        <div class="flex items-center gap-4 mb-6 px-2">
            <div class="w-2 h-8 bg-secondary rounded-full"></div>
            <h2 class="text-3xl font-bold text-primary">Tentang SM Sport Center</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bento-card col-span-1 md:col-span-1 h-64 md:h-full relative group overflow-hidden">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop" alt="Komunitas" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            </div>
            
            <div class="bento-card col-span-1 md:col-span-2 p-8 md:p-12 flex flex-col justify-center bg-white">
                <h3 class="text-sm font-bold text-secondary uppercase tracking-wider mb-2">Misi Kami</h3>
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Meningkatkan Gaya Hidup Aktif Anda</h2>
                <p class="text-text/80 text-lg leading-relaxed mb-8">
                    Kami percaya bahwa gaya hidup sehat dimulai dari lingkungan yang tepat. SM Sport Center berdedikasi untuk menyediakan fasilitas olahraga modern, terawat, dan profesional yang menginspirasi Anda untuk bergerak dan terhubung dengan komunitas.
                </p>
                
                <div class="grid grid-cols-2 gap-4 mt-auto">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined">check</span>
                        </div>
                        <span class="font-semibold text-sm text-primary">Lapangan Berkualitas</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined">sentiment_satisfied</span>
                        </div>
                        <span class="font-semibold text-sm text-primary">Pelayanan Ramah</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <span class="font-semibold text-sm text-primary">Lingkungan Aman</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center text-highlight">
                            <span class="material-symbols-outlined">mobile_2</span>
                        </div>
                        <span class="font-semibold text-sm text-primary">Reservasi Online Mudah</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="facilities" class="mt-16 pt-8 scroll-mt-28">
        <div class="flex items-center gap-4 mb-6 px-2">
            <div class="w-2 h-8 bg-secondary rounded-full"></div>
            <h2 class="text-3xl font-bold text-primary">Fasilitas Premium</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bento-card h-[400px] relative group cursor-pointer overflow-hidden">
                <img src="https://images.unsplash.com/photo-1587329310686-91414b8e3cb7?q=80&w=2071&auto=format&fit=crop" alt="Lapangan Futsal" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full text-white">
                    <div class="flex justify-between items-end">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Lapangan Futsal</h3>
                            <ul class="space-y-1 text-sm text-white/80">
                                <li>✓ Rumput sintetis premium</li>
                                <li>✓ Area indoor terlindung</li>
                                <li>✓ Pencahayaan LED standar turnamen</li>
                            </ul>
                        </div>
                        <div class="w-12 h-12 glass-panel rounded-full flex items-center justify-center text-white transform transition-transform group-hover:translate-x-2">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bento-card h-[400px] relative group cursor-pointer overflow-hidden">
                <img src="https://images.unsplash.com/photo-1551280857-2b9eb02029b4?q=80&w=2070&auto=format&fit=crop" alt="Lapangan Badminton" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full text-white">
                    <div class="flex justify-between items-end">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Lapangan Badminton</h3>
                            <ul class="space-y-1 text-sm text-white/80">
                                <li>✓ Karpet/flooring profesional</li>
                                <li>✓ Lapangan anti-silau yang terang</li>
                                <li>✓ Sirkulasi udara sangat nyaman</li>
                            </ul>
                        </div>
                        <div class="w-12 h-12 glass-panel rounded-full flex items-center justify-center text-white transform transition-transform group-hover:translate-x-2">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="mt-16 pt-8 scroll-mt-28">
        <div class="flex justify-between items-end mb-6 px-2">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-2 h-8 bg-secondary rounded-full"></div>
                    <h2 class="text-3xl font-bold text-primary">Galeri Kegiatan</h2>
                </div>
                <p class="text-text/70">Potret keseruan dan aktivitas di dalam komunitas kami.</p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[150px]">
            <div class="bento-card col-span-2 row-span-2 group overflow-hidden">
                <img src="https://images.unsplash.com/photo-1542652735873-fb2825bac6e2?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Aksi Olahraga">
            </div>
            <div class="bento-card col-span-1 row-span-1 group overflow-hidden">
                <img src="https://images.unsplash.com/photo-1596328329606-44439050d535?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Ruang Tunggu">
            </div>
            <div class="bento-card col-span-1 row-span-2 group overflow-hidden">
                <img src="https://images.unsplash.com/photo-1551280857-2b9eb02029b4?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Lapangan Badminton">
            </div>
            <div class="bento-card col-span-1 row-span-2 group overflow-hidden">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Resepsionis">
            </div>
            <div class="bento-card col-span-2 row-span-1 group overflow-hidden">
                <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=2071&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Lapangan Futsal">
            </div>
        </div>
    </section>

    <footer id="contact" class="mt-20 border-t border-gray-100 bg-white w-full -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-sm">SM</div>
                        <span class="font-bold text-lg text-primary">SM Sport Center</span>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Penyediaan fasilitas lapangan olahraga premium terbaik dan terlengkap untuk menjaga performa kesehatan Anda secara maksimal.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-sm text-primary mb-4 uppercase tracking-wider">Tautan Cepat</h4>
                    <ul class="space-y-2.5 text-xs text-gray-600">
                        <li><a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda Utama</a></li>
                        <li><a href="#about" class="hover:text-primary transition-colors">Tentang Kami</a></li>
                        <li><a href="#facilities" class="hover:text-primary transition-colors">Fasilitas Lapangan</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-primary transition-colors">Masuk / Daftar</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-sm text-primary mb-4 uppercase tracking-wider">Informasi Kontak</h4>
                    <ul class="space-y-3 text-xs text-gray-600">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-secondary">location_on</span>
                            Jl. Kelapa Gading Raya No. 45, Jakarta
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-secondary">call</span>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-secondary">mail</span>
                            support@smsportcenter.com
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-sm text-primary mb-4 uppercase tracking-wider">Jam Operasional</h4>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li class="flex justify-between border-b border-gray-50 pb-1">
                            <span>Senin - Minggu:</span>
                            <span class="font-semibold text-primary">08:00 - 23:00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 text-center text-xs text-gray-400 flex flex-col sm:flex-row justify-between items-center gap-2">
                <p>&copy; {{ date('Y') }} SM Sport Center. Hak Cipta Dilindungi Undang-Undang.</p>
                <p class="text-[10px] text-gray-300">Didesain dengan Tailwind CSS & Laravel</p>
            </div>
        </div>
    </footer>
@endsection