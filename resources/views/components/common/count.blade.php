<div class="relative w-60 lg:w-96 h-40 bg-gradient-to-r from-red-500 to-red-700 rounded-2xl shadow-lg hover:shadow-2xl transition-transform p-5 flex flex-col justify-between">
    
    
    <h3 class="text-lg ml-5 font-semibold text-white text-center">
        {{ $item }}
    </h3>
    
  
    <div class="absolute top-4 left-4 flex items-center justify-center w-14 h-14 bg-white rounded-full shadow-md">
        <i class="{{ $icon }} text-red-600 text-2xl"></i>
    </div>


    <h3 class="text-4xl font-extrabold text-white text-right">
        {{ $quantity }}
    </h3>
</div>
