<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class ShowNewsController extends Controller
{
    public function index(Request $request)
    {
        Log::debug("request: " . $request);
        $mock['keyword1'] = $request->input('keyword1');
        $mock['keyword2'] = $request->input('keyword2');
        $mock['keyword3'] = $request->input('keyword3');
        return Inertia::render('ShowNews', [
            'news_data' => $mock
        ]);
    }
}
