<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ShowNewsController extends Controller
{
    protected $client_api_url = 'http://192.168.228.99:5000';

    public function index(Request $request)
    {
        // OCR処理を行う
        $client = new Client();
        $response = $client->request('POST', $this->client_api_url . '/fetch_news', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json', // JSON形式で送信する場合
            ],
            'query' => [
                'keyword1' => $request->input('keyword1'),
                'keyword2' => $request->input('keyword2'),
                'keyword3' => $request->input('keyword3'),
                'search_num'=> 1,
            ],
        ]);      

        $data = json_decode($response->getBody()->getContents());

        return Inertia::render('ShowNews', [
            'news_data' => $data
        ]);
    }
}
