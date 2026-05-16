<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LayananController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'apikey' => env('SUPABASE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
        ])->get(env('SUPABASE_URL') . '/rest/v1/services?select=*');

        $services = $response->successful() ? $response->json() : [];

        return view('layanan', compact('services'));
    }

    // FUNGSI INI YANG HILANG/BELUM ADA
    public function order()
    {
        $response = Http::withHeaders([
            'apikey' => env('SUPABASE_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
        ])->get(env('SUPABASE_URL') . '/rest/v1/services?select=*');

        $services = $response->successful() ? $response->json() : [];

        return view('pesan', compact('services'));
    }
}