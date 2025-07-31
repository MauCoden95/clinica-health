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
    public $todayExpenses;

    public $paymentMethods;

    public $name;
    public $description_pm;



    public function render()
    {
        $lastSixMonths = $this->getLastSixMonthIncomes();
        return view('livewire.pages.admin.finance', compact('lastSixMonths'));
    }


    public function mount()
    {
        $this->getTodaysIncomesProperty();
        $this->getTodaysExpensesProperty();
        $this->getPaymentMethods();
        $this->getLastSixMonthIncomes();
    }

    public function getTodaysIncomesProperty()
    {
        $this->todayIncomes = Income::whereDate('created_at', today())->get();
    }

    public function getTodaysExpensesProperty()
    {
        $this->todayExpenses = Expense::whereDate('created_at', today())->get();
    }

    public function getPaymentMethods()
    {
        $this->paymentMethods = PaymentMethod::all();
    }

    public function addPaymentMethod()
    {
        if ($this->name == null || $this->description_pm == null) {
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

        if ($paymenthMethod) {

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Método de pago agregado correctamente'
            ]);

            $this->dispatch('payment-method-added');
        }
    }



    public function getLastSixMonthIncomes()
    {
        $lastSixMonths = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::createFromDate(null, null, 1)->subMonths($i); // siempre día 1
            $monthKey = $date->format('Y-m');

            $amount = Income::whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');

            $lastSixMonths[$monthKey] = $amount;
        }

        $formattedResult = [];
        foreach ($lastSixMonths as $key => $amount) {
            $formattedMonth = \Carbon\Carbon::parse($key)->translatedFormat('F Y');
            $formattedResult[$formattedMonth] = $amount;
        }

        return $formattedResult;
    }
}
