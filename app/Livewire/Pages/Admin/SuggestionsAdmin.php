<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Suggestion;
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
        $this->suggestions = Suggestion::with(['user:id,name'])->orderBy('date', 'desc')->orderBy('time', 'desc')->get();
        $this->count_suggestions = $this->suggestions->count();
    }


    public function deleteSuggestion($id)
    {
        $suggestion = \App\Models\Suggestion::find($id);

        if ($suggestion) {
            $delete = $suggestion->delete();

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

        $suggestion = Suggestion::where('id', $this->suggestionId)
            ->first();

        if ($suggestion) {
            $suggestion->update([
                'response' => $this->response,
            ]);

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
        

        $suggestion = Suggestion::find($suggestionId);

        

        if ($suggestion) {
            $suggestion->update([
                'useful' => !$suggestion->useful
            ]);

            
            
            $this->loadSuggestions();
        }
    }


    public function showUsefulsSuggestions()
    {
        if ($this->showUsefuls) {
            $this->suggestions = Suggestion::where('useful', 1)->get();
        } else {
            $this->suggestions = Suggestion::all();
        }
    }
    
}
