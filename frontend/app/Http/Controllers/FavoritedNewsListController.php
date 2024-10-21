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
        //favoriteされたニュースを全件取得
        $favorited_data = KeywordSearch::where('is_favorite', 1)->get();
        return Inertia::render('FavoritedNewsList',[
            'data' => $favorited_data
            ]);
    }
}
