<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = ['user_id','weight','height','speciality','qualification','blood_group','depart_id','designiation','available_on','available_from','available_to','per_patient_time'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
