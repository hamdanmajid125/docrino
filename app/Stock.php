<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(StockCategory::class,'stock_category_id');
    }
}
