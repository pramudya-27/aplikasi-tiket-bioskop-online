<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 97cf3db (Menyelesaikan fitur login)
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Movies Mania</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
    <title>Movies Mania</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-black text-gray-100 flex flex-col min-h-screen">

    <nav class="absolute top-0 w-full z-50 py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black tracking-tighter text-white">
                <span class="text-brand-red">MOVIES</span> MANIA
            </a>

            <div class="hidden md:flex space-x-8 text-sm font-bold text-gray-300 items-center">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand-red' : 'text-gray-300 hover:text-white' }} transition">HOME</a>
                
                <!-- Genre Dropdown -->
                <div class="relative group">
                    <button class="{{ request()->routeIs('genre*') ? 'text-brand-red' : 'text-gray-300 hover:text-white' }} transition flex items-center">
                        GENRE <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="absolute left-0 top-full mt-2 w-[400px] bg-zinc-900 border border-gray-800 text-gray-100 shadow-xl rounded-md p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 grid grid-cols-3 gap-2 text-xs">
                        <a href="{{ route('genre.show', 'action') }}" class="hover:text-brand-teal">Action</a>
                        <a href="{{ route('genre.show', 'adventure') }}" class="hover:text-brand-teal">Adventure</a>
                        <a href="{{ route('genre.show', 'animation') }}" class="hover:text-brand-teal">Animation</a>
                        <a href="{{ route('genre.show', 'biography') }}" class="hover:text-brand-teal">Biography</a>
                        <a href="{{ route('genre.show', 'comedy') }}" class="hover:text-brand-teal">Comedy</a>
                        <a href="{{ route('genre.show', 'costume') }}" class="hover:text-brand-teal">Costume</a>
                        <a href="{{ route('genre.show', 'crime') }}" class="hover:text-brand-teal">Crime</a>
                        <a href="{{ route('genre.show', 'documentary') }}" class="hover:text-brand-teal">Documentary</a>
                        <a href="{{ route('genre.show', 'drama') }}" class="hover:text-brand-teal">Drama</a>
                        <a href="{{ route('genre.show', 'family') }}" class="hover:text-brand-teal">Family</a>
                        <a href="{{ route('genre.show', 'fantasy') }}" class="hover:text-brand-teal">Fantasy</a>
                        <a href="{{ route('genre.show', 'history') }}" class="hover:text-brand-teal">History</a>
                        <a href="{{ route('genre.show', 'horror') }}" class="hover:text-brand-teal">Horror</a>
                        <a href="{{ route('genre.show', 'musical') }}" class="hover:text-brand-teal">Musical</a>
                        <a href="{{ route('genre.show', 'psychological') }}" class="hover:text-brand-teal">Psychological</a>
                        <a href="{{ route('genre.show', 'romance') }}" class="hover:text-brand-teal">Romance</a>
                        <a href="{{ route('genre.show', 'sports') }}" class="hover:text-brand-teal">Sports</a>
                        <a href="{{ route('genre.show', 'thriller') }}" class="hover:text-brand-teal">Thriller</a>
                        <a href="{{ route('genre.show', 'war') }}" class="hover:text-brand-teal">War</a>
                    </div>
                </div>

                <a href="{{ route('az-list') }}" class="{{ request()->routeIs('az-list*') ? 'text-brand-red' : 'text-gray-300 hover:text-white' }} transition">A - Z LIST</a>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Search Trigger -->
                <button id="searchTrigger" class="text-white hover:text-brand-red">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-black py-10 text-center border-t border-gray-800 mt-10">
<<<<<<< HEAD
<<<<<<< HEAD
        <p class="text-gray-500 text-sm">&copy; 2025 Movies Mania. All rights reserved | Created by CREATE TABLE Group.</p>
=======
        <p class="text-gray-500 text-sm">&copy; 2025 Movies Mania. All Rights Reserved.</p>
>>>>>>> cbfd8f8 (add fe)
=======
        <p class="text-gray-500 text-sm">&copy; 2025 Movies Mania. All rights reserved | Created by CREATE TABLE Group.</p>
>>>>>>> 97cf3db (Menyelesaikan fitur login)
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-80 hidden backdrop-blur-sm">
        <div class="bg-zinc-900 border border-zinc-800 p-8 w-[400px] relative shadow-2xl rounded-lg">
            <button id="closeLogin" class="absolute top-4 right-4 text-gray-400 hover:text-white text-2xl transition">&times;</button>
            
            <h2 class="text-center text-xl font-bold tracking-widest text-white mb-8">LOGIN</h2>
            
            <form action="#" method="POST" class="space-y-4">
                <input type="text" placeholder="Username" class="w-full bg-black border border-zinc-700 px-4 py-3 text-sm text-white focus:outline-none focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-center placeholder-gray-500 font-semibold rounded">
                <input type="password" placeholder="Password" class="w-full bg-black border border-zinc-700 px-4 py-3 text-sm text-white focus:outline-none focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-center placeholder-gray-500 font-bold text-lg rounded">
                
                <button type="submit" class="w-full bg-brand-teal text-white py-3 font-bold text-xs uppercase tracking-wider hover:bg-teal-600 transition mt-6 rounded">
                    LOGIN NOW
                </button>
            </form>
            
            <div class="flex justify-center space-x-2 mt-8">
                <div class="w-8 h-1 bg-zinc-700 rounded-full"></div>
                <div class="w-8 h-1 bg-zinc-700 rounded-full"></div>
                <div class="w-8 h-1 bg-zinc-700 rounded-full"></div>
                <div class="w-8 h-1 bg-brand-teal rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-80 hidden backdrop-blur-sm">
        <div class="bg-zinc-900 border border-zinc-800 p-8 w-[400px] relative shadow-2xl rounded-lg">
            <button id="closeRegister" class="absolute top-4 right-4 text-gray-400 hover:text-white text-2xl transition">&times;</button>
            
            <h2 class="text-center text-xl font-bold tracking-widest text-white mb-8">REGISTER</h2>
            
            <form action="#" method="POST" class="space-y-4">
                <input type="text" placeholder="Full Name" class="w-full bg-black border border-zinc-700 px-4 py-3 text-sm text-white focus:outline-none focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-center placeholder-gray-500 rounded">
                <input type="text" placeholder="Username" class="w-full bg-black border border-zinc-700 px-4 py-3 text-sm text-white focus:outline-none focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-center placeholder-gray-500 font-semibold rounded">
                <input type="text" placeholder="Date of Birth" class="w-full bg-black border border-zinc-700 px-4 py-3 text-sm text-white focus:outline-none focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-center placeholder-gray-500 rounded">
                
                <div class="flex justify-center space-x-6 text-sm text-gray-400 my-4">
                    <label class="flex items-center space-x-2 cursor-pointer hover:text-white transition">
                        <input type="radio" name="gender" value="male" class="text-brand-teal focus:ring-brand-teal bg-black border-zinc-700">
                        <span>Male</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:text-white transition">
                        <input type="radio" name="gender" value="female" class="text-brand-teal focus:ring-brand-teal bg-black border-zinc-700">
                        <span>Female</span>
                    </label>
                </div>
                
                <input type="password" placeholder="Password" class="w-full bg-black border border-zinc-700 px-4 py-3 text-sm text-white focus:outline-none focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-center placeholder-gray-500 font-bold text-lg rounded">
                
                <button type="submit" class="w-full bg-brand-teal text-white py-3 font-bold text-xs uppercase tracking-wider hover:bg-teal-600 transition mt-6 rounded">
                    REGISTER NOW
                </button>
            </form>
        </div>
    </div>

    <!-- Search Overlay -->
    <div id="searchOverlay" class="fixed inset-0 z-[70] bg-black bg-opacity-90 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <button id="closeSearch" class="absolute top-8 right-8 text-white hover:text-brand-red text-4xl">&times;</button>
        <form action="{{ route('search') }}" method="GET" class="w-full max-w-3xl px-6">
            <input type="text" name="q" placeholder="Search movies..." class="w-full bg-transparent border-b-2 border-gray-500 text-white text-3xl font-bold py-4 focus:outline-none focus:border-brand-teal placeholder-gray-600">
        </form>
    </div>

</body>
</html>