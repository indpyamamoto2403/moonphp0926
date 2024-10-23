<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KeywordSearch;
use App\Models\MNews;
use App\Models\FavoriteNews;
use Illuminate\Support\Facades\Log;
class FavoritedNewsListController extends Controller
{
    public function index(request $request)
    {   
        //favoriteされたニュースを全件取得→idで降順ソート
        $favorited_data = FavoriteNews::with("news")
                                         ->orderBy('id', 'desc')
                                         ->get();
        return Inertia::render('FavoritedNewsList',[
            'data' => $favorited_data
            ]);
    }
}
