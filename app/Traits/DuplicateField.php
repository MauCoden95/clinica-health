<?php

namespace App\Traits;

trait DuplicateField
{
    private function getDuplicateField($errorMessage)
    {
        if (strpos($errorMessage, 'suppliers.email') !== false) {
            return 'email';
        } elseif (strpos($errorMessage, 'suppliers.phone') !== false) {
            return 'teléfono';
        } elseif (strpos($errorMessage, 'suppliers.cuil') !== false) {
            return 'CUIL';
        }
        return 'dato ingresado';
    }
}
