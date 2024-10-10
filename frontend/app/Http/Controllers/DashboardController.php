<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Inertia\Inertia;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // GuzzleHttp クライアントのインスタンスを作成
        $client = new Client();

        try {
            // http://localhost:5000 へのGETリクエストを送信
            $response = $client->request('GET', 'http://192.168.0.23:5000', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            // レスポンスのボディを取得し、JSONをデコード
            $data = json_decode($response->getBody(), true);

            // ログに取得したデータを出力
            Log::info('Fetched data from localhost:5000', $data);
        } catch (\Exception $e) {
            // エラーログ出力
            Log::error('Failed to fetch data from localhost:5000', ['error' => $e->getMessage()]);
            $data = []; // データが取得できなかった場合は空の配列を返す
        }

        // Inertiaビューにデータを渡してレンダリング
        return Inertia::render('Dashboard', ['data' => $data]);
    }
}
