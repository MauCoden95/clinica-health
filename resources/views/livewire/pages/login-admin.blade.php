<div class="bg-login-admin w-screen h-screen px-10 flex items-center justify-start bg-red-500">
    <form wire:submit.prevent="login" class="w-[500px] py-10 bg-white rounded-md">
        <h3 class="text-2xl text-center mb-6">Login profesional</h3>
        <div class="w-5/6 my-6 m-auto">
            <input wire:model="email" type="text" class="block w-full p-3 text-xl border border-red-400 focus:border-red-600" placeholder="Correo electrónico..." />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="w-5/6 my-6 m-auto">
            <input wire:model="password" type="password" class="block w-full p-3 text-xl border border-red-400 focus:border-red-600" placeholder="Contraseña..." />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button class="block w-5/6 m-auto mb-7 text-white text-xl p-3 bg-red-500 hover:bg-red-600 duration-300">
            Ingresar
        </button>

        <div class="text-center">
            <span class="text-gray-600">¿Predio su contraseña?
                <a href="http://localhost:8000/recuperar-contraseña" class="text-red-600 hover:text-red-800 font-semibold transition duration-200" wire:navigate>Recupérela acá</a>
            </span>
        </div>
    </form>
</div>