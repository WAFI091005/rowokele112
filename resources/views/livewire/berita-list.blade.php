<div class="w-full bg-[#fdfbf7]" x-data="beritaApp()" x-init="initBerita()">
    
    {{-- HERO SECTION - Gaya Premium Kontemporer (Warm Earth Theme) --}}
    <section class="relative min-h-[400px] flex items-center overflow-hidden"
             style="background: linear-gradient(135deg, #78350f, #b45309);">
        
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>
        
        {{-- Decorative Blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                    <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Berita & Kegiatan</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                    Berita Terbaru
                    <span class="text-amber-300 block mt-2">KKN Desa Rowokele</span>
                </h1>
                
                <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed mb-8">
                    Update terkini tentang kegiatan dan program kerja yang dilaksanakan oleh tim KKN.
                </p>
            </div>
        </div>
        
{{-- Wave Bottom --}}
<div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
    <svg
        class="block w-full h-[120px]"
        viewBox="0 0 1440 120"
        preserveAspectRatio="none"
        xmlns="http://www.w3.org/2000/svg">

        <path
            d="M0,120
               C180,70 360,10 720,40
               C980,65 1180,90 1440,80
               L1440,120
               L0,120
               Z"
            fill="#fdfbf7"/>
    </svg>
</div>
    </section>

    {{-- BERITA GRID --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
        {{-- Header --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#78350f]">Daftar Berita</h2>
                <p class="text-stone-500 text-sm mt-1">Update kegiatan dan program kerja terbaru</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-stone-400 bg-white px-4 py-2 rounded-xl shadow-sm border border-stone-100">
                <span class="font-medium text-stone-700">{{ count($berita ?? []) }}</span>
                <span>berita</span>
            </div>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse (($berita ?? []) as $index => $item)
                <div class="reveal group bg-white rounded-2xl overflow-hidden border border-stone-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    
                    {{-- Image --}}
                    <div class="relative h-56 overflow-hidden bg-gradient-to-br from-amber-500 to-[#78350f]">
                        @if (!empty($item['gambar']))
                            <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] ?? 'Berita' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @永久else
                            <div class="w-full h-full flex items-center justify-center text-white text-6xl opacity-30">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent"></div>
                        
                        {{-- Date Badge --}}
                        @if(!empty($item['tanggal']))
                            <div class="absolute bottom-4 left-4 z-10">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-semibold text-stone-700 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $item['tanggal_formatted'] }}
                                </span>
                            </div>
                        @endif
                        
                        {{-- Category Badge --}}
                        @if(!empty($item['kategori']))
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex px-3 py-1.5 bg-amber-600 text-white text-[10px] font-bold uppercase tracking-wider rounded-full shadow-lg">
                                    {{ $item['kategori'] }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Content --}}
                    <div class="p-6 space-y-3">
                        <h3 class="font-bold text-base md:text-lg text-stone-900 leading-tight group-hover:text-amber-600 transition line-clamp-2">
                            {{ $item['judul'] ?? 'Judul Berita' }}
                        </h3>
                        
                        <p class="text-sm text-stone-500 leading-relaxed line-clamp-3">
                            {{ $item['deskripsi'] }}
                        </p>
                        
                        {{-- Meta & Action --}}
                        <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                @if(!empty($item['penulis']))
                                    <span class="text-[10px] text-stone-400 font-medium">
                                        <i class="fas fa-user-edit mr-1"></i> {{ $item['penulis'] }}
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Triggers Modal --}}
                            <button @click="openModal({{ $index }})" class="text-amber-600 text-sm font-semibold hover:underline flex items-center gap-1 group-hover:translate-x-1 transition-transform cursor-pointer">
                                Baca <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full">
                    <div class="relative py-20 px-6 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                        <div class="relative z-10">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-xl mb-6">
                                <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-stone-700 mb-2">Belum Ada Berita</h3>
                            <p class="text-sm text-stone-500">Belum ada berita atau kegiatan yang dipublikasikan saat ini.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- DETAIl BERITA MODAL (READ LIGHTBOX) --}}
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
            <div class="overflow-y-auto w-full h-full legacy-scrollbar">
                
                {{-- Image Area --}}
                <div class="relative h-64 md:h-80 w-full bg-stone-100 flex items-center justify-center overflow-hidden">
                    <template x-if="currentBerita.gambar">
                        <img x-bind:src="currentBerita.gambar" 
                             x-bind:alt="currentBerita.judul || 'Berita'"
                             class="w-full h-full object-cover">
                    </template>
                    <template x-if="!currentBerita.gambar">
                        <div class="w-full h-full flex flex-col items-center justify-center text-6xl text-stone-300 bg-gradient-to-br from-amber-500 to-[#78350f] opacity-40">
                            <i class="fas fa-newspaper text-white text-5xl"></i>
                        </div>
                    </template>

                    {{-- Category inside image context --}}
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
                        <template x-if="currentBerita.tanggal_formatted">
                            <div class="flex items-center gap-1">
                                <i class="far fa-calendar-alt text-amber-600"></i>
                                <span x-text="currentBerita.tanggal_formatted"></span>
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
                    <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line pt-2" x-text="currentBerita.deskripsi"></div>
                </div>

            </div>

            {{-- Footer sticky info --}}
            <div class="p-4 bg-stone-50 border-t border-stone-100 flex items-center justify-between shrink-0">
                <span class="text-xs text-stone-400 font-medium" x-text="`Index: ${currentIndex + 1} dari ${totalBerita} berita`"></span>
                <button @click="closeModal()" 
                        class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                    Selesai Membaca
                </button>
            </div>

        </div>
    </div>
</div>

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