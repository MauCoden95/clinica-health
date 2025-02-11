<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Carbon\Carbon;
use App\Traits\LogoutTrait;
use App\Repositories\TurnRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\UserRepository;

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
                'name_patient' => $turn->user->name,
                'name_doctor' => $turn->doctor->user->name,
                'specialty' => $turn->doctor->specialty->specialty,
                'date' => $turn->date,
                'time' => $turn->time,
            ];
        });
    }

    public function showTurnsToday()
    {
        $this->turns = $this->turnRepository->getTurnsToday();
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
            'patients' => $this->patients
        ]);
    }

    public function filterTurnsByDoctorOrSpecialty()
    {
        $this->turns = $this->turnRepository->getTurnsToday()->filter(function ($turn) {
            return str_contains(strtolower($turn->doctor->user->name), strtolower($this->inputSearch)) ||
                   str_contains(strtolower($turn->doctor->specialty->specialty), strtolower($this->inputSearch)) ||
                   str_contains(strtolower($turn->user->name), strtolower($this->inputSearch));
        });
    }
}
