<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

	protected $table = 'prescriptions';

    protected $fillable = ['advices','drug_type_id','user_id','sick_type_id','capacity','dose'];
    public function User(){
    	        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function Drug(){
    	        return $this->belongsToMany('App\Drug','prescription_drugs');
    }

    public function Test(){
    	        return $this->belongsToMany('App\Test','prescription_tests');
    }
}
