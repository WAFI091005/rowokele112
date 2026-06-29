<div class="w-full bg-[#fdfbf7]" x-data="galeriApp()" x-init="initGaleri()">
    
    {{-- HERO SECTION - Gaya Premium Kontemporer (Warm Earth Theme) --}}
    <section class="relative min-h-[350px] flex items-center overflow-hidden"
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
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-16 w-full">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                    <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Dokumentasi</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                    Galeri Kegiatan
                    <span class="text-amber-300 block mt-2">KKN Desa Rowokele</span>
                </h1>
                
                <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed">
                    Dokumentasi lengkap kegiatan dan program kerja yang telah dilaksanakan oleh tim.
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

    {{-- GALERI GRID --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
        
        {{-- Header --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#78350f]">Dokumentasi Kegiatan</h2>
                <p class="text-stone-500 text-sm mt-1">Klik foto untuk melihat lebih detail</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-stone-400 bg-white px-4 py-2 rounded-xl shadow-sm border border-stone-100">
                <span class="font-medium text-stone-700">{{ count($galeri ?? []) }}</span>
                <span>foto</span>
            </div>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse (($galeri ?? []) as $index => $g)
                <div @click="openModal({{ $index }})"
                     class="reveal group relative rounded-2xl overflow-hidden shadow-sm bg-stone-100 aspect-square cursor-pointer hover:shadow-xl transition-all duration-500 hover:-translate-y-1"
                     style="transition-delay: {{ $loop->index * 60 }}ms">
                    
                    @if (!empty($g['image_url']))
                        <img src="{{ $g['image_url'] }}" 
                             alt="{{ $g['caption'] ?? 'Foto kegiatan' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl text-stone-300 bg-gradient-to-br from-stone-50 to-stone-100">
                            📸
                        </div>
                    @endif
                    
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/70 via-stone-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Caption --}}
                    @if(!empty($g['caption']))
                        <div class="absolute bottom-0 inset-x-0 p-3">
                            <p class="text-white text-xs font-medium line-clamp-2 drop-shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                {{ $g['caption'] }}
                            </p>
                        </div>
                    @endif
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full">
                    <div class="relative py-20 px-6 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                        <div class="relative z-10">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-xl mb-6">
                                <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-stone-700 mb-2">Belum Ada Foto</h3>
                            <p class="text-sm text-stone-500">Belum ada dokumentasi kegiatan yang diunggah saat ini.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- LIGHTBOX MODAL --}}
    <div x-show="isOpen" 
         x-transition:enter.duration.300
         x-transition:leave.duration.300
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm p-4"
         @click.away="closeModal()"
         @keydown.escape="closeModal()"
         style="display: none;">
        
        <div class="relative max-w-4xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl">
            {{-- Close Button --}}
            <button @click="closeModal()" 
                    class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            {{-- Navigation Buttons --}}
            <button @click="prevImage()" 
                    x-show="totalImages > 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            
            <button @click="nextImage()" 
                    x-show="totalImages > 1"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            
            {{-- Image Container --}}
            <div class="relative w-full h-[60vh] bg-stone-100 flex items-center justify-center">
                <template x-if="currentImage.image_url">
                    <img x-bind:src="currentImage.image_url" 
                         x-bind:alt="currentImage.caption || 'Foto kegiatan'"
                         class="w-full h-full object-contain">
                </template>
                <template x-if="!currentImage.image_url">
                    <div class="text-6xl text-stone-300">📸</div>
                </template>
            </div>
            
            {{-- Footer Info --}}
            <div class="p-6 bg-white">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-stone-800" x-text="currentImage.caption || 'Foto kegiatan'"></p>
                        <p class="text-xs text-stone-400" x-text="`${currentIndex + 1} dari ${totalImages} foto`"></p>
                    </div>
                    <button @click="closeModal()" 
                            class="px-4 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function galeriApp() {
        return {
            galeri: @json($galeri ?? []),
            isOpen: false,
            currentIndex: 0,
            totalImages: 0,
            currentImage: {},
            
            initGaleri() {
                this.totalImages = this.galeri.length;
                if (this.totalImages > 0) {
                    this.currentImage = this.galeri[0] || {};
                }
            },
            
            openModal(index) {
                if (this.galeri.length > 0) {
                    this.currentIndex = index;
                    this.currentImage = this.galeri[index] || {};
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                }
            },
            
            closeModal() {
                this.isOpen = false;
                document.body.style.overflow = 'auto';
            },
            
            nextImage() {
                if (this.currentIndex < this.totalImages - 1) {
                    this.currentIndex++;
                    this.currentImage = this.galeri[this.currentIndex] || {};
                }
            },
            
            prevImage() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                    this.currentImage = this.galeri[this.currentIndex] || {};
                }
            }
        };
    }
</script>