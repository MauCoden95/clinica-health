<div x-data="{ sidebarOpen: false, showPaymentMethods: false, showCreatePaymentMethod: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">
    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">

                <x-common.count_finance :item="'Ingresos de hoy'" :quantity="$todayIncomes->sum('amount')" :icon="'fas fa-money-bill-wave-alt'" />

                <div x-data="{ visible: false }">
                    <button @click="showPaymentMethods = true" class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Métodos de pago <i class="fas fa-credit-card"></i>
                    </button>


                </div>
            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">

            </div>
        </main>
    </div>


    {{-- Modal para metodos de pago --}}
    <div x-show="showPaymentMethods"  class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">Métodos de pago</h2>
            <button @click="showCreatePaymentMethod = true" class="h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                Agregar nuevo método de pago
            </button>



            <div x-show="showCreatePaymentMethod" @payment-method-added.window="showCreatePaymentMethod = false" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-4">Agregar nuevo método de pago</h2>
                    <form wire:submit.prevent="addPaymentMethod">
                        <input type="text" placeholder="Nombre" wire:model="name" class="w-full p-3 border border-red-500 rounded-md mb-4">
                        <input type="text" placeholder="Descripción" wire:model="description_pm" class="w-full p-3 border border-red-500 rounded-md mb-4">
                        <div>
                            <button type="submit" class="h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">Agregar</button>
                            <button type="button" @click="showCreatePaymentMethod = false" class="h-12 p-3 mt-6 bg-gray-300 hover:bg-gray-400 duration-300 rounded-md">Cancelar</button>
                        </div>
                    </form>

                </div>
            </div>


            <x-common.paymentmethod_list />
           
            <button @click="showPaymentMethods = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>



</div>