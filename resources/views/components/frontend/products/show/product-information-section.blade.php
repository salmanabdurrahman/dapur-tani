<div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
    <div class="flex justify-between items-start">
        <div>
            <span class="bg-primary-100 text-primary-700 font-bold text-sm px-3 py-1 rounded-full">Sayuran
                Buah</span>
            <h1 class="text-4xl font-extrabold text-dark mt-4">Tomat Ceri Organik</h1>
        </div>
        <div class="bg-primary-500 text-white text-sm font-bold px-3 py-1 rounded-full">TERSEDIA</div>
    </div>
    <div class="mt-8 pt-6 border-t border-slate-200">
        <p class="text-slate-500">Harga</p>
        <p class="text-4xl font-extrabold text-primary-600">
            Rp 25.000 <span class="text-xl font-semibold text-slate-500">/ kg</span>
        </p>
        <p class="text-sm text-slate-500 mt-1">Minimum pemesanan: 1 kg</p>
    </div>
    <div x-data="{ quantity: 1 }" class="mt-8 space-y-4">
        <div class="flex items-center justify-between">
            <label class="font-bold text-dark">Jumlah</label>
            <div class="flex items-center border-2 border-slate-200 rounded-lg">
                <button @click="quantity = Math.max(1, quantity - 1)"
                    class="px-4 py-2.5 text-slate-500 hover:bg-slate-100 rounded-l-md transition"><svg class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg></button>
                <input type="text" x-model="quantity"
                    class="w-16 text-center text-lg font-bold border-none focus:ring-0 focus:outline-none" readonly>
                <button @click="quantity++"
                    class="px-4 py-2.5 text-slate-500 hover:bg-slate-100 rounded-r-md transition"><svg class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg></button>
            </div>
        </div>
        <button
            class="w-full flex items-center justify-center gap-3 bg-primary-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-primary-300 transform hover:-translate-y-0.5">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.841a.75.75 0 0 0-.543-.922l-13.5-3A.75.75 0 0 0 4.5 5.69l.522 1.942a.75.75 0 0 0 .674.528a.75.75 0 0 0 .674-.528L6.61 5.244a.75.75 0 0 1 .543-.922l13.5-3a.75.75 0 0 1 .922.543l-1.823 6.841a1.125 1.125 0 0 1-1.087.835H7.5Z" />
            </svg>
            <span>Tambah ke Keranjang</span>
        </button>
    </div>
    <div class="mt-8 pt-6 border-t border-slate-200">
        <p class="font-bold text-dark mb-3">Informasi Pemasok</p>
        <div class="flex items-center">
            <img src="https://i.pravatar.cc/60?u=kebutani" alt="Logo Pemasok"
                class="w-14 h-14 rounded-full border-2 border-white shadow-md" loading="lazy">
            <div class="ml-4">
                <a href="#" class="font-bold text-dark hover:text-primary-600 transition-colors">Kebun
                    Tani Sejahtera</a>
                <div class="flex items-center text-sm text-slate-500 mt-1">
                    <svg class="w-4 h-4 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    4.9 (230 Ulasan)
                </div>
            </div>
        </div>
    </div>
</div>
