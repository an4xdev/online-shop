<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'stars', 'description'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->stars < 1 || $model->stars > 5) {
                throw new \InvalidArgumentException('Ocena musi być pomiędzy 1 a 5 włącznie.');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function reported()
    {
        return $this->hasMany(ReportedOpinion::class, 'opinion_id');
    }
}
