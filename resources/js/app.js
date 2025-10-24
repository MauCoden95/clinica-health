// Cargar solo lo esencial de forma síncrona
import './bootstrap';

// Función para cargar módulos de forma dinámica
async function loadDependencies() {
    try {
        // Cargar SweetAlert2 solo cuando sea necesario
        const { default: Swal } = await import('sweetalert2');
        window.Swal = Swal;

        // Inicializar listeners de eventos
        initEventListeners(Swal);

        // Cargar FullCalendar solo si existe el elemento del calendario
        if (document.getElementById('calendar')) {
            await loadCalendar();
        }

        // Inicializar menú móvil
        initMobileMenu();
    } catch (error) {
        console.error('Error al cargar dependencias:', error);
    }
}

// Inicializar menú móvil
function initMobileMenu() {
    const btnOpen = document.getElementById('menu-btn');
    const btnClose = document.getElementById('close-btn');
    const menu = document.getElementById('mobile-menu');

    if (!btnOpen || !btnClose || !menu) return;

    function openMenu(e) {
        e.preventDefault();
        menu.classList.remove('-translate-x-full', 'opacity-0', 'pointer-events-none');
        menu.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
        document.body.classList.add('menu-open');
    }

    function closeMenu(e) {
        e.preventDefault();
        menu.classList.add('-translate-x-full', 'opacity-0', 'pointer-events-none');
        menu.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
        document.body.classList.remove('menu-open');
    }

    btnOpen.addEventListener('click', openMenu);
    btnClose.addEventListener('click', closeMenu);
}

// Función para inicializar los listeners de eventos
function initEventListeners(Swal) {
    // Configurar listeners de Livewire
    if (window.Livewire) {
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
}

// Cargar FullCalendar de forma dinámica
async function loadCalendar() {
    try {
        // Cargar solo los módulos necesarios
        const [
            { Calendar },
            { default: dayGridPlugin },
            { default: interactionPlugin }
        ] = await Promise.all([
            import('@fullcalendar/core'),
            import('@fullcalendar/daygrid'),
            import('@fullcalendar/interaction')
        ]);

        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

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
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            firstDay: 1, // Lunes como primer día de la semana
            height: 'auto',
            contentHeight: 'auto',
            dayCellClassNames: function(arg) {
                const today = new Date();
                const cellDate = new Date(arg.date);
                
                today.setHours(0, 0, 0, 0);
                cellDate.setHours(0, 0, 0, 0);
                
                return cellDate < today ? ['fc-day-past'] : [];
            },
            editable: false,
            selectable: false
        });

        calendar.render();
        window.calendar = calendar;
    } catch (error) {
        console.error('Error al cargar el calendario:', error);
    }
}

// Iniciar la carga de dependencias cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadDependencies);
} else {
    loadDependencies();
}
