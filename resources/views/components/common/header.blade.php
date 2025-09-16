<header class="w-full h-24 z-50 bg-white md:bg-white shadow-md">
    <div class="md:w-11/12 m-auto px-14 flex flex-col md:flex-row items-left md:items-center justify-between md:h-24">

        <a href="{{ route('index') }}" wire:navigate>
            <img class="w-14 mt-3 md:mt-0" src="http://localhost:8000/img/Logo.png" alt="Logo" />
        </a>

        
        <button id="menu-btn" class="absolute top-6 right-11 md:hidden text-gray-700 focus:outline-none">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <nav id="mobile-menu" class="fixed inset-0 left-0 w-full md:w-1/4 bg-red-200 z-40 flex flex-col items-center justify-center md:relative md:inset-auto md:bg-white md:flex md:flex-row md:mt-0
    -translate-x-full opacity-0 transition-all duration-300 pointer-events-none md:pointer-events-auto md:translate-x-0 md:opacity-100">

            
            <button id="close-btn" class="absolute top-6 right-6 md:hidden text-gray-700 focus:outline-none">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <ul class="flex flex-col items-center justify-center space-y-6 md:flex-row md:space-y-0 md:space-x-10">
                <li class="text-2xl md:text-lg my-10 md:my-0 font-medium text-gray-700 group cursor-pointer">
                    <a class="lg:mr-12" href="{{ route('index') }}" wire:navigate>Inicio</a>
                </li>
                <li class="text-2xl md:text-lg my-10 md:my-0 font-medium text-gray-700 group cursor-pointer">
                    <a class="lg:mr-12 mt-2 lg:mt-0" href="{{ route('services') }}" wire:navigate>Servicios</a>
                </li>
                <li class="text-2xl md:text-lg my-14 md:my-0 font-medium text-gray-700 group cursor-pointer">
                    <a class="lg:mr-12 mt-4 lg:mt-0" href="{{ route('contact') }}" wire:navigate>Contacto</a>
                </li>
                <li class="w-full md:w-auto text-2xl md:text-lg my-14 md:my-0 font-medium text-white bg-red-600 hover:bg-red-700 px-5 py-2 rounded-full">
                    <a href="{{ route('login') }}" wire:navigate class="transition duration-300">Login</a>
                </li>
            </ul>
        </nav>




    </div>
</header>

