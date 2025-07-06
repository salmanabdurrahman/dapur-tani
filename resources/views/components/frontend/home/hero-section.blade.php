<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 text-center">
        <div class="mx-auto max-w-3xl">
            <h1 class="text-dark text-4xl leading-tight font-black tracking-tight md:text-6xl">
                Temukan Pasokan <span class="text-primary-600">Segar & Berkualitas</span> untuk Bisnis Anda
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-slate-600">
                Dapur Tani adalah jembatan digital antara bisnis kuliner Anda dengan petani dan pemasok
                terverifikasi di seluruh Indonesia.
            </p>
        </div>
        <div class="mx-auto mt-10 max-w-2xl">
            <form method="POST" class="relative">
                @csrf
                <input type="text" placeholder="Cari produk apa hari ini? (misal: Tomat Ceri)"
                    class="focus:ring-primary-500 focus:border-primary-500 w-full rounded-xl border-2 border-primary-300 py-4 pr-36 pl-5 text-lg shadow-sm focus:outline-primary-500"
                    required />
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 absolute inset-y-0 right-2.5 my-2.5 rounded-lg px-6 text-lg font-semibold text-white transition-colors">
                    Cari
                </button>
            </form>
        </div>
    </div>
</section>
