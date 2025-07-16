<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">

            <div class="relative w-full mx-auto mt-8 px-14 py-10 bg-gray-100 rounded-lg shadow-md">
                <div class="w-full flex justify-between">
                    <h2 class="text-2xl font-semibold mb-6">Editar Doctor</h2>
                    <a wire:navigate href="{{ route('admin.doctor') }}" class="text-xl">Volver a doctores</a>
                </div>






                <form wire:submit.prevent="editDoctor" class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Dirección</label>
                        <input type="text" id="address" wire:model="address" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">Teléfono</label>
                        <input type="number" id="phone" wire:model="phone" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 font-bold mb-2">DNI</label>
                        <input type="number" id="dni" wire:model="dni" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="license" class="block text-gray-700 font-bold mb-2">Matrícula</label>
                        <input type="number" id="license" wire:model="license" class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mb-4">
                        <select wire:model="specialty_id" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Seleccione una especialidad</option>
                            @foreach($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->specialty }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 duration-300">
                            Actualizar Doctor
                        </button>
                    </div>





                </form>
            </div>
        </main>
    </div>
</div>