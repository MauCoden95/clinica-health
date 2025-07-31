<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Models\Income;
use App\Models\Expense;
use App\Models\PaymentMethod;

class Finance extends Component
{
    use LogoutTrait;

    public $description;
    public $amount;
    public $date;
    public $time;

    public $todayIncomes;

    public $paymentMethods;

    public $name;
    public $description_pm;

    public function render()
    {
        return view('livewire.pages.admin.finance');
    }


    public function mount(){
        $this->getTodaysIncomesProperty();
        $this->getPaymentMethods();
    }

    public function getTodaysIncomesProperty()
    {
        $this->todayIncomes = Income::whereDate('created_at', today())->get();
    }

    public function getPaymentMethods()
    {
        $this->paymentMethods = PaymentMethod::all();
    }

    public function addPaymentMethod()
    {
        if($this->name == null || $this->description_pm == null){
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Debe completar todos los campos'
            ]);
            return;
        }

        $paymenthMethod = PaymentMethod::create([
            'name' => $this->name,
            'description' => $this->description_pm,
        ]);

        if($paymenthMethod){

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Método de pago agregado correctamente'
            ]);

            $this->dispatch('payment-method-added');
        }
    }
}
