<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable ;
    protected $guarded = [];

    public $translatedAttributes = ['name','description'];

    protected $appends = ['image_path','profit_percent'];

    public function getProfitPercentAttribute(){
        $profit= $this->selling_price - $this->Purchasing_price ;
        $profit_percent = $profit*100/$this->Purchasing_price  ;
        return $profit_percent ;
    }
    public function getImagePathAttribute()
    {
        return asset('uploads/products/' . $this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
