<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client(){
       return $this->belongsTo(Client::class);
    }//end of relation one to many

    public function products(){
        return $this->belongsToMany(Product::class , 'product_orders')->withPivot('quantity');
    }//end of relation many to many
}//end of model
