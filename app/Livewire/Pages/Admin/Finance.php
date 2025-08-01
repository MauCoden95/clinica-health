<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Models\Income;
use App\Models\Expense;
use App\Models\PaymentMethod;
use App\Models\Doctor;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public $doctor_earnings;
    public $specialty_earnings;





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


        $this->doctor_earnings = $this->calculateDoctorEarnings();
        $this->specialty_earnings = $this->calculateEarningsBySpecialty();

        //dd($this->specialty_earnings);

        return view('livewire.pages.admin.finance', [
            'months' => $months,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'doctor_earnings' => $this->doctor_earnings
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








    public function addIncome()
    {
        $dt = new \DateTimeZone('America/Argentina/Buenos_Aires');
        $date = new \DateTime('now', $dt);
        $time = $date->format('H:i:s');
        $date = $date->format('Y-m-d');


        if ($this->description == null || $this->amount == null) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Debe completar todos los campos'
            ]);
            return;
        }

        $income = Income::create([
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $date,
            'time' => $time,
        ]);

        if ($income) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Ingreso agregado correctamente'
            ]);

            $this->getTodaysIncomesProperty();
        }
    }







    public function addExpense()
    {
        $dt = new \DateTimeZone('America/Argentina/Buenos_Aires');
        $date = new \DateTime('now', $dt);
        $time = $date->format('H:i:s');
        $date = $date->format('Y-m-d');


        if ($this->description == null || $this->amount == null) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Debe completar todos los campos'
            ]);
            return;
        }

        $expense = Expense::create([
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $date,
            'time' => $time,
        ]);

        if ($expense) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Gasto agregado correctamente'
            ]);

            $this->getTodaysExpensesProperty();
        }
    }





    public function calculateDoctorEarnings()
    {
        $doctors = Doctor::with('specialty')
            ->withSum(['turns as total_invoiced' => function ($query) {
                $query->where('paid', true)
                    ->whereMonth('time', Carbon::now()->month)
                    ->whereYear('time', Carbon::now()->year);
            }], 'price')
            ->having('total_invoiced', '>', 0)
            ->get();

        return $doctors;
    }



    public function calculateEarningsBySpecialty()
    {
        $specialties = Specialty::select('specialties.specialty', DB::raw('SUM(turns.price) as total_invoiced'))
                ->join('doctors', 'doctors.specialty_id', '=', 'specialties.id')
                ->join('turns', 'turns.doctor_id', '=', 'doctors.id')
                ->where('turns.paid', true)
                ->whereMonth('turns.time', Carbon::now()->month)
                ->whereYear('turns.time', Carbon::now()->year)
                ->groupBy('specialties.id', 'specialties.specialty')
                ->having('total_invoiced', '>', 0)
                ->get();
        

        return $specialties;
    }
}
