<div class="bg-login-admin w-screen h-screen px-10 flex items-center justify-start bg-red-500">
    <form wire:submit.prevent="login" class="w-[500px] py-10 bg-white rounded-md">
        <h3 class="text-2xl text-center mb-6">Login profesional</h3>
        <input wire:model="email" type="text" class="block w-5/6 m-auto my-3 p-3 text-xl border border-red-400 focus:border-red-600" placeholder="Correo electrónico..."/>
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        <input wire:model="password" type="password" class="block w-5/6 m-auto my-5 p-3 text-xl border border-red-400 focus:border-red-600" placeholder="Contraseña..."/>
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        <button class="block w-5/6 m-auto text-white text-xl p-3 bg-red-500 hover:bg-red-600 duration-300">
            ingresar
        </button>     
    </form>
</div>  
