<div x-data="{ sidebarOpen: false, color: true }" class="relative flex h-screen bg-gray-100">



    <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        class="fixed inset-0 bg-white w-full h-full transform transition-transform duration-300 z-50 md:relative md:translate-x-0 md:w-64 md:h-auto md:flex md:flex-col">


        <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-gray-600 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


        <x-common.dashboard_nav />
    </div>


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white p-6">

            <h1 class="text-center text-2xl my-8">Actualizar perfil</h1>

            <div class="flex items-center justify-center">
                <form wire:submit.prevent="updateUser" class="w-full px-14 grid gap-4 grid-cols-2">
                    <input type="email" wire:model="email" class="mb-5 border-b border-red-500 p-2" placeholder="Correo electrónico">
                    <input type="text" wire:model="address" class="mb-5 border-b border-red-500 p-2" placeholder="Dirección">
                    <input type="number" wire:model="phone" class="mb-5 border-b border-red-500 p-2" placeholder="Telefono">
                    <input type="text" wire:model="obra_social" class="mb-5 border-b border-red-500 p-2" placeholder="Obra social">
                    <input type="password" wire:model="password" class="mb-5 border-b border-red-500 p-2" placeholder="Contraseña">
                    <input type="password" wire:model="password_confirm" class="mb-5 border-b border-red-500 p-2" placeholder="Confirmar contraseña">
                    <button class="w-full bg-red-500 hover:bg-red-600 py-2">
                        Actualizar
                        <i class="fas fa-pencil"></i>
                    </button>
                </form>

                
            </div>




            <h1 class="text-center text-2xl mt-20 mb-8">Eliminar cuenta</h1>

            <div class="flex items-center justify-center">
                <form wire:submit.prevent="deleteAccount" class="w-2/4 px-14 flex flex-col">
                    <input type="password" wire:model="psw_delete" class="mb-5 border-b border-red-500 p-2" placeholder="Contraseña">
                    <input type="password" wire:model="psw_delete_confirm" class="mb-5 border-b border-red-500 p-2" placeholder="Confirmar contraseña">
                    <button class="w-full bg-red-500 hover:bg-red-600 py-2">
                        Eliminar cuenta
                        <i class="fas fa-pencil"></i>
                    </button>
                </form>

               
            </div>


        </main>
    </div>
</div>