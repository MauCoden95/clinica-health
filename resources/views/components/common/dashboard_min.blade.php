<div class="relative w-3/4">
    <section class="p-4">
        <div class="relative flex items-center justify-end">
            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button 
                    class="flex items-center justify-between px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium rounded-lg shadow-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-300" 
                    @click="open = !open">
                    Menú
                    <i class="fas fa-caret-down ml-3 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                </button>
                
                <div 
                    x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 origin-top-right rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                    
                    <ul class="py-1">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <i class="fas fa-cogs mr-2"></i>
                                Configuración
                            </a>
                        </li>
                        <hr class="my-1 border-gray-200 dark:border-gray-700">
                        <li>
                            <a wire:click="logout" href="#" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 hover:text-red-700 dark:hover:text-red-300 transition-colors duration-200 cursor-pointer">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Cerrar sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>