<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use App\Models\MCluster;
class ChangeUserIndustryController extends Controller
{
    public function index()
    {
        $user = UserPreference::with('cluster')->where('user_id',Auth::id())->first();

        // ユーザーの業界情報を変更する画面を表示する
        return Inertia::render('ChangeUserIndustry',[
            'user' => $user,
            'clusters' => MCluster::all(),
        ]);
    }

    public function edit($cluster_id)
    {
        // リクエストのバリデーション
        $user = User::find(Auth::id());
        $userPreference = UserPreference::where('user_id', Auth::id())->first();
        
        if (!$userPreference) {
            $userPreference = new UserPreference();
            $userPreference->user_id = Auth::id();
        }
        
        $userPreference->cluster_id = $cluster_id;
        $userPreference->save();

        return redirect()->route('customer-view');
    }
}
