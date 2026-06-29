{{-- Mengaktifkan Alpine.js App pada wrapper paling luar --}}
<div class="w-full bg-[#fdfbf7]" x-data="beritaApp()" x-init="initBerita()">
    
    {{-- 1. HERO SECTION --}}
    <section class="relative min-h-[650px] flex items-center overflow-hidden bg-cover bg-center"
             style="background-image: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.35)), url('{{ asset('img/1.jpeg') }}');">
        
        {{-- Hero Content --}}
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-12 text-center text-white">
            <span class="hidden md:inline-block text-sm tracking-[3px] uppercase font-semibold text-amber-300">
                {{ $settings['tema'] ?? 'Selamat Datang di' }}
            </span>
            
            <h1 class="text-5xl md:text-7xl font-extrabold mt-4 mb-8 leading-tight drop-shadow-md">
                {{ $settings['hero_text'] ?? 'Desa Sukamaju' }}
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg text-amber-50 font-medium mb-10 drop-shadow">
                {{ $settings['deskripsi'] ?? 'Kelompok KKN yang mengabdi untuk kemajuan dan kesejahteraan desa.' }}
            </p>
        </div>

        {{-- Wave Bottom --}}
        <div class="wave-shape absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 320" class="w-full">
                <path fill="#fdfbf7" d="M0,224L48,208C96,192,192,160,288,170.7C384,181,480,235,576,234.7C672,235,768,181,864,176C960,171,1056,213,1152,218.7C1248,224,1344,192,1392,176L1440,160L1440,320L0,320Z"/>
            </svg>
        </div>
    </section>

    {{-- 2. MENU IKON (Hilang di Mobile berkat hidden md:flex) --}}
    <section class="relative z-20 -mt-16 hidden md:flex justify-center gap-4 md:gap-8 flex-wrap px-4">
        @php
            $menus = [
                ['icon' => 'fa-map', 'label' => 'Wisata'],
                ['icon' => 'fa-user-graduate', 'label' => 'Pemuda'],
                ['icon' => 'fa-building', 'label' => 'UMKM'],
                ['icon' => 'fa-users', 'label' => 'Komunitas'],
                ['icon' => 'fa-handshake', 'label' => 'Layanan'],
                ['icon' => 'fa-person-cane', 'label' => 'Lansia'],
            ];
        @endphp
        @foreach($menus as $menu)
            <div class="text-center reveal">
                <div class="menu-circle bg-white text-amber-600 shadow-lg hover:text-amber-700 hover:scale-105 transition-all duration-300 w-16 h-16 rounded-full flex items-center justify-center text-xl mx-auto border border-amber-100">
                    <i class="fas {{ $menu['icon'] }}"></i>
                </div>
                <p class="mt-3 font-semibold text-sm text-stone-700">{{ $menu['label'] }}</p>
            </div>
        @endforeach
    </section>

    {{-- 3. JELAJAHI DESA --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 relative">
        {{-- Circle Background --}}
        <div class="absolute right-0 top-20 w-96 h-96 rounded-full bg-amber-100/40 -z-10 hidden lg:block"></div>
        
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <h2 class="text-4xl md:text-6xl font-bold text-[#78350f] leading-tight">
                    Jelajahi Desa
                </h2>
                <p class="text-stone-600 leading-relaxed mt-4 mb-8">
                    Temukan lokasi fasilitas umum, wisata, UMKM, balai desa, dan berbagai layanan masyarakat.
                </p>
                <a href="https://maps.app.goo.gl/XaQNrqxuDDQ7sa7m6" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg shadow-amber-600/20">
                    <i class="fas fa-map"></i> Lihat Peta Interaktif
                </a>
            </div>
            
            <div class="flex justify-center reveal">
                <div class="map-clip shadow-2xl relative overflow-hidden w-full max-w-[500px] aspect-square rounded-[2rem]">
                    {{-- Gambar --}}
                    <img src="{{ asset('img/2.png') }}" alt="Peta Desa" class="w-full h-full object-cover">
                    
                    {{-- Inner Shadow Overlay --}}
                    <div class="absolute inset-0 pointer-events-none" 
                         style="box-shadow: inset 0 0 80px rgba(0,0,0,0.7), inset 0 0 40px rgba(0,0,0,0.5);">
                    </div>
                    
                    {{-- Gradient Shadows --}}
                    <div class="absolute inset-y-0 left-0 w-2/5 bg-gradient-to-r from-black/60 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-2/5 bg-gradient-to-l from-black/60 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-x-0 bottom-0 h-2/5 bg-gradient-to-t from-black/70 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-x-0 top-0 h-1/4 bg-gradient-to-b from-black/40 to-transparent pointer-events-none"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. KEGIATAN MENDATANG (SLIDER HORIZONTAL) --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-12">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Kegiatan Mendatang</h2>
                <p class="text-stone-500 mt-2">Jangan lewatkan agenda seru yang akan dilaksanakan</p>
            </div>
            <a href="/kegiatan" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Semua Event <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        {{-- Container Slider --}}
        <div class="flex gap-6 overflow-x-auto pb-6 px-2 snap-x snap-mandatory scroll-smooth [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @forelse($kegiatan as $event)
                {{-- Card Event Slider --}}
                <div class="reveal bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl event-card-hover transition duration-300 flex-shrink-0 w-[280px] sm:w-[350px] snap-start border border-stone-100"
                     style="transition-delay: {{ $loop->index * 100 }}ms">
                    
                    {{-- Gambar Kegiatan --}}
                    <img src="{{ $event['img'] ?? 'https://images.unsplash.com/photo-1511578314322-379afb476865' }}" 
                         alt="{{ $event['title'] ?? ($event['judul'] ?? 'Kegiatan') }}" 
                         class="w-full h-64 object-cover">
                    
                    <div class="p-6">
                        {{-- Format Tanggal --}}
                        <div class="text-amber-600 font-bold text-sm tracking-wide">
                            {{ isset($event['tanggal']) ? date('d M Y', strtotime($event['tanggal'])) : ($event['date'] ?? 'Coming Soon') }}
                        </div>
                        {{-- Judul --}}
                        <h3 class="text-xl font-bold text-stone-900 mt-2 line-clamp-2">
                            {{ $event['title'] ?? ($event['judul'] ?? 'Judul Kegiatan') }}
                        </h3>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-16 text-stone-400 bg-white/50 rounded-2xl border border-dashed border-stone-200">
                    <i class="fas fa-calendar-times text-3xl mb-3 block text-stone-300"></i>
                    Belum ada kegiatan mendatang.
                </div>
            @endforelse
        </div>
    </section>

    {{-- 5. PROGRAM KERJA (Menjadi Slider di Mobile, Tetap Grid di Desktop) --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-12">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Program Kerja</h2>
                <p class="text-stone-500 mt-2">Berbagai program kerja unggulan untuk kemajuan desa</p>
            </div>
            <a href="/proker" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex gap-6 overflow-x-auto pb-6 px-2 snap-x snap-mandatory scroll-smooth [scrollbar-width:none] [&::-webkit-scrollbar]:hidden md:grid md:grid-cols-3 md:overflow-visible md:pb-0 md:px-0">
            @forelse ($prokers as $p)
                <div class="reveal bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 group border border-stone-100 flex-shrink-0 w-[280px] sm:w-[350px] snap-start md:w-full md:flex-shrink"
                     style="transition-delay: {{ $loop->index * 100 }}ms">
                    
                    <div class="h-48 overflow-hidden bg-gradient-to-br from-amber-500 to-[#78350f] flex items-center justify-center text-amber-200 text-5xl">
                        @if(!empty($p['gambar']))
                            <img src="{{ $p['gambar'] }}" alt="{{ $p['judul'] ?? 'Program' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <i class="fas fa-file-alt group-hover:scale-105 transition duration-500"></i>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="text-xs font-bold uppercase tracking-wider text-amber-600">
                            {{ $p['status'] ?? 'Rencana' }}
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mt-1">{{ $p['judul'] ?? 'Program' }}</h3>
                        <p class="text-stone-500 text-sm mt-2 line-clamp-2">{{ $p['deskripsi'] ?? '' }}</p>
                        @if (!empty($p['tanggal']))
                            <div class="text-xs text-stone-400 mt-3">
                                <i class="far fa-calendar"></i> {{ date('d M Y', strtotime($p['tanggal'])) }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full w-full text-center py-16 text-stone-400 bg-white/50 rounded-2xl border border-dashed border-stone-200">
                    <i class="fas fa-inbox text-3xl mb-3 block text-stone-300"></i>
                    Belum ada program kerja
                </div>
            @endforelse
        </div>
    </section>

    {{-- 6. BERITA TERBARU (Menjadi Slider di Mobile, Tetap Grid di Desktop) --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-12">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Berita Terbaru</h2>
                <p class="text-stone-500 mt-2">Ikuti kabar perkembangan dan artikel seputar KKN desa</p>
            </div>
            <a href="/berita" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Semua Berita <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex gap-6 overflow-x-auto pb-6 px-2 snap-x snap-mandatory scroll-smooth [scrollbar-width:none] [&::-webkit-scrollbar]:hidden md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:pb-0 md:px-0">
            @forelse ($berita as $b)
                <div class="reveal bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 flex flex-col h-full border border-stone-100 flex-shrink-0 w-[280px] sm:w-[350px] snap-start md:w-full md:flex-shrink"
                     style="transition-delay: {{ $loop->index * 100 }}ms">
                    
                    <div class="relative h-48 overflow-hidden bg-stone-200">
                        <img src="{{ !empty($b['thumbnail']) ? $b['thumbnail'] : (!empty($b['gambar']) ? $b['gambar'] : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=600&q=80') }}" 
                             alt="{{ $b['judul'] ?? 'Berita KKN' }}" 
                             class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    </div>

                    <div class="p-6 flex flex-col flex-grow justify-between">
                        <div>
                            @if (!empty($b['tanggal']))
                                <div class="text-xs text-stone-400 font-medium flex items-center gap-1">
                                    <i class="far fa-clock"></i> {{ date('d M Y', strtotime($b['tanggal'])) }}
                                </div>
                            @endif
                            
                            {{-- Judul Berita memicu modal pop-up --}}
                            <h3 class="text-lg font-bold text-stone-900 mt-2 line-clamp-2 hover:text-amber-600 transition cursor-pointer" @click="openModal({{ $loop->index }})">
                                {{ $b['judul'] ?? 'Untitled News' }}
                            </h3>

                            <p class="text-stone-500 text-sm mt-3 line-clamp-3 leading-relaxed">
                                {{ $b['isi'] ?? ($b['deskripsi'] ?? '') }}
                            </p>
                        </div>

                        {{-- Tombol Selengkapnya memicu modal pop-up --}}
                        <div class="pt-5 mt-4 border-t border-stone-100 flex items-center justify-end">
                            <button @click="openModal({{ $loop->index }})" class="text-sm font-semibold text-amber-600 hover:text-amber-700 inline-flex items-center gap-1 transition cursor-pointer bg-transparent border-none">
                                Selengkapnya <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full w-full text-center py-16 text-stone-400 bg-white/50 rounded-2xl border border-dashed border-stone-200">
                    <i class="fas fa-newspaper text-3xl mb-3 block text-stone-300"></i>
                    Belum ada kabar berita terbaru.
                </div>
            @endforelse
        </div>
    </section>

    {{-- 7. GALERI KEGIATAN (3D CURVED GALLERY) --}}
    <section class="max-w-[1600px] mx-auto px-6 lg:px-12 pb-24 overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8 max-w-7xl mx-auto">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Galeri Kegiatan</h2>
                <p class="text-stone-500 mt-2">Dokumentasi lensa kegiatan pengabdian mahasiswa KKN</p>
            </div>
            <a href="/galeri" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Semua Galeri <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        {{-- Wrapper Utama Perspektif 3D --}}
        <div class="flex justify-center items-center w-full min-h-[480px] overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <div class="relative w-[1500px] h-[450px] flex-shrink-0" style="perspective: 3000px;">
                
                {{-- Bayangan Lengkung di Bagian Bawah --}}
                <div class="absolute left-1/2 bottom-[10px] -translate-x-1/2 w-[1200px] h-[100px] pointer-events-none -z-10"
                     style="background: radial-gradient(ellipse at center, rgba(120,53,15,.08), transparent 75%); filter: blur(30px);">
                </div>

                @php
                    $displayGaleri = $galeri ?? [];

                    // KONFIGURASI UNTUK 6 KARTU (posisi disesuaikan agar rapi dan simetris)
                    $curveConfigs = [
                        ['class' => 'left-[50px] top-[40px] w-[200px] h-[360px]', 'transform' => 'rotateY(52deg)'],
                        ['class' => 'left-[270px] top-[70px] w-[200px] h-[360px]', 'transform' => 'rotateY(30deg)'],
                        ['class' => 'left-[490px] top-[90px] w-[200px] h-[360px]', 'transform' => 'rotateY(10deg)'],
                        ['class' => 'left-[710px] top-[90px] w-[200px] h-[360px]', 'transform' => 'rotateY(-10deg)'],
                        ['class' => 'left-[930px] top-[70px] w-[200px] h-[360px]', 'transform' => 'rotateY(-30deg)'],
                        ['class' => 'left-[1150px] top-[40px] w-[200px] h-[360px]', 'transform' => 'rotateY(-52deg)'],
                    ];
                @endphp

                {{-- Loop Render Tampilan 6 Kartu Melengkung --}}
                @for ($i = 0; $i < 6; $i++)
                    @php
                        $itemData = $displayGaleri[$i] ?? null;
                        if (!$itemData) continue;
                        
                        $imgUrl = $itemData['image_url'] ?? ($itemData['url'] ?? null);
                        $caption = $itemData['caption'] ?? ($itemData['judul'] ?? 'Dokumentasi Kegiatan KKN');
                        $config = $curveConfigs[$i];
                    @endphp

                    <div class="reveal absolute rounded-[24px] overflow-hidden bg-stone-300 shadow-[0_20px_40px_rgba(0,0,0,0.15)] transition-all duration-400 group cursor-pointer {{ $config['class'] }}"
                         style="transform: {{ $config['transform'] }}; transition-delay: {{ $i * 70 }}ms;"
                         onmouseenter="this.style.transform = 'translateY(-15px) scale(1.05)'; this.style.zIndex = '100'; this.style.opacity = '1';"
                         onmouseleave="this.style.transform = '{{ $config['transform'] }}'; this.style.zIndex = 'auto'; this.style.opacity = '1';">
                        
                        {{-- Gambar Card --}}
                        <img src="{{ $imgUrl }}" alt="{{ $caption }}" class="w-full h-full object-cover block">
                        
                        {{-- Overlay Gelap Saat Hover --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 pointer-events-none"></div>

                        {{-- Caption Tengah Vertikal --}}
                        <div class="absolute inset-0 flex items-center justify-center p-4 opacity-0 group-hover:opacity-100 transition duration-300 pointer-events-none">
                            <p class="text-white font-bold text-center text-sm uppercase tracking-widest select-none max-h-[90%] overflow-hidden text-ellipsis whitespace-nowrap"
                               style="writing-mode: vertical-lr; transform: rotate(180deg); text-shadow: 0 4px 12px rgba(0,0,0,0.6);">
                                {{ $caption }}
                            </p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- DETAL BERITA MODAL (READ LIGHTBOX Pop-up) --}}
    <div x-show="isOpen" 
         x-transition:enter.duration.300
         x-transition:leave.duration.300
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
         @click.away="closeModal()"
         @keydown.escape="closeModal()"
         style="display: none;">
        
        <div class="relative max-w-3xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col">
            
            {{-- Close Button --}}
            <button @click="closeModal()" 
                    class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            {{-- Scrollable Container --}}
            <div class="overflow-y-auto w-full h-full">
                
                {{-- Image Area --}}
                <div class="relative h-64 md:h-80 w-full bg-stone-100 flex items-center justify-center overflow-hidden">
                    <template x-if="currentBerita.thumbnail || currentBerita.gambar">
                        <img x-bind:src="currentBerita.thumbnail || currentBerita.gambar" 
                             x-bind:alt="currentBerita.judul || 'Berita'"
                             class="w-full h-full object-cover">
                    </template>
                    <template x-if="!(currentBerita.thumbnail || currentBerita.gambar)">
                        <div class="w-full h-full flex flex-col items-center justify-center text-6xl text-white bg-gradient-to-br from-amber-500 to-[#78350f] opacity-90">
                            <i class="fas fa-newspaper text-5xl"></i>
                        </div>
                    </template>

                    {{-- Category Badge --}}
                    <template x-if="currentBerita.kategori">
                        <div class="absolute bottom-4 left-6 z-10">
                            <span class="inline-flex px-3 py-1.5 bg-amber-600 text-white text-[10px] font-bold uppercase tracking-wider rounded-full shadow-lg" x-text="currentBerita.kategori"></span>
                        </div>
                    </template>
                </div>

                {{-- Content Body --}}
                <div class="p-6 md:p-8 space-y-4">
                    
                    {{-- Metadata --}}
                    <div class="flex flex-wrap items-center gap-4 text-xs text-stone-400 border-b border-stone-100 pb-4">
                        <template x-if="currentBerita.tanggal">
                            <div class="flex items-center gap-1">
                                <i class="far fa-calendar-alt text-amber-600"></i>
                                <span x-text="currentBerita.tanggal"></span>
                            </div>
                        </template>
                        <template x-if="currentBerita.penulis">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-user-edit text-amber-600"></i>
                                <span class="font-medium text-stone-600" x-text="currentBerita.penulis"></span>
                            </div>
                        </template>
                    </div>

                    {{-- Title --}}
                    <h2 class="text-2xl md:text-3xl font-bold text-stone-900 leading-tight" x-text="currentBerita.judul || 'Judul Berita'"></h2>
                    
                    {{-- Article Text --}}
                    <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line pt-2" x-text="currentBerita.isi || currentBerita.deskripsi"></div>
                </div>

            </div>

            {{-- Footer sticky info --}}
            <div class="p-4 bg-stone-50 border-t border-stone-100 flex items-center justify-between shrink-0">
                <span class="text-xs text-stone-400 font-medium" x-text="`Berita ${currentIndex + 1} dari ${totalBerita}`"></span>
                <button @click="closeModal()" 
                        class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                    Selesai Membaca
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ALPINE JS CONFIGURATION ENGINE --}}
<script>
    function beritaApp() {
        return {
            beritaList: @json($berita ?? []),
            isOpen: false,
            currentIndex: 0,
            totalBerita: 0,
            currentBerita: {},
            
            initBerita() {
                this.totalBerita = this.beritaList.length;
                if (this.totalBerita > 0) {
                    this.currentBerita = this.beritaList[0] || {};
                }
            },
            
            openModal(index) {
                if (this.beritaList.length > 0) {
                    this.currentIndex = index;
                    this.currentBerita = this.beritaList[index] || {};
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                }
            },
            
            closeModal() {
                this.isOpen = false;
                document.body.style.overflow = 'auto';
            }
        };
    }
</script>