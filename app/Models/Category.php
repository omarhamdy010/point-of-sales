<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','image'];

    protected $appends =['image_path'];

    public function product(){
    return $this->hasMany(Product::class);
    }

    public function getImagePathAttribute(){
        return asset('uploads/categories/'.$this->image);
    }
}
