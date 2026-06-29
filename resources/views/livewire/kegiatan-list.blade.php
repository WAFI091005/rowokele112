{{-- resources/views/livewire/kegiatan-list.blade.php --}}
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
                    <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Agenda & Event</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                    Kegiatan Desa
                    <span class="text-amber-300 block mt-2">KKN Desa Rowokele</span>
                </h1>
                
                <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed mb-8">
                    Temukan rincian jadwal, dokumentasi, dan status pelaksanaan seluruh kegiatan pengabdian masyarakat kami.
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
    <section class="max-w-7xl mx-auto px-6 lg:px-12 -mt-4 relative z-10 hidden md:block">
        <div class="bg-white rounded-2xl shadow-lg border border-stone-200 p-4 md:p-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="text-sm font-semibold text-stone-700">Filter Status:</span>
                </div>
                
                <div class="flex flex-wrap gap-2 w-full md:w-auto">
                    @foreach ($statusFilters as $key => $label)
                        <button 
                            wire:click="setFilter('{{ $key }}')"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 cursor-pointer
                                {{ $filter === $key 
                                    ? 'bg-amber-600 text-white shadow-lg shadow-amber-600/30 scale-105' 
                                    : 'bg-stone-100 text-stone-600 hover:bg-amber-50 hover:text-amber-600 hover:scale-105' 
                                }}
                                border-2 border-transparent
                                {{ $filter === $key ? 'border-amber-600' : 'hover:border-amber-200' }}
                            "
                        >
                            {{ $label }}
                            <span class="inline-flex items-center justify-center w-5 h-5 ml-1 text-xs rounded-full
                                {{ $filter === $key ? 'bg-white/20 text-white' : 'bg-stone-200 text-stone-600' }}
                            ">
                                @if($key === 'semua')
                                    {{ count($allKegiatan) }}
                                @else
                                    {{ count(array_filter($allKegiatan, fn($item) => strtolower($item['status'] ?? 'rencana') === $key)) }}
                                @endif
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- GRID CARDS --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($list as $index => $event)
                <div class="group bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500"
                     style="transition-delay: {{ $loop->index * 80 }}ms">
                    
                    <div class="relative h-52 overflow-hidden bg-gradient-to-br from-amber-600 to-[#78350f]">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700"
                             style="background-image: url('{{ $event['img'] ?? 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=600&q=80' }}')">
                        </div>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/30 to-transparent"></div>
                        
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg backdrop-blur-sm
                                @if(strtolower($event['status'] ?? '') === 'selesai') bg-amber-700 text-white
                                @elseif(strtolower($event['status'] ?? '') === 'berjalan') bg-orange-500 text-white
                                @else bg-stone-100 text-stone-800 backdrop-blur-md @endif">
                                
                                @if(strtolower($event['status'] ?? '') === 'selesai')
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                @elseif(strtolower($event['status'] ?? '') === 'berjalan')
                                    <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                @else
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                                {{ $event['status'] ?? 'Rencana' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-sm md:text-base text-stone-900 leading-tight group-hover:text-amber-600 transition line-clamp-2">
                            {{ $event['title'] ?? ($event['judul'] ?? 'Untitled Event') }}
                        </h3>
                        
                        <p class="text-xs text-stone-500 leading-relaxed line-clamp-3 font-light">
                            {{ $event['deskripsi'] ?? 'Rincian deskripsi mengenai agenda kegiatan desa ini belum diterbitkan.' }}
                        </p>
                        
                        <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-[10px] text-stone-400 font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ isset($event['tanggal']) ? date('d M Y', strtotime($event['tanggal'])) : ($event['date'] ?? 'Coming Soon') }}
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-stone-700 mb-2">Tidak Ada Kegiatan</h3>
                            <p class="text-sm text-stone-500">Untuk status <span class="font-semibold text-amber-600">{{ ucfirst($filter) }}</span>, tidak ada data kegiatan.</p>
                            @if($filter !== 'semua')
                                <button wire:click="resetFilter" class="mt-6 px-6 py-3 bg-amber-600 text-white rounded-xl text-sm font-semibold hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                                    Tampilkan Semua Kegiatan
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- MODAL --}}
    @if($showModal && $selectedKegiatan)
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
                        <img src="{{ $selectedKegiatan['img'] ?? 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=600&q=80' }}" 
                             alt="{{ $selectedKegiatan['title'] ?? $selectedKegiatan['judul'] ?? 'Kegiatan' }}"
                             class="w-full h-full object-cover">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-4 left-6 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg text-white
                                @if(strtolower($selectedKegiatan['status'] ?? '') === 'selesai') bg-amber-700
                                @elseif(strtolower($selectedKegiatan['status'] ?? '') === 'berjalan') bg-orange-500
                                @else bg-stone-500 @endif">
                                {{ $selectedKegiatan['status'] ?? 'Rencana' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 space-y-4">
                        
                        <div class="flex items-center gap-1.5 text-xs text-stone-400 border-b border-stone-100 pb-4">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">
                                {{ isset($selectedKegiatan['tanggal']) ? date('d F Y', strtotime($selectedKegiatan['tanggal'])) : ($selectedKegiatan['date'] ?? 'Coming Soon') }}
                            </span>
                        </div>

                        <h2 class="text-2xl md:text-3xl font-bold text-stone-900 leading-tight">
                            {{ $selectedKegiatan['title'] ?? $selectedKegiatan['judul'] ?? 'Untitled Event' }}
                        </h2>
                        
                        <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line pt-2">
                            {{ $selectedKegiatan['deskripsi'] ?? 'Rincian deskripsi mengenai agenda kegiatan desa ini belum diterbitkan.' }}
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-stone-50 border-t border-stone-100 flex items-center justify-end shrink-0">
                    <button wire:click="closeModal()" 
                            class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-lg shadow-amber-600/30">
                        Tutup Detail
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>