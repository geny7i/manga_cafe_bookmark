<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ExtComicController extends Controller
{
    public function bulk_match(Request $request):JsonResponse
    {
        $user = $request->user();

        try {
            $params = $request->validate(
                [
                    'isbn_list' => 'required|string',
                    'shop_id' => 'required|string',
                ]
            );
        } catch (ValidationException $_) {
            return response()->json([
                'result' => 'error',
                'message' => 'invalid_data',
                'data' => []
            ], 422);
        }
        $shop_id = $params['shop_id'];
        $isbn_list = explode(',', $params['isbn_list']);
        $exist_isbn_list = $user->comics()->whereIn('isbn', $isbn_list)
            ->whereHas('shop', function ($query) use ($shop_id) {
                $query->where([['id_in_platform', $shop_id]]);
            })->pluck('isbn')->toArray();
        return response()->json([
            'result' => 'success',
            'message' => 'success',
            'data' => $exist_isbn_list
        ]);
    }
    public function create(Request $request):JsonResponse
    {
        $userId = $request->user()->id;
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
                    'user_id' => $userId,
                    'platform_id' => 1, // TODO:決め打ち
                    'id_in_platform' => $data['shopId']
                ],
                [
                    'name' => $data['shopName'],
                ]
            );

            Comic::firstOrCreate(
                [
                    'user_id' => $userId,
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
        return response()->json([
            'result' => 'success',
            'message' => "success"
        ]);
    }
}
