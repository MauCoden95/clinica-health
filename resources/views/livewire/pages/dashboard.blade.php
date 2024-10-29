<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

    <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
        class="bg-white w-64 min-h-screen flex flex-col md:block">
        <div class="flex items-center justify-center h-24 border-b">
            <img class="w-28" src="http://localhost:8000/img/Logo.png" />
        </div>
        <x-common.dashboard_nav />
    </div>


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white p-6">
            @yield('content')
        </main>
    </div>
</div>
