<div class="bg-gradient-to-r from-red-400 via-red-500 to-red-600 w-screen h-screen flex items-center justify-center px-6">
    <div class="flex bg-white rounded-2xl shadow-2xl overflow-hidden w-[900px]">
        <!-- Formulario -->
        <form wire:submit.prevent="login" class="w-[500px] p-10">
            <h3 class="text-3xl font-semibold text-center text-gray-800 mb-8">Login Profesional</h3>

            <!-- Email -->
            <div class="mb-6">
                <input wire:model="email" type="text"
                    class="block w-full p-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none"
                    placeholder="Correo electrónico..." />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <input wire:model="password" type="password"
                    class="block w-full p-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none"
                    placeholder="Contraseña..." />
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botón -->
            <button
                class="block w-full text-white text-lg p-4 rounded-xl bg-gradient-to-r from-red-500 to-red-700 hover:opacity-90 transition duration-300 shadow-md">
                Ingresar
            </button>

            <!-- Recuperar contraseña -->
            <div class="text-center mt-6">
                <span class="text-gray-600">¿Perdió su contraseña?
                    <a href="http://localhost:8000/recuperar-contraseña"
                        class="text-red-600 hover:text-red-800 font-semibold transition duration-200" wire:navigate>
                        Recupérela acá
                    </a>
                </span>
            </div>
        </form>

        <!-- Imagen -->
        <div class="flex items-center justify-center bg-gray-50 w-1/2 p-10">
            <img class="max-w-xs" src="{{ asset('img/Logo.png') }}" alt="Logo" />
        </div>
    </div>
</div>
