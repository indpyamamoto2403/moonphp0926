<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCluster extends Model
{
    use HasFactory;

    protected $table = 'm_cluster';

    protected $fillable = [
        'cluster_id',
        'foreign_interest',
        'environmental_concern',
    ];

    public $timestamps = true;

    // UserPreferenceとのリレーション
    public function userPreference()
    {
        return $this->hasOne(UserPreference::class, 'cluster_id', 'id');
    }
}