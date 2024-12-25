<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestApi;

class TestApiController extends Controller
{
    public function apiindex()
    {

        $data =

            [
                'name' => 'test'
            ];
        return $data;
    }
    public function apistore(Request $request)
    {
        // バリデーションを実施
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // データを作成
        $testApi = TestApi::create($validated);

        return response()->json([
            'message' => 'Data created successfully',
            'data' => $testApi,
        ], 201);
    }
}
