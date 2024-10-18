<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    public function turnsExaminations()
    {
        return $this->hasMany(TurnExamination::class);
    }
}
