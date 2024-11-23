<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'era_id',
        'store_id',
        'visible'
    ];

    PUBLIC function store(){
        return $this->belongsTo(Store::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function era(){
        return $this->belongsTo(Era::class);
    }
    public function images(){
        return $this->hasMany(Product_image::class);
    }

    public function order_item(){
        return $this->hasMany(Order_item::class);
    }
     public function reviews(){
        return $this->hasMany(Review::class);
     }
public function discounts()
{
    return $this->hasMany(Discount::class);
}
}
