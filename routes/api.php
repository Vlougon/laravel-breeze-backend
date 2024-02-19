<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PhoneUserController;
use App\Http\Controllers\Api\V1\BeneficiaryController;
use App\Http\Controllers\Api\V1\PhoneBeneficiaryController;
use App\Http\Controllers\Api\V1\CallController;
use App\Http\Controllers\Api\V1\MedicalDataController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\PhoneContactController;
use App\Http\Controllers\Api\V1\ReminderController;
use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Controllers\Api\V1\BeneficiaryContactController;
use App\Http\Controllers\Api\V1\UserController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('V1')->group(function () {

        Route::middleware('can:viewAssistants,App\Models\User')->group(function () {
            // Rutas para User
            Route::apiResource('users', UserController::class);

            // Rutas para Phone_User
            Route::apiResource('phone_users', PhoneUserController::class);
        });

        // Rutas para Beneficiary
        Route::apiResource('beneficiaries', BeneficiaryController::class);

        // Rutas para Phone_Beneficiary
        Route::apiResource('phone_beneficiaries', PhoneBeneficiaryController::class);

        // Rutas para Call
        Route::apiResource('calls', CallController::class);

        // Rutas para MedicalData
        Route::apiResource('medical_data', MedicalDataController::class);

        // Rutas para Contact
        Route::apiResource('contacts', ContactController::class);

        // Rutas para Phone_Contact
        Route::apiResource('phone_contacts', PhoneContactController::class);

        // Rutas para Reminder
        Route::apiResource('reminders', ReminderController::class);

        // Rutas para Address
        Route::apiResource('addresses', AddressController::class);

        // Rutas para los Contactos de Beneficiarios
        Route::apiResource('beneficiary_contacts', BeneficiaryContactController::class);

        //Custom Routes
        Route::get('userPhone/{user}', [PhoneUserController::class, 'userPhone']);

        Route::get('beneficiaryPhone/{beneficiary}', [PhoneBeneficiaryController::class, 'beneficiaryPhone']);

        Route::get('contactPhone/{contact}', [PhoneBeneficiaryController::class, 'contactPhone']);

        Route::get('beneficiaryAddress/{beneficiary}', [AddressController::class, 'beneficiaryAddress']);

        Route::get('contactAddress/{contact}', [AddressController::class, 'contactAddress']);
    });
});
