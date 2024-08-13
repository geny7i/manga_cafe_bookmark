<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ExtComicController extends Controller
{
    public function create(Request $request):JsonResponse
    {
        if(!Auth::id()) {
            return response()->json([
                'result' => 'error',
                'message' => 'unauthorized'
            ], 401);
        }
        try {
            $data = $request->validate(
                [
                    'isbn' => 'required|string',
                    'shopId' => 'required|string',
                    'shopName' => 'required|string',
                    'comicTitle' => 'required|string',
                    'shelfInfo' => 'required|string',
                ]
            );

            $shop = Shop::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'platform_id' => 1, // TODO:決め打ち
                    'id_in_platform' => $data['shopId']
                ],
                [
                    'name' => $data['shopName'],
                ]
            );

            $comic = Comic::firstOrCreate(
                [
                    'id_in_platform' => $data['isbn'],
                    'shop_id' => $shop->id,
                ],
                [
                    'isbn' => $data['isbn'],
                    'shelf_info' => $data['shelfInfo'],
                    'title' => $data['comicTitle']
                ]
            );

        } catch (ValidationException $_) {
            return response()->json([
                'result' => 'error',
                'message' => 'invalid_data'
            ], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => 'error',
                'message' => 'server_error'
            ], 500);
        }
        $uid = Auth::id();
        return response()->json([
            'result' => 'success',
            'message' => "create_success"
        ]);
    }
}
