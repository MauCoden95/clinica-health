<?php

namespace App\Livewire\Pages\Paciente;

use App\Repositories\SuggestionRepository;
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

    protected SuggestionRepository $suggestionRepository;

    public function __construct()
    {
        $this->suggestionRepository = new SuggestionRepository();
    }

    public function mount()
    {
        $this->user_id = session('user_id');
        $this->loadSuggestions();
    }

    public function render()
    {
        $this->loadSuggestions();
        return view('livewire.pages.paciente.suggestions');
    }

    private function loadSuggestions()
    {
        $this->suggestions = $this->suggestionRepository->getByUserId($this->user_id);
        $this->count_suggestions = $this->suggestions->count();
    }

    public function create()
    {
        $this->validate();
        
        $currentDateTime = now();
        $formattedDate = $currentDateTime->format('Y-m-d');
        $formattedTime = $currentDateTime->setTimezone('America/Argentina/Buenos_Aires')->format('H:i:s');
        
        $this->suggestionRepository->create([
            'user_id' => $this->user_id,
            'affair' => $this->affair,
            'description' => $this->description,
            'date' => $formattedDate,
            'time' => $formattedTime,
        ]);
        
        $this->dispatch('showAlert', [
            'type' => 'success',
            'title' => '¡Éxito!',
            'text' => 'Queja/sugerencia guardada correctamente'
        ]);

        $this->loadSuggestions();
    }

    public function deleteConfirmed($suggestionId)
    {
        $suggestion = $this->suggestionRepository->find($suggestionId);
        if ($suggestion) {
            $this->suggestionRepository->delete($suggestion);
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Queja/sugerencia eliminada correctamente'
            ]);
            $this->loadSuggestions();
        }
    }

    public function editSuggestion()
    {
        $this->validate([
            'affair' => 'required|string',
            'description' => 'required|string'
        ]);

        $suggestion = $this->suggestionRepository->find($this->suggestionId);
        if ($suggestion && $suggestion->user_id === $this->user_id) {
            $this->suggestionRepository->update($suggestion, [
                'affair' => $this->affair,
                'description' => $this->description,
            ]);
            
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Queja/sugerencia actualizada correctamente'
            ]);
            $this->loadSuggestions();
        }
    }
}

