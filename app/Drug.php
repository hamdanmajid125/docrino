<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = 'drugs';
    protected $fillable = ['trade_name', 'generic_name', 'category_id', 'note','price'];

    public function Prescription()
    {
        return $this->hasMany('App\Prescription_drug');
    }
    public function category()
    {
        return $this->belongsTo(DrugType::class, 'category_id');
    }
}
