<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Models\DoctorSchedule;
use App\Models\Doctor;

class EditDoctorSchedule extends Component
{
    use LogoutTrait;


    public $doctor_schedule;

    public $doctor_id;
    public $day_of_week;
    public $start_time;
    public $end_time;
    public $slot_duration = 20;
    public $name_doctor;

    protected $rules = [
        'day_of_week' => 'required',
        'start_time' => 'required',
        'end_time' => 'required'
    ];


    public function mount($id)
    {
        $this->doctor_schedule = DoctorSchedule::where('doctor_id', '=', $id)->first();
        $this->doctor_id = $this->doctor_schedule->doctor_id;
        $this->day_of_week = $this->doctor_schedule->dayOfWeek;
        $this->start_time = $this->doctor_schedule->initialHour;
        $this->end_time = $this->doctor_schedule->finalHour;
        $this->name_doctor = Doctor::select('name')->where('id', '=', $id)->first()->name;
    }


    public function render()
    {
        return view('livewire.pages.admin.edit-doctor-schedule');
    }

    public function editDoctorSchedule($id)
    {
        try {
            $validatedData = $this->validate([
                'day_of_week' => 'required',
                'start_time' => 'required',
                'end_time' => 'required'
            ]);


            $update = DoctorSchedule::where('doctor_id', '=', $id)->update($validatedData);

            if ($update) {
                $this->dispatch('showAlert', [
                    'type' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Jornada del médico actualizada correctamente'
                ]);
            }else{
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'title' => '¡Error!',
                    'text' => 'Hubo un error al actualizar la jornada del médico'
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
