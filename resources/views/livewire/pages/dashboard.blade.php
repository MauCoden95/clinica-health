<div x-data="{ sidebarOpen: false, color: true }" class="relative flex h-screen bg-gray-100">



    <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        class="fixed inset-0 bg-white w-full h-full transform transition-transform duration-300 z-50 md:relative md:translate-x-0 md:w-96 md:h-auto md:flex md:flex-col">


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
            <div class="px-5 md:px-10 flex flex-col md:flex-row gap-5">
                <div class="w-full md:w-4/6 min-h-0">
                    <div class="w-full h-auto md:h-64 py-10 md:py-0 px-7 bg-gradient-to-r from-green-500 to-emerald-700 rounded-2xl flex flex-col md:flex-row items-center justify-between shadow-lg">
                        <div class="max-w-xl">
                            <h1 class="text-2xl md:text-4xl text-center md:text-left text-white font-extrabold flex items-center gap-2">
                                👋 ¡Hola, {{ auth()->user()->name }}!
                            </h1>
                            <p class="text-lg mt-3 text-center md:text-left text-white/90 leading-relaxed">
                                Bienvenido a tu panel administrador. Consulta estadísticas, gestiona turnos y brinda una mejor atención a tus pacientes hoy.
                            </p>
                        </div>


                        <div class="relative mt-10 md:mt-0">
                            <img 
                                class="h-56 drop-shadow-xl rounded-full bg-white p-2" 
                                src="{{ asset('img/Medical-dashboard.webp') }}"
                                srcset="{{ asset('img/Medical-dashboard.webp') }} 1x, {{ asset('img/Medical-dashboard@2x.webp') }} 2x"
                                alt="Dashboard médico"
                                width="224"
                                height="224"
                                loading="lazy"
                                fetchpriority="high"
                            />
                        </div>
                    </div>


                    <div class="w-full flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4 my-6 shadow-sm">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <p class="text-gray-700">
                            <span class="font-semibold">Último acceso:</span>
                            {{ auth()->user()->date }} a las {{ auth()->user()->time }}
                        </p>
                    </div>



                    <div class="w-full mt-8 grid gap-6 grid-cols-2 md:grid-cols-3">


                        <div class="relative w-full h-20 md:h-auto p-2 md:p-6 rounded-2xl bg-gradient-to-r from-red-400 to-red-500 shadow-lg hover:shadow-2xl transition-transform hover:scale-105">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-calendar bg-white text-red-500 rounded-full p-1 md:p-4 shadow-md"></i>
                                <div>
                                    <h2 class="text-sm md:text-lg font-semibold text-white">Turnos de hoy</h2>
                                    <h2 class="text-base md:text-4xl font-extrabold text-white mt-2">5</h2>
                                </div>
                            </div>
                        </div>


                        <div class="relative w-full h-20 md:h-auto p-2 md:p-6 rounded-2xl bg-gradient-to-r from-blue-400 to-blue-600 shadow-lg hover:shadow-2xl transition-transform hover:scale-105">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-money-bill-wave bg-white text-blue-500 rounded-full p-1 md:p-4 shadow-md"></i>
                                <div>
                                    <h2 class="text-sm md:text-lg font-semibold text-white">Ingresos de hoy</h2>
                                    <h2 class="text-base md:text-4xl text-white mt-2">500,000 $</h2>
                                </div>
                            </div>
                        </div>


                        <div class="relative w-full p-6 rounded-2xl bg-gradient-to-r from-green-400 to-green-600 shadow-lg hover:shadow-2xl transition-transform hover:scale-105">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-list bg-white text-green-500 rounded-full p-1 md:p-4 shadow-md"></i>
                                <div>
                                    <h2 class="text-lg font-semibold text-white">Órdenes pendientes</h2>
                                    <h2 class="text-4xl font-extrabold text-white mt-2">5</h2>
                                </div>
                            </div>
                        </div>


                        <div class="relative w-full p-6 rounded-2xl bg-gradient-to-r from-purple-400 to-purple-600 shadow-lg hover:shadow-2xl transition-transform hover:scale-105">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-user-md bg-white text-purple-500 rounded-full p-4 shadow-md"></i>
                                <div>
                                    <h2 class="text-lg font-semibold text-white">Doctor con más turnos</h2>
                                    <h2 class="text-xl font-extrabold text-white mt-2">Dr. Felix Barbosa</h2>
                                </div>
                            </div>
                        </div>

                        <div class="relative w-full p-6 rounded-2xl bg-gradient-to-r from-teal-400 to-teal-600 shadow-lg hover:shadow-2xl transition-transform hover:scale-105">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-user-plus bg-white text-teal-500 rounded-full p-4 shadow-md"></i>
                                <div>
                                    <h2 class="text-lg font-semibold text-white">Pacientes nuevos (hoy)</h2>
                                    <h2 class="text-4xl font-extrabold text-white mt-2">8</h2>
                                </div>
                            </div>
                        </div>

                       
                        <div class="relative w-full p-6 rounded-2xl bg-gradient-to-r from-indigo-400 to-indigo-600 shadow-lg hover:shadow-2xl transition-transform hover:scale-105">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-users bg-white text-indigo-500 rounded-full p-4 shadow-md"></i>
                                <div>
                                    <h2 class="text-lg font-semibold text-white">Pacientes nuevos (semana)</h2>
                                    <h2 class="text-4xl font-extrabold text-white mt-2">32</h2>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="w-2/6" id='calendar'></div>
            </div>







        </main>
    </div>
</div>