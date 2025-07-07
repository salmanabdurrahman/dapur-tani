<div x-data="{ activeTab: 'deskripsi' }" class="mt-20 lg:mt-24">
    <div class="border-b border-slate-200 mb-8">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button @click="activeTab = 'deskripsi'"
                :class="{ 'border-primary-600 text-primary-600': activeTab === 'deskripsi', 'border-transparent text-slate-500 hover:text-dark hover:border-slate-300': activeTab !== 'deskripsi' }"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-lg transition-colors">Deskripsi</button>
            <button @click="activeTab = 'spesifikasi'"
                :class="{ 'border-primary-600 text-primary-600': activeTab === 'spesifikasi', 'border-transparent text-slate-500 hover:text-dark hover:border-slate-300': activeTab !== 'spesifikasi' }"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-lg transition-colors">Spesifikasi</button>
            <button @click="activeTab = 'ulasan'"
                :class="{ 'border-primary-600 text-primary-600': activeTab === 'ulasan', 'border-transparent text-slate-500 hover:text-dark hover:border-slate-300': activeTab !== 'ulasan' }"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-lg transition-colors">Ulasan
                (12)</button>
        </nav>
    </div>
    <div class="prose max-w-none prose-slate">
        <div x-show="activeTab === 'deskripsi'" x-transition>
            <h3>Kualitas Terbaik dari Alam</h3>
            <p>Tomat ceri organik kami dipanen pada tingkat kematangan puncak untuk memastikan rasa manis alami dan
                tekstur yang renyah. Setiap tomat dipilih secara manual untuk menjamin hanya kualitas terbaik yang
                sampai ke dapur Anda. Ditanam dengan metode pertanian berkelanjutan, produk ini tidak hanya lezat tapi
                juga ramah lingkungan.</p>
            <ul>
                <li>Rasa manis alami dengan sedikit sentuhan asam yang menyegarkan.</li>
                <li>Tekstur padat dan juicy, ideal untuk berbagai masakan.</li>
                <li>Bebas dari pestisida dan bahan kimia berbahaya.</li>
            </ul>
        </div>
        <div x-show="activeTab === 'spesifikasi'" x-transition>
            <h3>Detail Produk</h3>
            <dl class="grid grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <dt class="font-bold text-dark">Asal</dt>
                    <dd>Lereng Gunung Merapi, Yogyakarta</dd>
                </div>
                <div>
                    <dt class="font-bold text-dark">Sertifikasi</dt>
                    <dd>Organik Indonesia</dd>
                </div>
                <div>
                    <dt class="font-bold text-dark">Grade</dt>
                    <dd>Grade A Super</dd>
                </div>
                <div>
                    <dt class="font-bold text-dark">Minimum Order</dt>
                    <dd>1 kg</dd>
                </div>
            </dl>
        </div>
        <div x-show="activeTab === 'ulasan'" x-transition>
            <h3>Ulasan dari Pelanggan</h3>
            <div class="space-y-6">
                <div class="border-b border-slate-200 pb-6">
                    <div class="flex items-center mb-2">
                        <img src="https://i.pravatar.cc/40?u=1" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-bold text-dark">Chef Budi - Hotel Bintang Lima</p>
                            <p class="text-sm text-slate-500 flex items-center">★★★★★</p>
                        </div>
                    </div>
                    <p>"Tomatnya benar-benar segar! Manis dan cocok sekali untuk saus pasta andalan restoran kami.
                        Pengiriman juga selalu on-time."</p>
                </div>
                <div class="border-b border-slate-200 pb-6">
                    <div class="flex items-center mb-2">
                        <img src="https://i.pravatar.cc/40?u=4" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-bold text-dark">Rina - Dapur Sehat Cafe</p>
                            <p class="text-sm text-slate-500 flex items-center">★★★★★</p>
                        </div>
                    </div>
                    <p>"Pelanggan kami suka sekali dengan salad yang menggunakan tomat ini. Warnanya cerah dan rasanya
                        juara."</p>
                </div>
            </div>
        </div>
    </div>
</div>
