<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseBySeller extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'delivery_status_id', 'delivery_method_id', 'delivered', 'seller_id'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function products()
    {
        return $this->hasMany(PurchaseProduct::class, 'purchase_by_seller_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function delivery_status()
    {
        return $this->belongsTo(DeliveryStatus::class, 'delivery_status_id');
    }

    public function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'purchase_by_seller_id');
    }
}
