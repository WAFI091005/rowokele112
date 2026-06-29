<div class="w-full bg-[#fdfbf7]">
    
    {{-- HERO SECTION --}}
    <section class="relative min-h-[450px] flex items-center overflow-hidden"
             style="background: linear-gradient(135deg, #78350f, #b45309);">
        
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-kegiatan" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-kegiatan)" />
            </svg>
        </div>
        
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                    <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Program Kerja</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                    Program Kerja
                    <span class="text-amber-300 block mt-2">KKN Desa Rowokele</span>
                </h1>
                
                <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed mb-8">
                    Daftar agenda dan klasifikasi seluruh kegiatan pengabdian masyarakat yang telah, sedang, dan akan dilaksanakan.
                </p>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
            <svg class="block w-full h-[120px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
            </svg>
        </div>
    </section>

{{-- FILTER SECTION --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 -mt-12 relative z-10 hidden md:block">
        <div class="bg-white rounded-3xl shadow-xl border border-stone-100 p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="text-sm font-semibold text-stone-700">Filter:</span>
                </div>
                
                <div class="flex flex-wrap gap-2">
                    @foreach (['semua' => 'Semua', 'rencana' => 'Rencana', 'berjalan' => 'Berjalan', 'selesai' => 'Selesai'] as $key => $label)
                        <button wire:click="setFilter('{{ $key }}')"
                            class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 cursor-pointer
                            {{ $filter === $key 
                                ? 'bg-amber-600 text-white shadow-lg shadow-amber-600/30 scale-105' 
                                : 'bg-stone-50 text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                            {{ $label }}
                            <span class="inline-flex items-center justify-center w-5 h-5 ml-1 text-xs rounded-full
                                {{ $filter === $key ? 'bg-white/20 text-white' : 'bg-stone-200 text-stone-600' }}
                            ">
                                @if($key === 'semua')
                                    {{ count($prokers) }}
                                @else
                                    {{ count(array_filter($prokers, fn($item) => strtolower($item['status'] ?? 'rencana') === $key)) }}
                                @endif
                            </span>
                        </button>
                    @endforeach
                </div>
                
                <div class="flex items-center gap-2 text-sm text-stone-400">
                    <span class="font-medium text-amber-600">{{ count($list) }}</span>
                    <span>program ditemukan</span>
                </div>
            </div>
        </div>
    </section>

    {{-- GRID CARDS --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($list as $index => $p)
                <div class="group bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500"
                     style="transition-delay: {{ $loop->index * 80 }}ms">
                    
                    <div class="relative h-52 overflow-hidden bg-gradient-to-br from-amber-500 to-[#78350f]">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700"
                             style="background-image: url('{{ $p['gambar'] ?? ($p['img'] ?? 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80') }}')">
                        </div>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/30 to-transparent"></div>
                        
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg backdrop-blur-sm
                                @if(strtolower($p['status'] ?? '') === 'selesai') bg-amber-700 text-white
                                @elseif(strtolower($p['status'] ?? '') === 'berjalan') bg-orange-500 text-white
                                @else bg-stone-100 text-stone-800 backdrop-blur-md @endif">
                                
                                @if(strtolower($p['status'] ?? '') === 'selesai')
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                @elseif(strtolower($p['status'] ?? '') === 'berjalan')
                                    <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                @else
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                                {{ $p['status'] ?? 'Rencana' }}
                            </span>
                        </div>

                        @if($loop->index < 2)
                            <div class="absolute top-4 right-4 z-10">
                                <span class="flex items-center gap-1 px-2.5 py-1.5 bg-amber-400/90 backdrop-blur-sm text-white text-[8px] font-black uppercase tracking-wider rounded-full shadow-lg">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Prioritas
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-sm md:text-base text-stone-900 leading-tight group-hover:text-amber-600 transition line-clamp-2">
                            {{ $p['judul'] ?? 'Untitled Activity' }}
                        </h3>
                        
                        <p class="text-xs text-stone-500 leading-relaxed line-clamp-3 font-light">
                            {{ $p['deskripsi'] ?? 'Deskripsi kegiatan belum tersedia.' }}
                        </p>
                        
                        <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-[10px] text-stone-400 font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ !empty($p['tanggal']) ? date('d M Y', strtotime($p['tanggal'])) : 'Coming Soon' }}
                            </div>
                            
                            <button wire:click="openModal({{ $index }})" 
                                    class="text-stone-400 hover:text-amber-600 transition-colors group-hover:translate-x-1 transition-transform duration-300 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="relative py-20 px-6 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                        <div class="relative z-10">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-xl mb-6">
                                <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-stone-700 mb-2">Belum Ada Program Kerja</h3>
                            <p class="text-sm text-stone-500">Untuk kategori <span class="font-semibold text-amber-600">{{ ucfirst($filter) }}</span>, belum ada program yang tercatat</p>
                            @if($filter !== 'semua')
                                <button wire:click="resetFilter" class="mt-6 px-6 py-3 bg-amber-600 text-white rounded-xl text-sm font-semibold hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                                    Lihat Semua Program
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @if(count($list) > 0 && count($list) >= 8)
            <div class="mt-12 text-center">
                <button class="group inline-flex items-center gap-2 px-8 py-4 bg-white border-2 border-stone-200 hover:border-amber-600 rounded-2xl text-sm font-semibold text-stone-600 hover:text-amber-600 transition-all duration-300 hover:shadow-lg">
                    <span>Muat Lebih Banyak</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </div>
        @endif
    </section>

    {{-- MODAL --}}
    @if($showModal && $selectedProker)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
             wire:click.self="closeModal()"
             x-data="{ open: true }"
             x-init="setTimeout(() => { open = true }, 100)"
             x-show="open"
             x-transition:enter.duration.300
             x-transition:leave.duration.300>
            
            <div class="relative max-w-3xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col">
                
                <button wire:click="closeModal()" 
                        class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition duration-300 hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                
                <div class="overflow-y-auto w-full h-full">
                    
                    <div class="relative h-64 md:h-80 w-full bg-stone-100 flex items-center justify-center overflow-hidden">
                        <img src="{{ $selectedProker['gambar'] ?? ($selectedProker['img'] ?? 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80') }}" 
                             alt="{{ $selectedProker['judul'] ?? 'Program Kerja' }}"
                             class="w-full h-full object-cover">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-4 left-6 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg text-white
                                @if(strtolower($selectedProker['status'] ?? '') === 'selesai') bg-amber-700
                                @elseif(strtolower($selectedProker['status'] ?? '') === 'berjalan') bg-orange-500
                                @else bg-stone-500 @endif">
                                {{ $selectedProker['status'] ?? 'Rencana' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 space-y-4">
                        
                        <div class="flex items-center gap-1.5 text-xs text-stone-400 border-b border-stone-100 pb-4">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">
                                {{ isset($selectedProker['tanggal']) ? date('d F Y', strtotime($selectedProker['tanggal'])) : 'Coming Soon' }}
                            </span>
                        </div>

                        <h2 class="text-2xl md:text-3xl font-bold text-stone-900 leading-tight">
                            {{ $selectedProker['judul'] ?? 'Untitled Activity' }}
                        </h2>
                        
                        <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line pt-2">
                            {{ $selectedProker['deskripsi'] ?? 'Deskripsi program kerja belum tersedia.' }}
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-stone-50 border-t border-stone-100 flex items-center justify-between shrink-0">
                    <span class="text-xs text-stone-400 font-medium">
                        @php
                            $currentIndex = array_search($selectedProker, $list);
                        @endphp
                        {{ ($currentIndex + 1) }} dari {{ count($list) }} program
                    </span>
                    <button wire:click="closeModal()" 
                            class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                        Tutup Detail
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>