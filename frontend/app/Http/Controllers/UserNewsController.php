<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\MNews;
use App\Models\UserInformation;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
class UserNewsController extends Controller
{
    public function index()
    {
        $user_pref = UserPreference::with('cluster')->where('user_id',Auth::id())->first();
        $news = MNews::where('searched_by_keyword', operator: 0)->where('category_id',$user_pref->cluster_id)->get();
        // Inertiaでビューをレンダリングし、ユーザー情報を渡す
        return Inertia::render('UserNews', [
            'news' => $news,
            'user_pref' => $user_pref,
        ]);
    }
}
