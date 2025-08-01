<?php

namespace App\Traits;

use App\Models\Expense;

trait AddExpenseTrait
{
    public function addExpense($amount)
    {
        $description = "Compra a proveedor";
        $dt = new \DateTimeZone('America/Argentina/Buenos_Aires');
        $date = new \DateTime('now', $dt);
        $time = $date->format('H:i:s');
        $date = $date->format('Y-m-d');

        $expense = Expense::create([
            'description' => $description,
            'amount' => $amount,
            'date' => $date,
            'time' => $time,
        ]);
    }
}
