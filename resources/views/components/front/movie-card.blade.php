<div class="group relative cursor-pointer">
    <div class="overflow-hidden rounded-md shadow-md aspect-[2/3] bg-zinc-800">
        <img src="{{ $image }}" alt="{{ $title }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition duration-300 ease-in-out">
        
        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition duration-300 flex items-center justify-center">
            <span class="opacity-0 group-hover:opacity-100 bg-brand-red text-white text-xs font-bold px-4 py-2 rounded-full transform translate-y-4 group-hover:translate-y-0 transition">
                BOOK NOW
            </span>
        </div>
    </div>
    <div class="mt-3">
        <h3 class="text-white font-bold text-base truncate">{{ $title }}</h3>
        <p class="text-gray-400 text-xs">2024</p>
    </div>
</div>