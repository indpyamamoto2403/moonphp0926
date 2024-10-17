<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Customer');
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

        return Inertia::render('Completed');
    }    
}
