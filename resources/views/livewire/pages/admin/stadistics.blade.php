<div x-data="{ sidebarOpen: false, confirmDeleteVisible: false, doctorId: null }" class="relative flex h-screen bg-gray-100 overflow-hidden">
    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                @livewire('pages.admin.statistics.turns-statistics')

            </div>

        </main>
    </div>





</div>