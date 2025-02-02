<div class="h-screen flex">  
    <div class="w-2/4 h-screen bg-white p-6">
        <h2 class="text-2xl font-bold text-center my-4 text-gray-800">Registro de pacientes</h2>
        @if (session()->has('success'))
            <div class="w-11/12 m-auto bg-green-700 text-white p-3">{{ session('success') }}</div>
        @endif
        <form wire:submit.prevent="register" class="w-full bg-white p-8 rounded-lg grid gap-4 grid-cols-2" autoComplete="off">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre completo</label>
                <input type="text" id="name" wire:model="name" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su nombre completo...">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
                <input type="email" id="email" wire:model="email" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su correo electrónico...">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                <input type="text" id="address" wire:model="address" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su dirección...">
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                <input type="tel" id="phone" wire:model="phone" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su teléfono...">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="dni" class="block text-gray-700 text-sm font-bold mb-2">DNI</label>
                <input type="number" id="dni" wire:model="dni" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su DNI...">
                @error('dni') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="obra_social" class="block text-gray-700 text-sm font-bold mb-2">Obra Social</label>
                <input type="text" id="obra_social" wire:model="obra_social" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su obra social...">
                @error('obra_social') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" id="password" wire:model="password" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Ingrese su contraseña...">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation" 
                    class="w-full px-4 py-1 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-200" 
                    placeholder="Confirme su contraseña...">
                @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-red-500 text-white py-1 rounded-lg hover:bg-red-600 focus:bg-red-700 transition duration-300 font-semibold shadow-md">Registrar</button>

            <div class="text-center">
                <span class="text-gray-600">¿Ya tiene cuenta? 
                    <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-semibold transition duration-200" wire:navigate>Ingrese acá</a>
                </span>
            </div>
        </form>
    </div>
    <img class="w-2/4 h-full mt-10 md:mt-0" src="http://localhost:8000/img/Register.jpg" alt="Dos médicos" />
</div>