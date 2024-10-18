<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function turns()
    {
        return $this->hasMany(Turn::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
