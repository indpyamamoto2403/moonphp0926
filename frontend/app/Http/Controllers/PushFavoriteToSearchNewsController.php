<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeywordSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class PushFavoriteToSearchNewsController extends Controller
{
    public function index(Request $request) {
        $url = $request->input('url');
        $user_id = Auth::id(); // 認証されたユーザーのIDを取得
    
        $keyword_search = KeywordSearch::with("news")
        ->whereHas('news', function($query) use ($url) {
                    $query->where('url', $url); // newsのURLでフィルタリング
                })
        ->where('user_id', $user_id)
        ->first();

    
        if ($keyword_search) {
            $keyword_search->is_favorite = 1;
            $keyword_search->save(); // 変更を保存
            return response()->json($keyword_search);
        } else {
            return response()->json(['error' => 'Keyword search not found'], 404);
        }
    }
}
