@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-20 pt-32 text-center">
        <h1 class="text-4xl font-black mb-4 uppercase">
            SEARCH RESULTS FOR : <span class="text-brand-teal">"{{ $query }}"</span>
        </h1>
        
        <div class="mt-12">
            @if($query)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                     <!-- Mock Data for Search Results -->
                     @include('components.front.movie-card', ['title' => 'Search Result 1', 'image' => 'https://image.tmdb.org/t/p/w500/fiVW06jE7z9YnO4trhaMEdclSiC.jpg'])
                     @include('components.front.movie-card', ['title' => 'Search Result 2', 'image' => 'https://image.tmdb.org/t/p/w500/rktDFPbfHfUbArZ6OOOKsXcv0Bm.jpg'])
                </div>
            @else
                <p class="text-gray-500 text-lg">Type something in the search bar to find movies.</p>
            @endif
        </div>
    </div>
@endsection
