<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeywordSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\ViewedNews;
use App\Models\FavoriteNews;
use App\Models\UnfavoriteNews;
use App\Models\MNews;

class PushFavoriteToSearchNewsController extends Controller
{
    protected $news_id;
    protected $user_id;

    public function __construct(Request $request)
    {
        //インプットされたキーからニュースIDを取得
        $this->news_id = MNews::where('url',$request->input('url'))->first()->id;
        $this->user_id = Auth::id(); // 認証されたユーザーのIDを取得

    }

    public function index(Request $request) {
        $this->_sweep($request);
        $favorite_news = FavoriteNews::create([
            'user_id' => $this->user_id,
            'news_id' => $this->news_id,
        ]);
        return response()->json();
    }
    public function reverse(Request $request) {
        $this->_sweep($request);
        $unfavorite_news = UnfavoriteNews::create([
            'user_id' => $this->user_id,
            'news_id' => $this->news_id,
        ]);
        return response()->json();
    }
    public function neutral(Request $request) {
        $this->_sweep($request);
        return response()->json();
    }

    protected function _sweep(Request $request): void{

        //favoritenews, unfavoritenewsのテーブルをスキャンして、あれば削除する
        // お気に入りニュースの削除
        FavoriteNews::where('user_id', $this->user_id)
            ->where('news_id', $this->news_id)
            ->delete();

        // 非お気に入りニュースの削除
        UnfavoriteNews::where('user_id', $this->user_id)
            ->where('news_id', $this->news_id)
            ->delete();
    }
}
