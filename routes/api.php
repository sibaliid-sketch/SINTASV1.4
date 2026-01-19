<?php

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/validate-promo', function (Request $request) {
    $validated = $request->validate([
        'promo_code' => 'required|string|max:50',
    ]);

    $promo = Promo::where('promo_code', strtoupper($validated['promo_code']))->first();

    if (!$promo) {
        return response()->json([
            'valid' => false,
            'message' => 'Kode promo tidak ditemukan'
        ], 404);
    }

    if (!$promo->isValid()) {
        return response()->json([
            'valid' => false,
            'message' => 'Kode promo sudah kadaluarsa atau tidak aktif'
        ], 422);
    }

    return response()->json([
        'valid' => true,
        'discount_type' => $promo->discount_type,
        'discount_value' => $promo->discount_value,
        'message' => 'Kode promo valid'
    ]);
});
