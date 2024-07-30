<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'purchase_by_seller_id', 'sender_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function purchase_by_seller()
    {
        return $this->belongsTo(PurchaseBySeller::class, 'purchase_by_seller_id');
    }
}
