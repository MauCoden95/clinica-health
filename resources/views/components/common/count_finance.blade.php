@if($background == 'red')
<div class="relative w-[25%] h-44 rounded-2xl shadow-lg overflow-hidden transform transition duration-300 bg-gradient-to-br from-red-400 to-red-600">
    
    <!-- Nombre del item -->
    <h3 class="text-center mt-4 text-xl font-semibold text-white drop-shadow-md">
        {{ $item }}
    </h3>

    <!-- Icono decorativo -->
    <i class="absolute -left-6 -bottom-6 text-9xl opacity-20 text-red-900 {{ $icon }}"></i>

    <!-- Cantidad -->
    <h3 class="absolute right-4 bottom-4 text-4xl font-bold px-4 py-2 rounded-lg bg-white/80 text-gray-900 shadow-md">
        {{ $quantity }} $
    </h3>
</div>
@else
<div class="relative w-[25%] h-44 rounded-2xl shadow-lg overflow-hidden transform transition duration-300 bg-gradient-to-br from-green-400 to-green-600">
    
    <!-- Nombre del item -->
    <h3 class="text-center mt-4 text-xl font-semibold text-white drop-shadow-md">
        {{ $item }}
    </h3>

    <!-- Icono decorativo -->
    <i class="absolute -left-6 -bottom-6 text-9xl opacity-20 text-green-900 {{ $icon }}"></i>

    <!-- Cantidad -->
    <h3 class="absolute right-4 bottom-4 text-4xl font-bold px-4 py-2 rounded-lg bg-white/80 text-gray-900 shadow-md">
        {{ $quantity }} $
    </h3>
</div>
@endif
