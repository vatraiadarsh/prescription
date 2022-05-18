<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';

    public function prescription(){
        return $this->belongsToMany('App\Models\Prescription', 'patient_prescription');
    }
}
