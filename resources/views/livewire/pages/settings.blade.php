<div x-data="{ sidebarOpen: false, color: true }" class="relative flex h-screen bg-gray-100">



    <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        class="fixed inset-0 bg-white w-full h-full transform transition-transform duration-300 z-50 md:relative md:translate-x-0 md:w-64 lg:w-96 md:h-auto md:flex md:flex-col">


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

            <div class="w-full px-14">
                <div class="w-full m-auto flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4 my-6 shadow-sm">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100">
                        <i class="fas fa-clock text-blue-600"></i>
                    </div>
                    <p class="text-gray-700">
                        <span class="font-semibold">Última actualización:</span>
                        {{ auth()->user()->latest_update_date }} a las {{ auth()->user()->latest_update_time }}
                    </p>
                </div>
            </div>


            <div class="flex">
                <div class="p-8">
                    <h1 class="text-center text-3xl font-extrabold text-gray-800 my-8">
                        Actualizar perfil
                    </h1>

                    <div class="flex justify-center">
                        <form wire:submit.prevent="updateUser" class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-xl space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <input type="email" wire:model="email"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-500"
                                    placeholder="Correo electrónico">

                                <input type="text" wire:model="address"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-500"
                                    placeholder="Dirección">

                                <input type="number" wire:model="phone"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-500"
                                    placeholder="Teléfono">

                                <input type="text" wire:model="obra_social"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-500"
                                    placeholder="Obra social">

                                <input type="password" wire:model="password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-500"
                                    placeholder="Contraseña">

                                <input type="password" wire:model="password_confirm"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-500"
                                    placeholder="Confirmar contraseña">
                            </div>

                            <div class="flex justify-center">
                                <button type="submit"
                                    class="w-full md:w-auto px-8 py-3 text-lg font-bold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                                    Actualizar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="p-8">
                    <h1 class="text-center text-3xl font-extrabold text-gray-800 mt-10 mb-8">
                        Eliminar cuenta
                    </h1>

                    <div class="flex items-center justify-center">
                        <form wire:submit.prevent="deleteAccount" class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl space-y-6">
                            <input type="password" wire:model="psw_delete"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 placeholder-gray-500"
                                placeholder="Contraseña">

                            <input type="password" wire:model="psw_delete_confirm"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 placeholder-gray-500"
                                placeholder="Confirmar contraseña">

                            <button type="submit"
                                class="w-full px-8 py-3 text-lg font-bold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:scale-105">
                                Eliminar cuenta
                                <i class="fas fa-trash-alt ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>


        </main>
    </div>
</div>