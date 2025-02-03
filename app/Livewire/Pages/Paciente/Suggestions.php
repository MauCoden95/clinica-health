<?php

namespace App\Livewire\Pages\Paciente;

use App\Models\Suggestion;
use Livewire\Component;
use App\Traits\LogoutTrait;

class Suggestions extends Component
{
    use LogoutTrait;

    public $count_suggestions;
    public $suggestions;
    public $user_id;


  
    public $suggestionId;
    public $affair;
    public $description;
    public $date;
    public $time;


    protected $listeners = ['deleteConfirmed'];


    protected $rules = [
        'affair' => 'required|string|max:255',
        'description' => 'required|string|max:255'
    ];






    public function mount()
    {
        $this->user_id = session('user_id');
        $this->loadSuggestions($this->user_id);
    }


    public function render()
    {
        $this->loadSuggestions($this->user_id);

        return view('livewire.pages.paciente.suggestions');
    }







    public function loadSuggestions($user_id)
    {
        $this->suggestions = Suggestion::where('user_id', '=', $user_id)->get();

        $this->count_suggestions = $this->suggestions->count();
    }



    public function create()
    {
        $this->validate();

        $currentDateTime = now();

        $formattedDate = $currentDateTime->format('Y-m-d');

        $formattedTime = $currentDateTime->setTimezone('America/Argentina/Buenos_Aires')->format('H:i:s');

        $suggestion = Suggestion::create([
            'user_id' => $this->user_id,
            'affair' => $this->affair,
            'description' => $this->description,
            'date' => $formattedDate,
            'time' => $formattedTime,
        ]);

        if ($suggestion) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Queja/sugerencia guardada correctamente'
            ]);

            $this->loadSuggestions($this->user_id);
        }
    }



    public function deleteConfirmed($suggestionId)
    {
        $this->deleteSuggestion($suggestionId);
    }


    public function deleteSuggestion($suggestionId)
    {
        $suggestion = Suggestion::find($suggestionId);

        if ($suggestion) {
            $suggestion->delete();

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Queja/sugerencia eliminada correctamente'
            ]);

            $this->loadSuggestions($this->user_id);
        }
    }


    public function editSuggestion()
    {
        $this->validate([
            'affair' => 'required|string',
            'description' => 'required|string'
        ]);

        $suggestion = Suggestion::where('id', $this->suggestionId)
            ->where('user_id', $this->user_id)
            ->first();

        if ($suggestion) {
            $suggestion->update([
                'affair' => $this->affair,
                'description' => $this->description,
            ]);

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Queja/sugerencia actualizada correctamente'
            ]);

            
            $this->loadSuggestions($this->user_id);

            
            
        }
    }
}
