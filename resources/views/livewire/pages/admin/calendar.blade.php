<div x-data="{ sidebarOpen: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />



    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 px-14 overflow-x-hidden overflow-y-auto bg-white">
            <div>
              <h1 class="text-2xl my-7 text-center font-bold">Calendario de turnos</h1>

              <div x-data="{ calendar: 'monthly' }" class="w-5/6 m-auto mb-7">
                <div class="w-full flex gap-7 mb-7">
                    <button @click="calendar = 'monthly'; updateCalendarView('dayGridMonth')" class="w-full bg-red-500 hover:bg-red-800 duration-300 text-white p-3 my-1">Turnos mensuales</button>
                    <button @click="calendar = 'weekly'; updateCalendarView('timeGridWeek')" class="w-full bg-red-500 hover:bg-red-800 duration-300 text-white p-3 my-1">Turnos semanales</button>
                    <button @click="calendar = 'daily'; updateCalendarView('timeGridDay')" class="w-full bg-red-500 hover:bg-red-800 duration-300 text-white p-3 my-1">Turnos diarios</button>
                </div>
               
                <div id="calendar"></div>
              </div>
              

              


            </div>

        </main>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script>

    <script>
      let calendar;
      
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'es',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
          },
          dayCellClassNames: function(arg) {
            if (arg.date.getMonth() !== new Date().getMonth()) {
              return 'bg-gray-200 text-gray-400';
            }
            return '';
          }
        });

        calendar.render();
      });

      function updateCalendarView(view) {
        if (calendar) {
          calendar.changeView(view);
        }
      }
    </script>
@endpush
