<?php

namespace App\Livewire\Pages\Paciente;


use Livewire\Component;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Traits\LogoutTrait;
use App\Models\Turn;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;







class Turns extends Component
{
    use LogoutTrait;

    public $specialties;
    public $specialtyId;
    public $doctors;
    public $user_id;
    public $turns;
    public $count_turns;
    public $turns_availables = [];
    public $error = 'dsadsa';

    protected $listeners = ['cancelConfirmed','showTurnsAvailables','editOldTurn','editNewTurn'];

    



   
    public function render()
    {
        $this->getDoctors();  
        $this->loadTurns($this->user_id);

        return view('livewire.pages.paciente.turns');
    }

   
    public function mount()
    {
        $this->user_id = session('user_id');

        $this->getSpecialties(); 
        $this->loadTurns($this->user_id);
    }





    // Carga los turnos del usuario
    public function loadTurns($user_id){
        $this->turns = Turn::with(['doctor.specialty'])
                    ->where('user_id', $user_id)
                    ->whereDate('date', '>=', now()->toDateString())
                    ->orderBy('date', 'asc')
                    ->get(['id','date', 'time', 'doctor_id']);


        $this->turns = $this->turns->map(function ($turn) {
            return [
                'id' => $turn->id,
                'specialty' => $turn->doctor->specialty->specialty,
                'doctor_id' => $turn->doctor->id,
                'doctor_name' => $turn->doctor->user->name,
                'date' => $turn->date,
                'time' => $turn->time,
            ];
        });    

        $this->count_turns = $this->turns->count();


    }







    // Obtiene las especialidades
    public function getSpecialties()
    {
        $this->specialties = Specialty::with('doctors')->get();
    }






    // Actualiza los doctores cuando se selecciona una especialidad
    public function updatedSpecialtyName()
    {
        $this->getDoctors();
    }







    // Obtiene los doctores de una especialidad
    public function getDoctors()
    {
        if ($this->specialtyId) {
            $this->doctors = Doctor::where('specialty_id', $this->specialtyId)->get();
        } else {
            $this->doctors = []; 
        }
    }







    // Confirma la cancelación de un turno
    public function cancelConfirmed($turnId){
        $this->cancelTurn($turnId);
    }






    // Cancela un turno
    public function cancelTurn($turnId){
        $turn = Turn::find($turnId);

        $turn->update([
            'user_id' => NULL,
            'status' => 'available'
        ]);
    }







    // Obtiene los turnos disponibles de un doctor
    public function getTurnsAvailables($id){
        $turns = DB::table('turns')
                ->select('id','date', 'time', 'status')
                ->where('status', 'available')
                ->where('date', '<=', Carbon::now()->addMonths(2))
                ->where('doctor_id', $id)
                ->whereDate('date', '>=', Carbon::now()->toDateString()) 
                ->orderBy('date')
                ->get()
                ->groupBy('date');
 
 
        $this->turns_availables = $turns;

        
    }
   







    // Muestra los turnos disponibles de un doctor
    public function showTurnsAvailables($doctorId){
        $this->getTurnsAvailables($doctorId);
    }


   
    public function editOldTurn($oldTurnId)
    {
        $turn = Turn::find($oldTurnId);


        if($turn){
            $turn->update([
                'user_id' => NULL,
                'status' => 'available'
            ]);
        }else{
            $this->error = 'No se pudo editar el turno';
        }

        

        //$this->loadTurns($this->user_id);
    }


    public function editNewTurn($oldTurnId,$newTurnId){
        $newTurn = Turn::find($newTurnId);


        $newTurn->update([
            'user_id' => $this->user_id,
            'status' => 'unavailable'
        ]);

        $this->editOldTurn($oldTurnId);
    }
}
