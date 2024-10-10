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

            # OCR処理を行う
            $client = new Client();
            try {
                // 画像をBase64エンコードする
                $encodedImage = base64_encode(file_get_contents($request->file('image')->getPathname()));
                Log::debug("Encoded image: $encodedImage");
            // POSTリクエストを送信

            $multiLineString = <<<EOD
            次の画像をOCR読み取りしてください。返答はJSON形式でお願いします。
            以下の情報を取得してください。
            Name, CompanyName, department, position, title, URL, CompanyLocation,
            
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
                //PHP配列に直す
                $json_data = json_decode($data, true);
                Log::info('Fetched answer from localhost:5000', ['data' => $json_data]);
            } catch (\Exception $e) {
                Log::error('Failed to fetch data from localhost:5000', ['error' => $e->getMessage()]);
                $data = []; // データが取得できなかった場合は空の配列を返す
            }

            return response()->json(['path' => Storage::url($path), 'ocr_data' => $data], 200);
        }
        return response()->json(['message' => '画像がアップロードされませんでした。'], 400);
    }
}
