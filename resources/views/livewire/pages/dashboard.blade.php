<div x-data="{ sidebarOpen: false }" class="relative flex h-screen bg-gray-100">
   

    
    <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        class="fixed inset-0 bg-white w-full h-full transform transition-transform duration-300 z-50 md:relative md:translate-x-0 md:w-64 md:h-auto md:flex md:flex-col">
        
        
        <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-gray-600 md:hidden">
            <!-- Icono de cerrar (X) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

       
        <x-common.dashboard_nav />
    </div>

    
    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white p-6">
            
            <button>
                Clickeame
            </button>

            
        </main>
    </div>
</div>
