<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KeywordSearch;
use Illuminate\Support\Facades\Log;
class FavoritedNewsListController extends Controller
{
    public function index(request $request)
    {   
        //favoriteされたニュースを全件取得→idで降順ソート
        $favorited_data = KeywordSearch::with("news")
                                         ->where('is_favorite', 1)
                                         ->orderBy('id', 'desc')
                                         ->get();
                                         
        return Inertia::render('FavoritedNewsList',[
            'data' => $favorited_data
            ]);
    }
}
