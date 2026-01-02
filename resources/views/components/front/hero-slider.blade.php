<div class="relative w-full h-[600px] overflow-hidden bg-black">
    <!-- Slideshow Container -->
    <div id="hero-slides" class="absolute inset-0 w-full h-full">
        <!-- Slide 0 -->
        <div class="zs-slide absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-[8000ms] ease-out opacity-100 scale-100" 
             style="background-image: url('https://image.tmdb.org/t/p/original/r7XifzvtezNt31ypvsmb6Oqxw49.jpg');">
        </div>
        <!-- Slide 1 -->
        <div class="zs-slide absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-[8000ms] ease-out opacity-0 scale-110" 
             style="background-image: url('https://image.tmdb.org/t/p/original/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg');"> <!-- Avatar -->
        </div>
        <!-- Slide 2 -->
        <div class="zs-slide absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-[8000ms] ease-out opacity-0 scale-110" 
             style="background-image: url('https://image.tmdb.org/t/p/original/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg');"> <!-- Guardians -->
        </div>
        <!-- Slide 3 -->
        <div class="zs-slide absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-[8000ms] ease-out opacity-0 scale-110" 
             style="background-image: url('https://image.tmdb.org/t/p/original/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg');"> <!-- John Wick -->
        </div>
    </div>
    
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black opacity-80"></div>

    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4 pt-20">
        <h2 class="text-white text-4xl md:text-6xl font-black uppercase tracking-wide mb-2">
            LATEST <span class="text-teal-400">ONLINE</span> MOVIES
        </h2>
        <p class="text-gray-300 text-sm md:text-lg tracking-[0.2em] uppercase mb-8">
            IN SPACE NO ONE CAN HEAR YOU SCREAM.
        </p>
        
        <div class="zs-bullets flex space-x-2 mt-4 z-30">
            <div class="zs-bullet w-8 h-1 bg-brand-teal rounded-full transition-colors duration-300"></div>
            <div class="zs-bullet w-8 h-1 bg-white rounded-full transition-colors duration-300"></div>
            <div class="zs-bullet w-8 h-1 bg-white rounded-full transition-colors duration-300"></div>
            <div class="zs-bullet w-8 h-1 bg-white rounded-full transition-colors duration-300"></div>
        </div>
    </div>
</div>

<<<<<<< HEAD
<div class="w-full bg-brand-red py-4 relative z-40">
    <div class="container mx-auto px-6 flex items-center justify-between">
        @auth
            <!-- Auth View: Account Dropdown & Cart -->
            <div class="relative group">
                <button class="bg-black text-white text-xs font-bold px-6 py-2 uppercase tracking-wider flex items-center hover:bg-gray-900 transition">
                    ACCOUNT <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div class="absolute left-0 top-full mt-0 w-48 bg-black border border-zinc-800 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                    <div class="py-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-zinc-800 hover:text-white uppercase font-bold">
                                LOGOUT
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <a href="#" class="bg-black text-white text-xs font-bold px-6 py-2 uppercase tracking-wider hover:bg-gray-900 transition">
                KERANJANG
            </a>
        @else
            <!-- Guest View: Left Login/Register -->
            <div class=" flex-1 flex justify-left space-x-4 "> 
                 <button id="loginBtn" class="bg-black text-white text-xs font-bold px-6 py-2 uppercase tracking-wider hover:bg-gray-900 transition">
                    LOGIN
                </button>
                <button id="registerBtn" class="bg-black text-white text-xs font-bold px-6 py-2 uppercase tracking-wider hover:bg-gray-900 transition">
                    REGISTER
                </button>
            </div>
        @endauth
=======
<div class="w-full bg-brand-red py-4">
    <div class="container mx-auto px-6 flex items-center space-x-4">
        <a href="#" id="loginBtn" class="bg-black text-white text-xs font-bold px-6 py-2 uppercase tracking-wider hover:bg-gray-900 transition">
            Login
        </a>
        <button id="registerBtn" class="bg-black text-white text-xs font-bold px-6 py-2 uppercase tracking-wider hover:text-brand-teal transition">
            Register
        </button>
>>>>>>> cbfd8f8 (add fe)
    </div>
</div>