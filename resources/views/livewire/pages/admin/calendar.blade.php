<div x-data="{ sidebarOpen: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />



    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div>
                

                {{ $events }}

              

                
            </div>

        </main>
    </div>
</div>
