<?php

use App\Services\PhoneDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/phoneData/import', function (PhoneDataService $phoneDataService) {
    if ($phoneDataService->importPhoneData()) {
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
    return new JsonResponse(["message" => "An unexpected error occurred"], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
});
