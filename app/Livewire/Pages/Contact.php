<?php
namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ContactMail;

class Contact extends Component
{
    public $name;
    public $email;
    public $message;
    
    public function render()
    {
        return view('livewire.pages.contact');
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function sendMail()
    {
        $this->validate();

        try {
            Mail::to('mailto@clinicahealth.com')->send(new ContactMail($this->name, $this->email, $this->message));
            session()->flash('success', 'Mensaje enviado correctamente.');
            $this->reset(['name', 'email', 'message']);
        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un problema al enviar el mensaje. Por favor, inténtelo de nuevo.');
        }
    }
}
