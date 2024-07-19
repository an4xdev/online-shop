<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function purchases()
    {
        return $this->hasMany(PurchaseBySeller::class, 'delivery_status_id');
    }
}
