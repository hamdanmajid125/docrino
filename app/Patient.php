<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	protected $table = 'patients';
	public function user(){
        return $this->belongsTo(User::class);
    }   
}
