<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','phone','specialty_id','user_id','license'];

    
    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function turns()
    {
        return $this->hasMany(Turn::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

}
