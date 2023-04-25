<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestFurniture extends Model
{
    use HasFactory;
    protected $table = 'request_furniture';
    protected $fillable = ['user_id', 'approved', 'stock_id', 'qty'];

    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
