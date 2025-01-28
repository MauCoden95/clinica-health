import './bootstrap';
import Swal from 'sweetalert2'

window.addEventListener('load', () => {
    window.Swal = Swal;


  

    initEventListeners();


    
   calendar();
    
})


function initEventListeners() {
    Livewire.on('showAlert', (data) => {
        Swal.fire({
            title: data[0].title,
            text: data[0].text,
            icon: data[0].type,
        });
    });

    
}



