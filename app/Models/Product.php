<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/products/' . $this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
