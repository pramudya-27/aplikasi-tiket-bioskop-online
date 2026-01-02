@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-20 pt-32 text-center">
        <h1 class="text-4xl font-black mb-4">A - Z <span class="text-brand-teal">LIST</span></h1>
        <p class="text-gray-400 mb-8">Browse movies alphabetically.</p>
        
        <!-- Alphabet Navigation -->
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            @foreach(range('A', 'Z') as $char)
                <a href="{{ route('az-list', ['letter' => $char]) }}" 
                   class="w-10 h-10 flex items-center justify-center rounded font-bold transition {{ isset($letter) && $letter == $char ? 'bg-brand-teal text-white' : 'bg-zinc-800 text-gray-300 hover:bg-brand-teal hover:text-white' }}">
                    {{ $char }}
                </a>
            @endforeach
        </div>

        @if($letter)
            <div class="flex flex-col items-center mb-10">
                <h2 class="text-2xl font-black uppercase flex items-center">
                    MOVIES STARTING WITH : <span class="text-brand-teal ml-2">{{ $letter }}</span>
                </h2>
                <div class="w-full h-[1px] bg-gray-800 mt-4"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                 <!-- Mock Data for Filtered Results -->
                 @include('components.front.movie-card', ['title' => 'Sample Movie A', 'image' => 'https://image.tmdb.org/t/p/w500/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg'])
                 @include('components.front.movie-card', ['title' => 'Sample Movie B', 'image' => 'https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg'])
                 @include('components.front.movie-card', ['title' => 'Sample Movie C', 'image' => 'https://image.tmdb.org/t/p/w500/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg'])
            </div>
        @endif
    </div>
@endsection
