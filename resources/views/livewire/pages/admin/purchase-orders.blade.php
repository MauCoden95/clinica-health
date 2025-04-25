<div x-data="{ sidebarOpen: false, showCategories: false, showCreateProduct: false, showEditProduct: false, showProviders: false, showFormCreate: false, showConfirmDelete: false, showReports: false, productToDeleteId: null, productToEditId: null, name: null, productId: 0, supplier_id: 0, description: null, price: 0, stock: 0, stock_reposition: 0 }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
               



                <div class="grid gap-7 grid-cols-2">
                    <button wire:navigate href="http://127.0.0.1:8000/admin/ordenes-compra" class="w-auto h-12 px-12 mb-6 rounded-md p-2 duration-300 bg-green-400 hover:bg-green-500">
                        Generar orden de compra
                        <i class="fas fa-file-invoice-dollar"></i>



                    </button>
                </div>



            </div>










         



            {{-- Modal para ver los reportes --}}
            <div x-show="showReports" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="w-2/5 bg-white p-6 rounded-lg shadow-lg max-h-[80vh] overflow-y-auto">
                    <h2 class="text-2xl text-center">Reportes de inventario</h2>
                    <button @click="showReports = false" class="block m-auto mt-5 px-5 bg-gray-600 hover:bg-gray-700 text-white p-2">
                        Cerrar
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

        </main>





    </div>
</div>