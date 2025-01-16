<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Services extends Component
{
    public $doctors;

    public function mount(){
        $this->doctors = [
            ['id' => 1, 'name' => 'Carolina Rojas', 'specialty' => 'Clínica Médica', 'image' => 'http://localhost:8080/img/CarolinaRojas.jpg', 'atl' => 'Doctora'],
            ['id' => 1, 'name' => 'Benjamin Flores', 'specialty' => 'Pediatra', 'image' => 'http://localhost:8080/img/BenjaminFlores.jpg', 'atl' => 'Doctor'],
            ['id' => 1, 'name' => 'Esteban Zapata', 'specialty' => 'Cardiólogo', 'image' => 'http://localhost:8080/img/EstebanZapata.jpg', 'atl' => 'Doctor'],
            ['id' => 1, 'name' => 'Fernando Aguirre', 'specialty' => 'Dentista', 'image' => 'http://localhost:8080/img/FernandoAguirre.jpg', 'atl' => 'Doctor'],
            ['id' => 1, 'name' => 'Lucía Altamirano', 'specialty' => 'Dermatóloga', 'image' => 'http://localhost:8080/img/ClaudiaCarro.jpg', 'atl' => 'Doctora'],
            ['id' => 1, 'name' => 'Laura Florio', 'specialty' => 'Psicóloga', 'image' => 'http://localhost:8080/img/ClaudiaCarro.jpg', 'atl' => 'Doctora'],
        ];
    }

    public function render()
    {
        return view('livewire.pages.services');
    }
}
