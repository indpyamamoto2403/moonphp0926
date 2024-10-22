<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPreference;
class CustomerController extends Controller
{

    protected $client_api_url;
    public function __construct()
    {
        $this->client_api_url = env('FASTAPI_ENDPOINT');
    }
    
    public function index(Request $request)
    {
        $user_data = User::with(['information','preference', 'cluster'])->find(Auth::user()->id);
        return Inertia::render('Customer', [
            'user_data' => $user_data
        ]);
    }

    public function completed(CustomerRequest $request)
    {
        Log::debug('Completed request', $request->all());
        // ユーザーを取得
        $user = User::find($request->user()->id);

        // ユーザー情報を取得または新規作成
        $userInformation = UserInformation::firstOrNew(['user_id' => $user->id]);

        // UserInformationに属性を更新
        $userInformation->company_name = $request->company_name;
        $userInformation->name = $request->name;
        $userInformation->department = $request->department;
        $userInformation->company_zipcode = $request->company_zipcode;
        $userInformation->company_address = $request->company_address;
        $userInformation->company_url = $request->company_url;
        $userInformation->company_overview = $request->company_overview;
        $userInformation->save();

    
    // クライアントを作成
    $client = new Client();

    try {
        // POSTリクエストを送信
        $response = $client->request('POST', $this->client_api_url . '/get_cluster', [
            'query' => ['sentence' => $userInformation->company_overview] // クエリパラメータとしてcompany_overviewを送信
        ]);

        // レスポンスの取得
        $body = $response->getBody();
        $data = json_decode($body, true);

        if ($data) {
            // Preferenceを更新または新規作成
            $preference = UserPreference::firstOrNew([
                'user_id' => $user->id,
                'cluster_id' => $data['cluster_id'],
            ]);
            $preference->save();
        } else {
            Log::warning("データの取得に失敗しました。");
        }
    } catch (\Exception $e) {
        Log::error("API呼び出しエラー: " . $e->getMessage());
        return Inertia::render('Completed', ['message' => 'クラスター情報の取得に失敗しました。']);
    }

    // クラスターとユーザーの情報を取得
    $customer_data = User::with(['information', 'preference', 'cluster'])->find(Auth::user()->id);

    return Inertia::render('Completed', [
        'message' => 'クラスターが更新されました。',
        'customer_data' => $customer_data
    ]);
    }
}