<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MNews extends Model
{
    use HasFactory;
    protected $table = 'm_news';

    protected $guarded = [];
    
    public function keywordSearch()
    {
        return $this->belongsTo(KeywordSearch::class, 'news_id', 'id');
    }
}
