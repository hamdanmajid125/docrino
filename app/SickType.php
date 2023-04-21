<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SickType extends Model
{
    use HasFactory;
    protected $table = 'sick_type';
    protected $fillable = ['name'];

}
