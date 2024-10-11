<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        // バリデーション
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // バリデーション
        ]);

        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/uploaded', $originalName, 'public');
            
            Log::debug($request->all());

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
                Name, Birthday, CompanyName, Department, Position, ZipCode, CompanyLocation, URL
                EOD;

                $response = $client->request('POST', 'http://192.168.0.23:5000/question_answer_by_image', [
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

    public function extract(Request $request)
    {
        // テキスト情報の取得
        $companyName = $request->input('company_name');
        $name = $request->input('name');
        $department = $request->input('department');
        $position = $request->input('position');
        $zipCode = $request->input('zip_code');
        $companyLocation = $request->input('company_location');
        $url = $request->input('URL');
        
        Log::debug($request->all());
        Log::info($companyName);
        Log::info($name);
        Log::info($department);
        Log::info($position);
        Log::info($zipCode);
        Log::info($companyLocation);
        Log::info($url);

        // テキスト情報の処理（外部サービスに送信するなど）
        $client = new Client();
        $prompt = <<<EOD

        出力例に従って、事業内容を要約してください(200字程度)。

        #出力例1:
        グリーンエナジー株式会社は、再生可能エネルギーの開発と普及を目指す企業です。主な事業内容には、
        太陽光発電システムの設計・施工や風力発電所の運営が含まれています。最新の技術を活用し、効率的なエネルギー利用を実現することで、
        持続可能な社会の構築に貢献しています。

        #出力例2:
        テクノロジーソリューション株式会社は、企業向けのITサービスを提供する企業です。
        事業内容には、クラウドサービスの導入支援、業務効率化を図るためのシステム開発、
        サイバーセキュリティ対策のコンサルティングが含まれます。最新の技術動向を取り入れ、
        顧客のニーズに応じたカスタマイズを行い、ビジネスの成長をサポートしています。

        #出力:
        EOD;

        // URLが空の場合はテキストから抽出
        if (empty($url)) {
            // 検索キーワードの生成
            $keyword = $companyName . " " . $zipCode . " 事業内容";
            $response = $client->request('GET', 'http://192.168.0.23:5000/keyword_query', [
                'query' => [
                    'keyword' => $keyword,
                    'prompt' => $prompt,
                ],
            ]);
        } else {
            // URLが指定されている場合はURLから抽出
            $response = $client->request('POST', 'http://192.168.0.23:5000/url_query', [
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
        Log::debug($response->getBody());
        // レスポンスを返す
        return response()->json([
            'message' => 'Extraction successful',
            'data' => json_decode($response->getBody(), true),
        ]);
    }
}
