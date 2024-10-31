<header class="border-b h-24 flex items-center justify-between px-16 bg-white">
    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <h1 class="text-2xl font-bold">Bienvenido, {{ auth()->user()->name }}</h1>
    <div class="relative w-44 z-40 flex items-center" x-data="{ isActive: false }" @click.outside="isActive = false">
        <button class="w-full p-3 bg-slate-300 hover:bg-slate-400 duration-300" @click="isActive = !isActive">
            Menu <i class="fas fa-bars ml-2"></i>
        </button>
        <div class="absolute top-full w-full" x-bind:class="{ 'active': isActive, 'inactive': !isActive }">
            <ul class="flex flex-col items-center justify-between">
                <li class="w-full cursor-pointer text-center p-2 bg-orange-400 hover:bg-orange-500 duration-300">
                    <a class="w-full h-full">Configuración <i class="fas fa-cogs ml-2"></i></a>
                </li>
                <li class="w-full cursor-pointer text-center text-white p-2 bg-red-600 hover:bg-red-700 duration-300">
                    <a wire:click="logout" class="w-full h-full">
                        Cerrar sesión <i class="fas fa-sign-out-alt ml-2"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
