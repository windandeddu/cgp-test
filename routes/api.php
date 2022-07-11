<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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

Route::post('bearer/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    $user = User::where('email', $request->email)->first();

    if (!$user || !Auth::attempt($credentials)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken('')->plainTextToken;
});

Route::get('companies',[CompanyController::class,'companies'])->middleware(['auth:sanctum']);
Route::get('clients/{company}',[CompanyController::class,'clients'])->where('company','\d+')->middleware(['auth:sanctum']);
Route::get('client_companies/{client}',[ClientController::class,'client_companies'])->where('client','\d+')->middleware(['auth:sanctum']);
