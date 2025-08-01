@if($background == 'red')
<div class="relative w-60 h-40 bg-red-400 rounded-lg overflow-hidden">
    <h3 class="text-center my-3 text-xl">{{ $item }}</h3>
    <i class="absolute -left-7 -bottom-7 text-9xl text-red-500 w-1/6 {{ $icon }}"></i>
    <h3 class="absolute right-4 bottom-4 text-3xl px-3 py-2 text-center text-gray-900">
        {{ $quantity }} $
    </h3>
</div>
@else
<div class="relative w-60 h-40 bg-green-400 rounded-lg overflow-hidden">
    <h3 class="text-center my-3 text-xl">{{ $item }}</h3>
    <i class="absolute -left-7 -bottom-7 text-9xl text-green-500 w-1/6 {{ $icon }}"></i>
    <h3 class="absolute right-4 bottom-4 text-3xl px-3 py-2 text-center text-gray-900">
        {{ $quantity }} $
    </h3>
</div>
@endif
