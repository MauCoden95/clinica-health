<div class="h-full bg-gray-50 border-r border-gray-200">
    <div class="flex items-center justify-center py-6 border-b border-gray-200">
        <img class="w-24 h-auto" src="{{ asset('img/Logo.png') }}" alt="Logo" />
    </div>

    <nav class="flex-1 mt-6">
        <p class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 px-6 mb-4 tracking-wider">
            Menú Administrador
        </p>

        <ul class="px-2 space-y-1">
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://127.0.0.1:8000/dashboard">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    <span class="font-medium">Home Dashboard</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/pacientes">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    <span class="font-medium">Pacientes</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/doctores">
                    <i class="fas fa-user-md w-5 h-5 mr-3"></i>
                    <span class="font-medium">Médicos</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/especialidades">
                    <i class="fas fa-notes-medical w-5 h-5 mr-3"></i>
                    <span class="font-medium">Especialidades</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/calendario-de-turnos">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                    <span class="font-medium">Calendario General</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/quejas-y-sugerencias">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                    <span class="font-medium">Quejas y Sugerencias</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/estadisticas">
                    <i class="fas fa-chart-pie w-5 h-5 mr-3"></i>
                    <span class="font-medium">Informes y Estadísticas</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/inventario">
                    <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                    <span class="font-medium">Inventario Médico</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="{{ route('admin.suppliers') }}">
                    <i class="fas fa-truck w-5 h-5 mr-3"></i>
                    <span class="font-medium">Proveedores</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/finanzas">
                    <i class="fas fa-money-bill-wave-alt w-5 h-5 mr-3"></i>
                    <span class="font-medium">Finanzas</span>
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 
                          text-gray-600  hover:bg-red-700 dark:hover:text-white"
                   wire:navigate href="http://localhost:8000/admin/usuarios">
                    <i class="fas fa-key w-5 h-5 mr-3"></i>
                    <span class="font-medium">Usuarios</span>
                </a>
            </li>
        </ul>
    </nav>
</div>