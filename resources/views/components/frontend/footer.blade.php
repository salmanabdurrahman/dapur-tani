<footer class="border-t border-slate-200 bg-white">
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-12">
            <div class="col-span-2 md:col-span-4">
                <a href="{{ route('home') }}" class="mb-4 flex items-center">
                    <span class="text-primary-600 text-2xl font-extrabold">Dapur Tani</span>
                </a>
                <p class="max-w-xs text-sm text-slate-600">
                    Platform B2B untuk rantai pasok pangan yang adil, transparan, dan efisien.
                </p>
            </div>
            <div class="col-span-1 md:col-span-2">
                <h4 class="text-dark mb-4 font-bold">Platform</h4>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li><a href="{{ route('products.index') }}" class="hover:text-primary-600">Produk</a></li>
                    <li><a href="#" class="hover:text-primary-600">Jadi Pemasok</a></li>
                    <li><a href="#" class="hover:text-primary-600">Fitur</a></li>
                </ul>
            </div>
            <div class="col-span-1 md:col-span-2">
                <h4 class="text-dark mb-4 font-bold">Perusahaan</h4>
                <ul class="space-y-3 text-sm text-slate-600">
                    <li><a href="{{ route('about-us') }}" class="hover:text-primary-600">Tentang</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-primary-600">Hubungi Kami</a></li>
                </ul>
            </div>
            <div class="col-span-2 md:col-span-4">
                <h4 class="text-dark mb-4 font-bold">Dapatkan Info Terbaru</h4>
                <form action="#" method="POST" class="mt-2 flex items-center">
                    @csrf
                    <input type="email" placeholder="Email Anda"
                        class="focus:ring-primary-500 focus:border-primary-500 w-full rounded-l-lg px-4 py-2.5 text-sm focus:outline-primary-500 border border-solid border-primary-300"
                        required />
                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 rounded-r-lg px-5 py-2.5 font-semibold text-white transition-colors">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
        <div
            class="mt-16 flex flex-col items-center justify-between border-t border-slate-200 pt-8 text-sm text-slate-500 md:flex-row">
            <p>&copy; 2025 Dapur Tani. All Rights Reserved.</p>
            <div class="mt-4 flex space-x-6 md:mt-0">
                <a href="#" class="hover:text-primary-600">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-primary-600">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>
