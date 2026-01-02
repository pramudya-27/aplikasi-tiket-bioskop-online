@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-20 pt-32">
        <div class="flex flex-col items-center mb-10">
            <h1 class="text-4xl font-black mb-4 uppercase">
                GENRE : <span class="text-brand-teal">{{ $slug ? str_replace('-', ' ', $slug) : 'ALL' }}</span>
            </h1>
            <div class="w-full h-[1px] bg-gray-800 mt-4"></div>
        </div>

        @if($slug)
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <!-- Mock Data for Filtered Results -->
                @include('components.front.movie-card', ['title' => 'Sample Movie 1', 'image' => 'https://image.tmdb.org/t/p/w500/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg'])
                @include('components.front.movie-card', ['title' => 'Sample Movie 2', 'image' => 'https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg'])
                @include('components.front.movie-card', ['title' => 'Sample Movie 3', 'image' => 'https://image.tmdb.org/t/p/w500/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg'])
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-xl text-gray-400">Please select a genre from the menu.</p>
            </div>
        @endif
    </div>
@endsection
