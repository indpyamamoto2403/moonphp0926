<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'cluster_id',
        'foreign_interest',
        'environmental_concern',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}