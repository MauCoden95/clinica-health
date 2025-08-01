<div x-data="{ sidebarOpen: false, showIncomesMoney: false, showExpensesMoney: false, showPaymentMethods: false, showCreatePaymentMethod: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">
    <x-common.sidebar />


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">

                <x-common.count_finance :item="'Ingresos de hoy'" :background="'green'" :quantity="$todayIncomes->sum('amount')" :icon="'fas fa-money-bill-wave-alt'" />
                <x-common.count_finance :item="'Egresos de hoy'" :background="'red'" :quantity="$todayExpenses->sum('amount')" :icon="'fas fa-money-bill-wave-alt'" />

                <div class="flex flex-col">
                    <button @click="showPaymentMethods = true" class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Métodos de pago <i class="fas fa-credit-card"></i>
                    </button>

                    <button @click="showIncomesMoney = true" class="btn_add h-12 p-3 mt-2 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Nuevo ingreso <i class="fas fa-plus-circle"></i>
                    </button>

                    <button @click="showExpensesMoney = true" class="btn_add h-12 p-3 mt-2 bg-red-400 hover:bg-red-500 duration-300 rounded-md">
                        Nuevo Egreso <i class="fas fa-minus-circle"></i>
                    </button>
                </div>
            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h2 class="text-center mt-12 mb-3 text-xl">Comparación ingresos vs gastos los últimos 6 meses</h2>

                <x-common.graph.grouped_incomes_expenses
                    :months="$months"
                    :incomes="$incomes"
                    :expenses="$expenses"
                    chart-id="incomesExpensesGroupedChart" />




            </div>


            <div class="relative w-full px-14 overflow-x-auto mb-7 flex gap-7 justify-between">
                <div>
                    <h2 class="text-center mt-12 mb-3 text-xl">Total facturado por médico este mes</h2>
                    <table class="m-auto mt-6">
                        <thead>
                            <tr>
                                <th class="py-2 bg-red-500 text-center px-5 text-white">Médico</th>
                                <th class="py-2 bg-red-500 text-center px-5 text-white">Especialidad</th>
                                <th class="py-2 bg-red-500 text-center px-5 text-white">Total facturado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctor_earnings as $doctor)
                            <tr>
                                <td class="py-2 border text-center px-5">Dr. {{ $doctor->name }}</td>
                                <td class="py-2 border text-center px-5">{{ $doctor->specialty->specialty }}</td>
                                <td class="py-2 border text-center px-5">{{ number_format($doctor->total_invoiced, 0, ',', '.') }} $</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div>
                    <h2 class="text-center mt-12 mb-3 text-xl">Total facturado por especialidad este mes</h2>   
                    <table class="m-auto mt-6">
                        <thead>
                            <tr>
                                <th class="py-2 bg-red-500 text-center px-5 text-white">Especialidad</th>
                                <th class="py-2 bg-red-500 text-center px-5 text-white">Total facturado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specialty_earnings as $specialty)
                            <tr>
                                <td class="py-2 border text-center px-5">{{ $specialty->specialty }}</td>
                                <td class="py-2 border text-center px-5">{{ number_format($specialty->total_invoiced, 0, ',', '.') }} $</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </main>
    </div>


    {{-- Modal para metodos de pago --}}
    <div x-show=" showPaymentMethods" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
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







    {{-- Modal para ingresar dinero --}}
    <div x-show=" showIncomesMoney" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">Ingresar dinero</h2>
            <form wire:submit.prevent="addIncome">
                <input type="text" placeholder="Descripción" wire:model="description" class="w-full p-3 border border-red-500 rounded-md mb-4">
                <input type="number" placeholder="Monto" wire:model="amount" class="w-full p-3 border border-red-500 rounded-md mb-4">
                <div>
                    <button type="submit" class="h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">Agregar</button>
                    <button type="button" @click="showIncomesMoney = false" class="h-12 p-3 mt-6 bg-gray-300 hover:bg-gray-400 duration-300 rounded-md">Cancelar</button>
                </div>
            </form>



        </div>
    </div>




    {{-- Modal para ingresar gastos --}}
    <div x-show=" showExpensesMoney" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">Ingresar gasto</h2>
            <form wire:submit.prevent="addExpense">
                <input type="text" placeholder="Descripción" wire:model="description" class="w-full p-3 border border-red-500 rounded-md mb-4">
                <input type="number" placeholder="Monto" wire:model="amount" class="w-full p-3 border border-red-500 rounded-md mb-4">
                <div>
                    <button type="submit" class="h-12 p-3 bg-red-400 hover:bg-red-500 duration-300 rounded-md">Agregar</button>
                    <button type="button" @click="showExpensesMoney = false" class="h-12 p-3 mt-6 bg-gray-300 hover:bg-gray-400 duration-300 rounded-md">Cancelar</button>
                </div>
            </form>



        </div>
    </div>


</div>