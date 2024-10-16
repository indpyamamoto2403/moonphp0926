<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;


class KeywordSearchController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('KeywordSearch');
    }
}