import './bootstrap';
import Swal from 'sweetalert2';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.timeGridPlugin = timeGridPlugin;
window.interactionPlugin = interactionPlugin;

window.addEventListener('load', () => {
    window.Swal = Swal;
    initEventListeners();
    initCalendar();
});

function initEventListeners() {
    Livewire.on('showAlert', (data) => {
        Swal.fire({
            title: data[0].title,
            text: data[0].text,
            icon: data[0].type,
        });
    });

    Livewire.on('showAlertConfirm', (data) => {
        Swal.fire({
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            title: data[0].title,
            text: data[0].text,
            icon: data[0].type,
        });
    });
}

function initCalendar() {
    const calendarEl = document.getElementById('calendar');
    
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'title',
                center: '',
                right: 'prev,next today'
            },
            locale: 'es',
            buttonText: {
                today: 'Hoy'
            },
            validRange: null,
            dayCellClassNames: function(arg) {
                if (arg.date < new Date().setHours(0,0,0,0) && 
                    !(arg.date.getDate() === new Date().getDate() && 
                      arg.date.getMonth() === new Date().getMonth() &&
                      arg.date.getFullYear() === new Date().getFullYear())) {
                    return ['fc-day-past'];
                }
                return [];
            },
            dayCellDidMount: function(info) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
          
               
                if (info.date < today) {
                  info.el.classList.add('fc-past-custom');
                }
              },
            editable: false,
            selectable: false,
            height: 'auto'
        });

        calendar.render();
        window.calendar = calendar; 
    }
}



    const btnOpen = document.getElementById('menu-btn');
    const btnClose = document.getElementById('close-btn');
    const menu = document.getElementById('mobile-menu');

    function openMenu() {
        menu.classList.remove('-translate-x-full', 'opacity-0', 'pointer-events-none');
        menu.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
    }

    function closeMenu() {
        menu.classList.add('-translate-x-full', 'opacity-0', 'pointer-events-none');
        menu.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
    }

    btnOpen.addEventListener('click', openMenu);
    btnClose.addEventListener('click', closeMenu);
