<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\KeywordSearchRequest;
use App\Models\KeywordSearch;
class ShowNewsController extends Controller
{
    protected $client_api_url = 'http://192.168.0.23:5000';

    public function index(KeywordSearchRequest $request)
    {
        $client = new Client();
        try {
            $response = $client->request('POST', $this->client_api_url . '/fetch_news', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'query' => [
                    'keyword1' => $request->input('keyword1'),
                    'keyword2' => $request->input('keyword2'),
                    'keyword3' => $request->input('keyword3'),
                    'search_num'=> $request->input('search_num'),
                ],
            ]);      
    
            $data = json_decode($response->getBody()->getContents());

            // APIレスポンスデータをループして、KeywordSearchに挿入
            if (!empty($data->output_dataset)) {
                foreach ($data->output_dataset as $newsItem) {
                    KeywordSearch::create([
                        'keyword1' => $request->input('keyword1'),
                        'keyword2' => $request->input('keyword2'),
                        'keyword3' => $request->input('keyword3'),
                        'combined_keyword' => $request->input('keyword1') . ' ' . $request->input('keyword2') . ' ' . $request->input('keyword3'),
                        'user_id' => Auth::user()->id ?? 1, // 現在のユーザーIDを取得して挿入
                        'instant_news_url' => $newsItem->url ?? null, // APIからのニュースURL
                        'instant_news_title' => $newsItem->title ?? null, // APIからのニュースタイトル
                        'instant_news_origin' => $newsItem->origin ?? null, // APIからのニュースオリジン
                        'instant_news_summary' => $newsItem->summary ?? null, // APIからのニュース要約
                        'is_favorite' => false, // 初期値はfalseに設定
                    ]);
                }
            }

            return Inertia::render('ShowNews', [
                'news_data' => $data
            ]);
            
        } catch (\Exception $e) {
            // エラーログを記録
            Log::error('API call failed: ' . $e->getMessage());
    
            // ユーザーにエラーメッセージを返す
            return Inertia::render('KeywordSearch', [
                'news_data' => null,
                'error' => 'ニュースの取得中にエラーが発生しました。しばらくしてから再試行してください。',
            ]);
        }
    }
    
}
