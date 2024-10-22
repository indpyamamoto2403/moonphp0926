<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MCluster;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class CustomerViewController extends Controller
{
    public function index()
    {
        // ログイン中のユーザー情報を取得
        $user = User::with(['information','preference', 'cluster'])->find(Auth::user()->id);
        $cluster = MCluster::all();
        // Inertiaでビューをレンダリングし、ユーザー情報を渡す
        return Inertia::render('CustomerView', [
            'customer_data' => $user,
            'cluster' => $cluster
        ]);
    }
}
