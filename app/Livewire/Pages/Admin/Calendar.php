<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Carbon\Carbon;
use App\Traits\LogoutTrait;
use App\Repositories\TurnRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\UserRepository;
use App\Models\Turn;

class Calendar extends Component
{
    use LogoutTrait;

    public $events = [];
    public $turns = [];
    public $turnsByPatient = [];
    public $selectedDate;
    public $todayDate = '';
    public $occupation_day = 50;
    public $topThreeSpecialties = [];
    public $topThreeDoctors = [];
    public $patients = [];
    public $inputSearch = '';
    public $turns_availables = [];
    public $old_turn;

    protected $turnRepository;
    protected $doctorRepository;
    protected $userRepository;





    public function __construct()
    {
        $this->turnRepository = new TurnRepository();
        $this->doctorRepository = new DoctorRepository();
        $this->userRepository = new UserRepository();
    }






    public function mount()
    {
        $this->loadEvents();
        $this->todayDate = Carbon::now()->format('d-m-y');
        $this->occupation_day = $this->turnRepository->getOccupationPercentage();
        $this->topThreeSpecialties = $this->doctorRepository->getTopThreeSpecialties();
        $this->topThreeDoctors = $this->doctorRepository->getTopThreeDoctors();
        $this->patients = $this->userRepository->getPatientsWithRepeatedTurns();
        $this->showTurnsToday();
    }





    public function loadEvents()
    {
        $this->events = $this->turnRepository->getUnavailableTurns()->map(function ($turn) {
            return [
                'name_doctor' => $turn->doctor->user->name,
                'specialty' => $turn->doctor->specialty->specialty,
                'date' => $turn->date,
                'time' => $turn->time,
            ];
        });
    }



    

    public function showTurnsToday()
    {
        $this->turns = $this->turnRepository->getTurnsToday()->map(function($turn) {
            return [
                'id' => $turn->id,
                'doctor_id' => $turn->doctor_id,
                'name_patient' => $turn->user ? $turn->user->name : 'Paciente no disponible',
                'doctor_name' => $turn->doctor && $turn->doctor->user ? $turn->doctor->user->name : 'Médico no disponible',
                'specialty' => $turn->doctor && $turn->doctor->specialty ? $turn->doctor->specialty->specialty : 'Especialidad no disponible',
                'date' => $turn->date,
                'time' => $turn->time,
                'status' => $turn->status
            ];
        })->toArray();
    }





    public function getTurnsByPatient($user_id)
    {
        $this->turnsByPatient = $this->turnRepository->getTurnsByPatient($user_id);
    }






    public function render()
    {
        $this->filterTurnsByDoctorOrSpecialty();

        return view('livewire.pages.admin.calendar', [
            'turns' => $this->turns,
            'occupation_day' => $this->occupation_day,
            'topThreeSpecialties' => $this->topThreeSpecialties,
            'topThreeDoctors' => $this->topThreeDoctors,
            'patients' => $this->patients,
            'turns_availables' => $this->turns_availables
        ]);
    }







    public function filterTurnsByDoctorOrSpecialty()
    {
        if (empty($this->inputSearch)) {
            $this->showTurnsToday();
            return;
        }

        $searchTerm = strtolower($this->inputSearch);
        $turns = $this->turnRepository->getTurnsToday()->filter(function ($turn) use ($searchTerm) {
            $doctorName = $turn->doctor && $turn->doctor->user ? strtolower($turn->doctor->user->name) : '';
            $specialty = $turn->doctor && $turn->doctor->specialty ? strtolower($turn->doctor->specialty->specialty) : '';
            $patientName = $turn->user ? strtolower($turn->user->name) : '';
            
            return str_contains($doctorName, $searchTerm) ||
                   str_contains($specialty, $searchTerm) ||
                   str_contains($patientName, $searchTerm);
        });

        

        $this->turns = $turns->map(function($turn) {
            return [
                'id' => $turn->id,
                'doctor_id' => $turn->doctor_id,
                'name_patient' => $turn->user ? $turn->user->name : 'Paciente no disponible',
                'doctor_name' => $turn->doctor && $turn->doctor->user ? $turn->doctor->user->name : 'Médico no disponible',
                'specialty' => $turn->doctor && $turn->doctor->specialty ? $turn->doctor->specialty->specialty : 'Especialidad no disponible',
                'date' => $turn->date,
                'time' => $turn->time,
                'status' => $turn->status
            ];
        })->toArray();
    }



    public function getTurnsAvailables($id)
    {
        $turns = $this->turnRepository->getAvailableTurnsForDoctor($id);


        $groupedTurns = $turns->groupBy('date');


        $this->turns_availables = [];
        foreach ($groupedTurns as $date => $turnsForDate) {
            $this->turns_availables[$date] = $turnsForDate;
        }
    }



    public function editTurn($turn_id, $old_turn_id, $time){
        $turn = Turn::find($turn_id);

        $turn->update([
            'status' => 'available'
        ]);

        $old_turn = Turn::find($old_turn_id);

        

        
        $update_old_turn = $old_turn->update([
            'status' => 'available'
        ]);

        $update = $turn->update([
            'status' => 'unavailable'
        ]);
        
        

        if ($update) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Turno cambiado correctamente'
            ]);

            $this->showTurnsToday();    
        }

        
    }


    
}
