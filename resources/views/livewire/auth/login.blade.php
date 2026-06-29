<div class="w-full bg-[#fdfbf7] min-h-screen flex items-center justify-center pt-20">
    <div class="w-full max-w-md p-8 bg-white rounded-3xl shadow-sm border border-stone-100 mx-4">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-[#78350f]">Masuk Admin</h1>
            <p class="text-stone-500 text-sm mt-1">Gunakan kredensial Firebase untuk mengelola website.</p>
        </div>

        @if(session()->has('error'))
            <div class="bg-rose-50 text-rose-700 p-4 rounded-xl text-sm font-semibold border border-rose-100 mb-5">
                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login" autocomplete="off" class="space-y-5">
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Username</label>
                <input type="text" wire:model="username" autocomplete="off" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50 focus:border-amber-500 focus:ring-amber-500" placeholder="Masukkan username" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Password</label>
                <input type="password" wire:model="password" autocomplete="new-password" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50 focus:border-amber-500 focus:ring-amber-500" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl shadow-md transition flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt"></i> Masuk Sistem
            </button>
        </form>
    </div>
</div>