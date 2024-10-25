<?php


namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Specialty;
use App\Traits\LogoutTrait;

class EditSpecialty extends Component
{
    use LogoutTrait;

    public $specialtyId;
    public $specialty;
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.pages.admin.edit-specialty');
    }

    public function mount($id)
    {
        $this->specialtyId = $id;
        $this->specialty = Specialty::findOrFail($id);
        $this->specialty = $this->specialty->specialty;
    }

    public function editSpecialty()
    {
      
        try {
            $validatedData = $this->validate([
                'specialty' => 'required|string|max:255',
            ]);

            $specialty = Specialty::find($this->specialtyId);

            if ($specialty) {
                $update = $specialty->update($validatedData);

                if ($update) {
                    $this->dispatch('editSpecialty', [
                        'type' => 'success',
                        'title' => '¡Éxito!',
                        'text' => 'Especialidad actualizada correctamente'
                    ]);
                }

               
            } else {
                $this->dispatch('editSpecialty', [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Especialidad no encontrado'
                ]);
            }
        }catch (\Exception $e) {
            $this->dispatch('editSpecialty', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Ocurrió un error al actualizar la especialidad'
            ]);
        }
        
    }
}
