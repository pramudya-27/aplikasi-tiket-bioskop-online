@extends('layouts.app')

@section('content')
    @include('components.front.hero-slider')

    <div class="container mx-auto px-6 py-12">
        
        <div class="flex flex-col items-center mb-10">
            <h2 class="text-2xl font-black uppercase flex items-center">
                TOP <span class="bg-brand-teal text-white px-2 py-1 ml-2">MOVIES</span>
            </h2>
            <div class="w-full h-[1px] bg-gray-200 mt-4"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 mb-16">
            @include('components.front.movie-card', ['title' => 'The Super Mario Bros', 'image' => 'https://image.tmdb.org/t/p/w500/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg'])
            @include('components.front.movie-card', ['title' => 'Avatar: Way of Water', 'image' => 'https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg'])
            @include('components.front.movie-card', ['title' => 'Guardians of Galaxy', 'image' => 'https://image.tmdb.org/t/p/w500/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg'])
            @include('components.front.movie-card', ['title' => 'John Wick 4', 'image' => 'https://image.tmdb.org/t/p/w500/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg'])
            @include('components.front.movie-card', ['title' => 'Spider-Man: Across', 'image' => 'https://image.tmdb.org/t/p/w500/8Vt6mWEReuy4Of61Lnj5Xj704m8.jpg'])
        </div>

        <div class="flex flex-col items-center mb-10">
            <h2 class="text-2xl font-black uppercase flex items-center">
                ALL <span class="bg-brand-teal text-white px-2 py-1 ml-2">MOVIES</span>
            </h2>
            <div class="w-full h-[1px] bg-gray-200 mt-4"></div>
        </div>

         <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @include('components.front.movie-card', ['title' => 'Fast X', 'image' => 'https://image.tmdb.org/t/p/w500/fiVW06jE7z9YnO4trhaMEdclSiC.jpg'])
            @include('components.front.movie-card', ['title' => 'The Flash', 'image' => 'https://image.tmdb.org/t/p/w500/rktDFPbfHfUbArZ6OOOKsXcv0Bm.jpg'])
            @include('components.front.movie-card', ['title' => 'Transformers', 'image' => 'https://image.tmdb.org/t/p/w500/yi5KcJqFxy0D6yP8nCfcF8gqFh.jpg'])
            @include('components.front.movie-card', ['title' => 'Elemental', 'image' => 'https://image.tmdb.org/t/p/w500/4Y1WNkd88JXmGfhtWR7dmDAo1T2.jpg'])
            @include('components.front.movie-card', ['title' => 'Indiana Jones', 'image' => 'https://image.tmdb.org/t/p/w500/Af4bXE63pVsb2FzxWTuTG2I34y2.jpg'])
        </div>

    </div>
@endsection