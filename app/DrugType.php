<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugType extends Model
{
    use HasFactory;
    protected $table = 'drug_type';
    protected $fillable = ['name'];
}
