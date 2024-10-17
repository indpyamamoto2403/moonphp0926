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

    // MClusterとのリレーション
    public function cluster()
    {
        return $this->belongsTo(MCluster::class, 'cluster_id', 'id');
    }

    //海外への関心をありなしで返す
    public function getForeignInterestAttribute($value)
    {
        return $value ? 'あり' : 'なし';
    }

    //環境への関心をありなしで返す
    public function getEnvironmentalConcernAttribute($value)
    {
        return $value ? 'あり' : 'なし';
    }
}