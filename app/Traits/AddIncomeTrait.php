<?php

namespace App\Traits;

use App\Models\Income;

trait AddIncomeTrait
{
    public function addIncome($amount)
    {
        $description = "Compra a proveedor";
        $dt = new \DateTimeZone('America/Argentina/Buenos_Aires');
        $date = new \DateTime('now', $dt);
        $time = $date->format('H:i:s');
        $date = $date->format('Y-m-d');

        $expense = Income::create([
            'description' => $description,
            'amount' => $amount,
            'date' => $date,
            'time' => $time,
        ]);
    }
}
