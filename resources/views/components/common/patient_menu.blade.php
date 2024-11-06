<div class="">
    <div class="w-full m-auto flex items-center justify-center h-24">
        <img class="w-28" src="{{ asset('img/Logo.png') }}" alt="Logo" />
    </div>
    <nav class="w-full h-auto duration-300">
        <li class="list-none text-center italic text-xl my-3">Menú Paciente</li>

        <ul class="p-4 space-y-2">
            <li>
                <a wire:navigate href="http://localhost:8000/pacientes/turnos"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3M3 9h18M5 19h14a2 2 0 002-2V9H3v8a2 2 0 002 2z"></path>
                        </svg>
                    Turnos
                    </a>
                </li>

            <li>
                <a wire:navigate href="http://localhost:8000/resultados"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300">
                    <!-- Ícono de documento para Resultados de estudios -->
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8h-4a2 2 0 01-2-2V7a2 2 0 012-2h6l5 5v10a2 2 0 01-2 2h-3z"></path>
                        </svg>
                    Resultados de estudios
                    </a>
                </li>

            <li>
                <a wire:navigate href="http://localhost:8000/recetas"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300">
                    <!-- Ícono de receta médica -->
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 01-8 0 4 4 0 018 0zm2 4H6v8a2 2 0 002 2h8a2 2 0 002-2v-8z"></path>
                        </svg>
                    Recetas médicas
                    </a>
                </li>

            <li>
                <a wire:navigate href="http://localhost:8000/medicos"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300">
                    <!-- Ícono de usuario médico para Médicos disponibles -->
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0 2.28-1.57 4-3.5 4S5 13.28 5 11s1.57-4 3.5-4 3.5 1.72 3.5 4zM12 13.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM12 20h7M12 20v-5a3.5 3.5 0 015.5-2.95">
                        </path>
                        </svg>
                    Médicos disponibles
                    </a>
                </li>

            <li>
                <a wire:navigate href="http://localhost:8000/pagos"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300">
                    <!-- Ícono de pago -->
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 15a4 4 0 108 0m-4-4a4 4 0 010 8 4 4 0 010-8zm0 8c-2.5 0-5.2-1.6-6.6-4.3a9.78 9.78 0 0111.2 0c-1.4 2.7-4.1 4.3-6.6 4.3z">
                        </path>
                        </svg>
                    Pagos
                    </a>
                </li>

        </ul>
    </nav>
</div>
