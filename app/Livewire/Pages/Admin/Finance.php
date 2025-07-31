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
        setlocale(LC_TIME, 'es_ES.UTF-8');
        \Carbon\Carbon::setLocale('es');


        $rawIncomes = $this->getLastSixMonthRaw('income');
        $rawExpenses = $this->getLastSixMonthRaw('expense');


        $monthKeys = collect($rawIncomes)
            ->merge($rawExpenses)
            ->keys()
            ->unique()
            ->sort()
            ->values();


        $months = [];
        $incomes = [];
        $expenses = [];

        foreach ($monthKeys as $key) {
            $months[] = \Carbon\Carbon::parse($key)->translatedFormat('F Y');
            $incomes[] = $rawIncomes[$key] ?? 0;
            $expenses[] = $rawExpenses[$key] ?? 0;
        }

        return view('livewire.pages.admin.finance', [
            'months' => $months,
            'incomes' => $incomes,
            'expenses' => $expenses
        ]);
    }



    public function mount()
    {
        $this->getTodaysIncomesProperty();
        $this->getTodaysExpensesProperty();
        $this->getPaymentMethods();
    }

    public function getTodaysIncomesProperty()
    {
        $this->todayIncomes = Income::whereDate('date', today())->get();
    }

    public function getTodaysExpensesProperty()
    {
        $this->todayExpenses = Expense::whereDate('date', today())->get();
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



 


    public function getLastSixMonthRaw($type = 'income')
    {
        $model = $type === 'income' ? Income::class : Expense::class;
        $lastSixMonths = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::createFromDate(null, null, 1)->subMonths($i);
            $monthKey = $date->format('Y-m');

            $amount = $model::whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');

            $lastSixMonths[$monthKey] = $amount;
        }

        return $lastSixMonths;
    }
}
