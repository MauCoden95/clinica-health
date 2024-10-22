import './bootstrap';
import Swal from 'sweetalert2'

window.addEventListener('load', () => {
    window.Swal = Swal;


  

    initEventListeners();

   
    Livewire.hook('message.processed', (message, component) => {
        initEventListeners();
    });
})