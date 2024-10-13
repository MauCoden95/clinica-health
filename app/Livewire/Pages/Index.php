<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Index extends Component
{
    public $services = [];

    public function mount()
    {
        $this->services = [
            ['id' => 1, 'specialty' => 'Clínica Médica', 'image' => 'http://localhost:8000/img/Doctor.jpg', 'atl' => 'Clínica', 'desc' => 'Nuestra clínica médica ofrece un enfoque completo para el diagnóstico, tratamiento y prevención de enfermedades.'],
            ['id' => 2, 'specialty' => 'Pediatría', 'image' => 'http://localhost:8000/img/Pediatrics.jpg', 'atl' => 'Pediatria', 'desc' => 'Nuestra unidad de pediatría ofrece atención médica integral y compasiva para niños de todas las edades.'],
            ['id' => 3, 'specialty' => 'Cardiología', 'image' => 'http://localhost:8000/img/Cardiology.jpg', 'atl' => 'Cardiologia', 'desc' => 'En nuestra unidad de cardiología, ofrecemos diagnóstico y tratamiento avanzado enfermedades del corazón.'],
            ['id' => 4, 'specialty' => 'Dermatología', 'image' => 'http://localhost:8000/img/Dermatology.jpg', 'atl' => 'Dermatologia', 'desc' => 'Nuestra unidad de dermatología se especializa en el diagnóstico y tratamiento de afecciones de la piel, cabello y uñas.'],
            ['id' => 5, 'specialty' => 'Dentista', 'image' => 'http://localhost:8000/img/Dentist.jpg', 'atl' => 'Dentista', 'desc' => ' Desde consultas generales hasta la gestión de enfermedades crónicas, estamos aquí para garantizar tu bienestar.'],
            ['id' => 6, 'specialty' => 'Psicología', 'image' => 'http://localhost:8000/img/Psychologist.jpg', 'atl' => 'Psicólogo', 'desc' => ' Con un equipo de profesionales dedicados, proporcionamos terapias personalizadas para mejorar tu bienestar emocional.'],
        ];
    }


    public function render()
    {
        return view('livewire.pages.index');
    }
}
