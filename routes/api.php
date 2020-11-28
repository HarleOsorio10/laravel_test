<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fetch;
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
Route::get('get_scores', 'Fetch@GetData');
Route::get('save_score', 'Fetch@SaveData');