<header class="border-b h-24 flex items-center justify-between px-16">
    <button @click="sidebarOpen = true" class="p-4 md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>
    <h1 class="text-xs sm:text-xl md:text-2xl font-bold">Bienvenido, {{ auth()->user()->name }}</h1>
    <div class="relative w-auto md:w-44 z-40 flex items-center" x-data="{ isActive: false }" @click.outside="isActive = false">
        <button class="w-24 md:w-full p-1 md:p-3 ml-5 md:ml-0 bg-slate-300 hover:bg-slate-400 duration-300" @click="isActive = !isActive">
            Menu <i class="fas fa-bars ml-2"></i>
        </button>
        <div class="absolute top-full w-24 md:w-full ml-5 md:ml-0" x-bind:class="{ 'active': isActive, 'inactive': !isActive }">
            <ul class="flex flex-col items-center justify-between">
                <li class="w-full cursor-pointer text-center p-2 bg-gray-200 hover:bg-gray-500 duration-300">
                    <a wire:navigate href="http://localhost:8000/configuracion"
                    class="w-full h-full text-xs md:text-base">Configuración <i class="fas fa-cogs ml-2"></i></a>
                </li>
                <li class="w-full cursor-pointer text-center text-white p-2 bg-red-600 hover:bg-red-700 duration-300">
                    <a wire:click="logout" class="w-full h-full text-xs md:text-base">
                        Cerrar sesión <i class="fas fa-sign-out-alt ml-2"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
