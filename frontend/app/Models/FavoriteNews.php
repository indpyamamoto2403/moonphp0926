<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteNews extends Model
{
    use HasFactory;
    protected $table = 'favorite_news';

    //id, user_id, news_id, created_at, updated_at
    protected $guarded = [];

    public function news()
    {
        return $this->belongsTo(MNews::class, 'news_id', 'id');
    }

    public function user()
    {
        return $this->HasOne(User::class, 'user_id', 'id');
    }
}