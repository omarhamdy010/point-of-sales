<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Category extends Model  implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable=['image'];

    protected $appends =['image_path'];

    public function product(){
    return $this->hasMany(Product::class);
    }

    public function getImagePathAttribute(){
        return asset('uploads/categories/'.$this->image);
    }
}
