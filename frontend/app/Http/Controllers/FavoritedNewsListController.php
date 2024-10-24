<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KeywordSearch;
use App\Models\MNews;
use App\Models\FavoriteNews;
use App\Models\ViewedNews;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Log;
class FavoritedNewsListController extends Controller
{
    public function index(request $request)
    {
        $cluster_id = UserPreference::where('user_id', $request->user()->id)->value('cluster_id');
        //favoriteされたニュースを全件取得→idで降順ソート
        $favorited_news = FavoriteNews::with("news")
                                         ->where('user_id', $request->user()->id)
                                         ->orderBy('id', 'desc')
                                         ->get();

        //自分以外のユーザーが閲覧したニュースを取得
        $recommended_news = ViewedNews::with("news")
                            ->where('user_id', '!=', $request->user()->id)
                            ->where('cluster_id', $cluster_id)
                            ->orderBy('id', 'desc')
                            ->get();
                                                           
        return Inertia::render('FavoritedNewsList',[
            'favorited_news' => $favorited_news,
            'recommended_news' => $recommended_news,
            ]);
    }
}
