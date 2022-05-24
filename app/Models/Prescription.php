<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $table = 'prescriptions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function patients(){
        return $this->belongsToMany('App\Models\Patient', 'patient_prescription');
    }

}
