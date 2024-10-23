<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\KeywordSearchRequest;
use App\Models\KeywordSearch;
use App\Models\MNews;
use App\Models\ViewedNews;
class ShowNewsController extends Controller
{
    protected $client_api_url;
    public function __construct()
    {
        $this->client_api_url = env('FASTAPI_ENDPOINT');
    }
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
            //ニュースデータに格納
            if($data->output_dataset){
                foreach($data->output_dataset as $news){

                    $m_news = MNews::create([
                        'title' => $news->title,
                        'url' => $news->url,
                        'origin' => $news->origin,
                        'summary' => $news->summary,
                        'searched_by_keyword' => 1,
                        'category_id' => 0,
                    ]);

                    //ビューテーブルにも格納
                    $viewed_news = ViewedNews::create([
                        'user_id' => Auth::id(),
                        'news_id' => $m_news->id,
                    ]);

                    $t_keyword_search = KeywordSearch::create([
                        'user_id' => Auth::id(),
                        'news_id' => $m_news->id,
                        'keyword1' => $request->input('keyword1'),
                        'keyword2' => $request->input('keyword2'),
                        'keyword3' => $request->input('keyword3'),
                        'combined_keyword' => $request->input('keyword1') . ' ' . $request->input('keyword2') . ' ' . $request->input('keyword3'),
                        'is_favorite' => 0,
                    ]);
                }
            }

            // ユーザーにニュースデータを返す
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
