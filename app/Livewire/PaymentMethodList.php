<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PaymentMethod;
use App\Models\Income;

class PaymentMethodList extends Component
{
    public $paymentMethods;
    public $name;
    public $description;
    public $incomes;

    protected $listeners = [
        'payment-method-added' => 'getPaymentMethods',
        'edit-payment-method' => 'setPaymentMethodData'
    ];

    public function render()
    {
        return view('livewire.payment-method-list');
    }


    public function mount()
    {
        $this->getPaymentMethods();
    }

    public function getPaymentMethods()
    {
        $this->paymentMethods = PaymentMethod::all();
    }

    public function editPaymentMethod($id)
    {
        if ($this->name == null || $this->description == null) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Debe completar todos los campos'
            ]);
            return;
        }

        $paymentMethod = PaymentMethod::find($id);

        $update = $paymentMethod->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        if ($update) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Método de pago editado correctamente'
            ]);

            $this->dispatch('payment-method-added'); 
            $this->getPaymentMethods(); 
        }
    }



    public function setPaymentMethodData($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if ($paymentMethod) {
            $this->name = $paymentMethod->name;
            $this->description = $paymentMethod->description;
        }
    }


    public function deletePaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if ($paymentMethod) {
            $paymentMethod->delete();
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Método de pago eliminado correctamente'
            ]);
            $this->getPaymentMethods();
        }
    }


    
   

   

}
