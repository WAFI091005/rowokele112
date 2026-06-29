<div class="w-full bg-[#fdfbf7] min-h-screen text-stone-800">
    
    {{-- HERO SECTION - Gaya Premium Kontemporer (Warm Earth Theme) --}}
    <section class="relative min-h-[380px] flex items-center overflow-hidden"
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
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-16 w-full z-10">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                    <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Panel Manajemen Konten</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-3">
                    Dashboard Admin
                    <span class="text-amber-300 block text-2xl md:text-3xl font-bold mt-1">Website KKN Desa Sukamaju</span>
                </h1>
                
                <p class="text-amber-100/80 text-sm md:text-base max-w-xl leading-relaxed">
                    Kelola data informasi website, program kerja, agenda kegiatan, anggota tim, hingga galeri foto secara real-time.
                </p>
            </div>
        </div>
        
        {{-- Wave Bottom --}}
        <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden z-0">
            <svg class="block w-full h-[80px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
            </svg>
        </div>
    </section>

    {{-- KONTEN UTAMA DASHBOARD --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-12 pb-24 -mt-4 relative z-10">
        
        {{-- Status / Flash Alert Message --}}
        @if(session()->has('success'))
            <div class="bg-emerald-50 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-semibold border border-emerald-100 mb-8 flex items-center gap-3 shadow-sm transition-all">
                <i class="fas fa-check-circle text-lg text-emerald-600"></i>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="grid lg:grid-cols-4 gap-8">
            
            {{-- Menu Navigasi Samping (Sidebar) --}}
            <div class="bg-white rounded-3xl shadow-sm border border-stone-100 p-4 h-fit space-y-1.5">
                @php
                    $menus = [
                        'settings' => ['icon' => 'fa-cogs', 'label' => 'Pengaturan Umum'],
                        'prokers'  => ['icon' => 'fa-tasks', 'label' => 'Program Kerja'],
                        'kegiatan' => ['icon' => 'fa-calendar-alt', 'label' => 'Agenda Kegiatan'],
                        'anggota'  => ['icon' => 'fa-users', 'label' => 'Anggota Tim'],
                        'berita'   => ['icon' => 'fa-newspaper', 'label' => 'Berita Desa'],
                        'galeri'   => ['icon' => 'fa-images', 'label' => 'Galeri Foto'],
                    ];
                @endphp

                @foreach($menus as $key => $menu)
                    <button wire:click="switchTab('{{ $key }}')"
                        class="w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all {{ $activeTab === $key ? 'bg-amber-600 text-white shadow-md' : 'text-stone-600 hover:bg-stone-50' }}">
                        <i class="fas {{ $menu['icon'] }} w-5 text-center"></i>
                        <span>{{ $menu['label'] }}</span>
                    </button>
                @endforeach

                {{-- Batas Garis dan Tombol Logout Sistem --}}
                <hr class="border-stone-100 my-2">
                <button wire:click="logout" wire:confirm="Apakah Anda yakin ingin keluar dari Dashboard?"
                    class="w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-rose-600 hover:bg-rose-50">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span>Keluar Sistem</span>
                </button>
            </div>

            {{-- Area Form Input Konten & Tabel Data --}}
            <div class="lg:col-span-3 space-y-8">
                
                {{-- FORM JASA KLIK MENU SETTINGS --}}
                @if($activeTab === 'settings')
                    <div class="bg-white rounded-3xl shadow-sm border border-stone-100 p-8">
                        <h2 class="text-xl font-bold text-stone-900 mb-6"><i class="fas fa-sliders-h text-amber-600 mr-2"></i>Pengaturan Utama Website</h2>
                        <form wire:submit.prevent="saveSettings" class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Nama Desa</label>
                                <input type="text" wire:model="state.nama_desa" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Nama Kelompok</label>
                                <input type="text" wire:model="state.nama_kelompok" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Judul Besar Utama (Hero Text)</label>
                                <input type="text" wire:model="state.hero_text" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Deskripsi Singkat Kelompok KKN</label>
                                <textarea rows="3" wire:model="state.deskripsi" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50"></textarea>
                            </div>
                            <div class="md:col-span-2 flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-amber-600 text-white text-sm font-bold rounded-xl hover:bg-amber-700 transition">
                                    Simpan Pengaturan
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- FORM UNTUK TAB MASTER CRUD --}}
                @if($activeTab !== 'settings')
                    <div class="bg-white rounded-3xl shadow-sm border border-stone-100 p-8">
                        <h2 class="text-xl font-bold text-stone-900 mb-6">
                            <i class="fas {{ ($editKey !== null && $editKey !== '') ? 'fa-edit text-amber-600' : 'fa-plus-circle text-amber-600' }} mr-2"></i>
                            {{ ($editKey !== null && $editKey !== '') ? 'Ubah Konten / Mode Edit' : 'Tambah Data Baru' }} - {{ ucfirst($activeTab) }}
                        </h2>

                        <form wire:submit.prevent="saveData" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                
                                @if(in_array($activeTab, ['prokers', 'kegiatan', 'anggota', 'berita']))
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">
                                            {{ $activeTab === 'anggota' ? 'Nama Lengkap Mahasiswa' : 'Judul/Nama Konten' }}
                                        </label>
                                        <input type="text" wire:model="state.judul" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50" required>
                                    </div>
                                @endif

                                @if($activeTab === 'anggota')
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">NIM</label>
                                        <input type="text" wire:model="state.nim" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Jabatan</label>
                                        <input type="text" wire:model="state.jabatan" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50" placeholder="Ketua / Sekretaris / Anggota">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Jurusan</label>
                                        <input type="text" wire:model="state.jurusan" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50" placeholder="Informatika / Sistem Informasi">
                                    </div>
                                @endif

                                @if(in_array($activeTab, ['prokers', 'kegiatan', 'berita']))
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Tanggal</label>
                                        <input type="date" wire:model="state.tanggal" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                                    </div>
                                @endif

                                @if(in_array($activeTab, ['prokers', 'kegiatan']))
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Status Progress</label>
                                        <select wire:model="state.status" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                                            <option value="rencana">Rencana</option>
                                            <option value="berjalan">Berjalan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                @endif

                                @if($activeTab === 'galeri')
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Caption / Keterangan Foto</label>
                                        <input type="text" wire:model="state.caption" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50" placeholder="Tulis deskripsi singkat tentang foto...">
                                    </div>
                                @endif

                                @if(in_array($activeTab, ['prokers', 'kegiatan', 'berita']))
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Isi Deskripsi / Detail Cerita</label>
                                        <textarea rows="4" wire:model="state.deskripsi" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50"></textarea>
                                    </div>
                                @endif

                                @if(in_array($activeTab, ['prokers', 'kegiatan', 'berita', 'galeri', 'anggota']))
                                    <div class="md:col-span-2 bg-stone-50 p-4 rounded-2xl border border-dashed border-stone-200 space-y-4">
                                        <label class="block text-xs font-bold text-stone-700 uppercase">Upload Gambar Pendukung</label>
                                        
                                        <div class="flex items-center gap-4">
                                            @php
                                                $oldImg = $state['img'] ?? ($state['thumbnail'] ?? ($state['image_url'] ?? ($state['foto'] ?? null)));
                                            @endphp
                                            
                                            @if($oldImg && !$newImage)
                                                <div class="w-20 h-20 rounded-xl overflow-hidden border border-stone-200 bg-white shadow-sm shrink-0">
                                                    <img src="{{ $oldImg }}" class="w-full h-full object-cover">
                                                </div>
                                            @endif

                                            @if($newImage)
                                                <div class="w-20 h-20 rounded-xl overflow-hidden border border-amber-300 bg-white shadow-sm shrink-0">
                                                    <img src="{{ $newImage->temporaryUrl() }}" class="w-full h-full object-cover">
                                                </div>
                                            @endif

                                            <input type="file" wire:model="newImage" class="text-sm text-stone-500">
                                        </div>
                                        <div wire:loading wire:target="newImage" class="text-xs text-amber-600 mt-2"><i class="fas fa-spinner fa-spin mr-1"></i>Sedang memproses file...</div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-end gap-2">
                                @if($editKey !== null && $editKey !== '')
                                    <button type="button" wire:click="cancelEdit" class="px-5 py-2.5 bg-stone-100 text-stone-700 text-sm font-semibold rounded-xl hover:bg-stone-200">Batal</button>
                                @endif
                                <button type="submit" class="px-6 py-2.5 bg-amber-600 text-white text-sm font-bold rounded-xl hover:bg-amber-700 transition">
                                    {{ ($editKey !== null && $editKey !== '') ? 'Simpan Perubahan' : 'Tambah ke Database' }}
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- TABEL TAMPILAN DATA LOG --}}
                @if($activeTab !== 'settings')
                    <div class="bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden">
                        <div class="px-8 py-4 border-b border-stone-100 bg-stone-50/50">
                            <h3 class="font-bold text-stone-800 text-sm">Daftar Log Riwayat: {{ ucfirst($activeTab) }}</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-stone-100 text-xs font-bold text-stone-400 uppercase bg-stone-50/30">
                                        <th class="p-4 pl-8">Nama Konten</th>
                                        <th class="p-4">Info Utama</th>
                                        <th class="p-4 pr-8 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                                    @php $items = $this->{$activeTab} ?? []; @endphp
                                    @forelse($items as $item)
                                        @if(isset($item['id']))
                                            <tr class="hover:bg-stone-50/40 transition" wire:key="row-{{ $activeTab }}-{{ $item['id'] }}">
                                                <td class="p-4 pl-8 font-semibold text-stone-900">
                                                    {{ $item['judul'] ?? ($item['caption'] ?? ($item['nama'] ?? 'Tanpa Judul')) }}
                                                </td>
                                                <td class="p-4 text-xs">
                                                    @if(isset($item['status']))
                                                        <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 font-bold uppercase text-[10px]">{{ $item['status'] }}</span>
                                                    @endif
                                                    @if(isset($item['tanggal']))
                                                        <span class="text-stone-400 ml-2"><i class="far fa-calendar-alt"></i> {{ $item['tanggal'] }}</span>
                                                    @endif
                                                </td>
                                                <td class="p-4 pr-8 text-right">
                                                    <div class="inline-flex gap-2">
                                                        {{-- Tombol Edit --}}
                                                        <button type="button" wire:click="startEdit('{{ $item['id'] }}')" class="text-amber-600 p-2 hover:bg-amber-50 rounded-lg transition">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        
                                                        {{-- Tombol Hapus --}}
                                                        <button type="button" 
                                                                wire:click="deleteData('{{ $activeTab }}', '{{ $item['id'] }}')" 
                                                                wire:confirm="Hapus data ini secara permanen dari Firebase?" 
                                                                class="text-rose-600 p-2 hover:bg-rose-50 rounded-lg transition">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="3" class="p-8 text-center text-stone-400">
                                                <i class="fas fa-box-open block text-xl mb-1 text-stone-300"></i> Belum ada data tersimpan di Firebase.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>