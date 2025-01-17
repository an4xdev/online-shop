<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_by_seller_id', 'product_id', 'counter'];

    public function purchase()
    {
        return $this->belongsTo(PurchaseBySeller::class, 'purchase_by_seller_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
