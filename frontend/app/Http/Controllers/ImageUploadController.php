<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CustomerRequest;

class ImageUploadController extends Controller
{

    protected $client_api_url = 'http://192.168.228.99:5000';

    public function upload(Request $request)
    {
        // バリデーション
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // バリデーション
        ]);

        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/uploaded', $originalName, 'public');
            
            Log::debug("Requested items: " . implode(', ', $request->all())); // ここを修正

            // OCR処理を行う
            $client = new Client();
            try {
                // 画像をBase64エンコードする
                $encodedImage = base64_encode(file_get_contents($request->file('image')->getPathname()));
                Log::debug("Encoded image: $encodedImage");

                // POSTリクエストを送信
                $multiLineString = <<<EOD
                次の画像をOCR読み取りしてください。返答はJSON形式でお願いします。
                以下の情報を取得してください。
                name, company_name, company_zipcode, company_address, yakushoku, department, company_url
                EOD;

                $response = $client->request('POST', $this->client_api_url . '/question_answer_by_image', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json', // JSON形式で送信する場合
                    ],
                    'query' => [
                        'prompt' => $multiLineString,
                        'encoded_image' => $encodedImage,
                    ],
                ]);
                $data = $response->getBody()->getContents();
                // PHP配列に変換
                Log::info('Fetched answer from localhost:5000', ['data' => $data]);
            } catch (\Exception $e) {
                Log::error('Failed to fetch data from localhost:5000', ['error' => $e->getMessage()]);
                $data = []; // データが取得できなかった場合は空の配列を返す
            }

            return response()->json(['path' => Storage::url($path), 'ocr_data' => $data], 200);
        }
        return response()->json(['message' => '画像がアップロードされませんでした。'], 400);
    }

    public function extract(CustomerRequest $request)
    {
        // テキスト情報の取得
        $companyName = $request->input('company_name');
        $name = $request->input('name');
        $department = $request->input('department');
        $position = $request->input('position');
        $zipCode = $request->input('zip_code');
        $companyLocation = $request->input('company_location');
        $url = $request->input('URL');

        $client = new Client();
        $prompt = <<<EOD
        以下の情報について、その企業もしくは団体の
        事業内容を要約してください(200字程度)。
        EOD;

        // URLが空の場合はテキストから抽出
        if (empty($url)) {
            // 検索キーワードの生成
            $keyword = $companyName . " " . $zipCode . " 事業内容";
            $response = $client->request('GET', $this->client_api_url . '/keyword_query', [
                'query' => [
                    'keyword' => $keyword,
                    'prompt' => $prompt,
                ],
            ]);
        } else {
            // URLが指定されている場合はURLから抽出
            $response = $client->request('POST', $this->client_api_url . '/url_query', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json', // JSON形式で送信する場合
                ],
                'query' => [
                    'url' => $url,
                    'prompt' => $prompt,
                ],
            ]);
        };

        return response()->json([
            'message' => 'Extraction successful',
            'data' => json_decode($response->getBody(), true),
        ]);
    }
}
