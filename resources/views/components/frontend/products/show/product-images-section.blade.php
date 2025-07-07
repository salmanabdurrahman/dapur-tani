<div x-data="{ mainImage: 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=1200' }">
    <div class="mb-4 bg-white p-4 rounded-2xl shadow-lg border border-slate-200">
        <img :src="mainImage" alt="Tomat Ceri Organik" class="w-full h-96 object-cover rounded-xl" loading="lazy">
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div @click="mainImage = 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=600'"
            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=600' }">
            <img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=300"
                class="w-full h-24 object-cover rounded-lg" loading="lazy">
        </div>
        <div @click="mainImage = 'https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=600'"
            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=600' }">
            <img src="https://images.unsplash.com/photo-1588694853934-2453e19819c2?q=80&w=300"
                class="w-full h-24 object-cover rounded-lg" loading="lazy">
        </div>
        <div @click="mainImage = 'https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=600'"
            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=600' }">
            <img src="https://images.unsplash.com/photo-1561136594-7247da04a294?q=80&w=300"
                class="w-full h-24 object-cover rounded-lg" loading="lazy">
        </div>
        <div @click="mainImage = 'https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=600'"
            class="rounded-xl cursor-pointer ring-2 ring-transparent hover:ring-primary-600 transition-all"
            :class="{ '!ring-primary-600': mainImage === 'https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=600' }">
            <img src="https://images.unsplash.com/photo-1615485925348-3c46d4a0344b?q=80&w=300"
                class="w-full h-24 object-cover rounded-lg" loading="lazy">
        </div>
    </div>
</div>
