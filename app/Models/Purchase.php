<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'user_id', 'total_price', 'delivery_status_id', 'delivery_method_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_products', 'purchase_id', 'product_id')
            ->withPivot('counter');
    }

    public function delivery_status()
    {
        return $this->belongsTo(DeliveryStatus::class, 'delivery_status_id');
    }

    public function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id');
    }
}
