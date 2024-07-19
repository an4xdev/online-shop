<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bySellers()
    {
        return $this->hasMany(PurchaseBySeller::class, 'purchase_id');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, PurchaseProduct::class, 'purchase_by_seller_id', 'id', 'id', 'product_id');
    }
}
