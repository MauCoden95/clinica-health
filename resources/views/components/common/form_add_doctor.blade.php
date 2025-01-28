<div>
    <div class="text-center mt-12 text-2xl">Registrar nuevo profesional</div>


    <form wire:submit.prevent="create_doctor" class="w-full p-12 grid gap-3 grid-cols-2" autoComplete="off">
        <div>
            <input wire:model="name" class="w-full p-3 border-b border-red-500" type="text" name="name" placeholder="Nombre completo..." />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>



        <div>
            <select id="options" wire:model="specialty_id" name="specialty_id" class="w-full p-3 border-b border-red-500">
                <option value="">--Especialidad--</option>
                @foreach($specialties as $specialty)
                <option value="{{ $specialty->id }}">{{ $specialty->specialty }}</option>
                @endforeach
            </select>
        </div>



        <div>
            <input wire:model="email" class="w-full p-3 border-b border-red-500" type="email" name="email" placeholder="Correo electrónico..." />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>



        <div>
            <input wire:model="address" class="w-full p-3 border-b border-red-500" type="text" name="address" placeholder="Dirección..." />
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="dni" class="w-full p-3 border-b border-red-500" type="number" name="dni" placeholder="Dni..." />
            @error('dni') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>



        <div>
            <input wire:model="license" class="w-full p-3 border-b border-red-500" type="number" name="license" placeholder="Matrícula..." />
            @error('license') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="phone" class="w-full p-3 border-b border-red-500" type="number" name="phone" placeholder="Teléfono..." />
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>



        <div>
            <select wire:model="day_of_week" name="day_of_week" class="w-full p-3 border-b border-red-500">
                <option value="">--Día de la semana--</option>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miércoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sábado</option>
            </select>
        </div>

        <div>
            <input wire:model="start_time" min="08:00" max="20:00" class="w-full p-3 border-b border-red-500" type="time" name="start_time" placeholder="Hora de inicio..." />
            @error('start_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="end_time" min="08:00" max="20:00" class="w-full p-3 border-b border-red-500" type="time" name="end_time" placeholder="Hora de fin..." />
            @error('end_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button class="w-full p-3 text-xl bg-red-500 hover:bg-red-400 duration-300">
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>