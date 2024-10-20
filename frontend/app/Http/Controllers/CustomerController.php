<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPreference;
class CustomerController extends Controller
{
    protected $client_api_url = 'http:/192.168.228.99:5000';

    public function index(Request $request)
    {
        $user_data = User::with(['preference', 'cluster'])->find(Auth::user()->id);
        return Inertia::render('Customer', [
            'user_data' => $user_data
        ]);
    }

    public function completed(CustomerRequest $request)
    {
        Log::debug('Completed request', $request->all());
        // ユーザーを取得
        $user = User::find($request->user()->id);
    
        // 属性を更新
        $user->company_name = $request->company_name;
        $user->name = $request->name;
        $user->department = $request->department;
        $user->company_zipcode = $request->company_zipcode;
        $user->company_address = $request->company_address;
        $user->company_url = $request->company_url;
        $user->company_overview = $request->company_overview;
        $user->save();
    
        $client = new Client();
        $sentence = "我々の会社は、金融業界で証券業務をサポートします。";
        try {
            // POSTリクエストを送信
            $response = $client->request('POST', $this->client_api_url . '/get_cluster', [
                'query' => ['sentence' => $sentence] // クエリパラメータとしてsentenceを送信
            ]);
            Log::debug("API FETCHED");
            // レスポンスの取得
            $body = $response->getBody();
            Log::debug("Body:" . $body);
            $data = json_decode($body, true); // JSONデータを配列にデコード
            Log::debug('API Response: ' . json_encode($data)); // 修正した行
            // 結果を表示
            if ($data) {
                //有れば更新、なければ挿入する
                $preference = UserPreference::firstOrNew([
                    'user_id' => $user->id,
                    'cluster_id' => $data['cluster_id'],
                    'foreign_interest' => $data['foreign_interest'],
                    'environmental_concern' => $data['environmental_concern'],
                ]);
                $preference->save();
            } else {
                Log::warning("データの取得に失敗しました。");
            }
        } catch (\Exception $e) {
            Log::error("API呼び出しエラー: " . $e->getMessage());
            return Inertia::render('Completed', ['message' => 'クラスター情報の取得に失敗しました。']);
        }
        
        //クラスターとかを取得したデータ
        $customer_data = User::with(['preference', 'cluster'])->find(Auth::user()->id);

        return Inertia::render('Completed', [
            'message' => 'クラスターが更新されました。',
            'customer_data' => $customer_data
        ]);
    } 
}
