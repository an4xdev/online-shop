<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedOpinion extends Model
{
    use HasFactory;
    protected $fillable = ['opinion_id'];

    public function opinion()
    {
        return $this->belongsTo(Opinion::class, 'opinion_id');
    }
}
