<div>
    <x-common.header/>
    <h2 class="text-4xl font-bold text-center my-2 text-gray-800">Ingreso de pacientes</h2>

    <div class="w-full my-12 px-6 md:px-14 flex flex-col md:flex-row items-center justify-evenly">
        <!-- Formulario -->
        <form wire:submit.prevent="login" class="w-full md:w-3/6 bg-white shadow-md p-8 rounded-lg" autoComplete="off">
            
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
                <input type="email" id="email" wire:model="email" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su correo electrónico...">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" id="password" wire:model="password" 
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su contraseña...">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 focus:bg-red-700 transition duration-300 font-semibold shadow-md">Ingresar</button>

            <div class="mt-4 text-center">
                <span class="text-gray-600">¿No tiene cuenta? 
                    <a href="{{ route('register') }}" class="text-red-600 hover:text-red-800 font-semibold transition duration-200" wire:navigate>Regístrese acá</a>
                </span>
            </div>
        </form>

        <!-- Imagen -->
        <img class="w-full md:w-2/5 mt-10 md:mt-0" src="http://localhost:8080/img/LoRe.png" alt="Dos médicos" />
    </div>

    <x-common.footer/>
</div>
