<div class="w-screen h-screen bg-white">
    <img class="w-32 m-auto" src="http://localhost:8000/img/Logo.png"/>
    <h1 class="text-center text-2xl text-black my-6">Recuperar contraseña</h1>
    <form wire:submit.prevent="changePasswordLost" class="w-4/6 m-auto">
        <div class="mb-4">
            <input type="password" wire:model="password" id="password" name="password" class="mt-1 bg-white block w-full px-3 py-2 border-b border-red-500  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Contraseña">
        </div>
        <div class="mb-4">
            <input type="password" wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" class="mt-1 bg-white block w-full px-3 py-2 border-b border-red-500  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Confirmar contraseña">
        </div>
        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 my-12 bg-red-500 hover:bg-red-800 duration-300 text-white w-full p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Enviar</button>
        </div>
    </form>
</div>