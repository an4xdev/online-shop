<?php

namespace App\Models;

use App\Models\User;
use App\Models\Purchase;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image_path', 'counter', 'sub_category_id', 'seller_id'];

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_products', 'product_id', 'purchase_id')
            ->withPivot('counter');
    }
}
