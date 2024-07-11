<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'image_path', 'counter', 'category_id', 'seller_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_products');
    }
}
