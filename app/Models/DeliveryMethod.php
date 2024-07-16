<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'delivery_method_id');
    }
}
