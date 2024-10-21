<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeywordSearch extends Model
{
    use HasFactory;

    // テーブル名の指定
    protected $table = 't_keyword_search';

    // フィールドを一括割り当て可能にするためのfillableプロパティ
    protected $fillable = [
        'keyword1',
        'keyword2',
        'keyword3',
        'user_id', // ここにuser_idを追加
        'combined_keyword',
        'instant_news_url',
        'instant_news_title',
        'instant_news_origin',
        'instant_news_summary',
        'is_favorite',
    ];
}