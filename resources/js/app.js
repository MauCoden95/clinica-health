import './bootstrap';
import Swal from 'sweetalert2'

window.addEventListener('load', () => {
    window.Swal = Swal;


    const btnAdd = document.querySelector('.btn_add');
    const btnClose = document.querySelector('.btn_close');
    const divAdd = document.querySelector('.div_add');
    const divAdd__div = document.querySelector('.div_add__div');
    function initEventListeners() {
        btnAdd.addEventListener('click', () => {
            divAdd.style.display = 'flex';
            divAdd__div.classList.add('animated-div');
        });

        btnClose.addEventListener('click', () => {
            divAdd.style.display = 'none';
            divAdd__div.classList.remove('animated-div');
        });
    }

    initEventListeners();

    // Re-inicializa los eventos después de cada actualización de Livewire
    Livewire.hook('message.processed', (message, component) => {
        initEventListeners();
    });
})