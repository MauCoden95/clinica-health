<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Repositories\SuggestionAdminRepository;
use App\Traits\LogoutTrait;

class SuggestionsAdmin extends Component
{
    use LogoutTrait;

    public $suggestions;
    public $suggestionId;
    public $count_suggestions;
    public $response;
    public $showUsefuls = false;

    protected $listeners = ['deleteConfirmed'];

    protected $suggestionRepository;

    public function __construct()
    {
        $this->suggestionRepository = new SuggestionAdminRepository();
    }

    public function mount()
    {
        $this->loadSuggestions();
    }

    public function render()
    {
        return view('livewire.pages.admin.suggestions-admin');
    }

    public function loadSuggestions()
    {
        $this->suggestions = $this->suggestionRepository->getAll();
        $this->count_suggestions = $this->suggestionRepository->getCount();
    }

    public function deleteSuggestion($id)
    {
        if ($this->suggestionRepository->delete($id)) {
            $this->loadSuggestions();
        }
    }

    public function deleteConfirmed($suggestionId)
    {
        $this->deleteSuggestion($suggestionId);
    }

    public function replySuggestion()
    {
        $this->validate([
            'response' => 'required|string',
        ]);

        if ($this->suggestionRepository->updateResponse($this->suggestionId, $this->response)) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Respuesta realizada correctamente'
            ]);

            $this->loadSuggestions();
        }
    }

    public function toggleUseful($suggestionId)
    {
        if ($this->suggestionRepository->toggleUseful($suggestionId)) {
            $this->loadSuggestions();
        }
    }

    public function showUsefulsSuggestions()
    {
        $this->suggestions = $this->showUsefuls
            ? $this->suggestionRepository->getUsefulSuggestions()
            : $this->suggestionRepository->getAll();
    }
}
