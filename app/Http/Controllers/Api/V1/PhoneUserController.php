<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PhoneUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneUserRequest;
use App\Models\User;
use App\Queries\PhoneUserQuery;

class PhoneUserController extends Controller
{
    public function index()
    {
        $response = PhoneUserQuery::getAllPhonesUser();

        return response()->json($response->data, $response->status);
    }


    public function store(PhoneUserRequest $request)
    {
        $response = PhoneUserQuery::createPhoneUser($request);

        return response()->json($response->data, $response->status);
    }


    public function show(PhoneUser $phoneUser)
    {
        $response = PhoneUserQuery::showPhoneUser($phoneUser);

        return response()->json($response->data, $response->status);
    }


    public function update(PhoneUserRequest $request, PhoneUser $phoneUser)
    {
        $response = PhoneUserQuery::updatePhoneUser($request, $phoneUser);

        return response()->json($response->data, $response->status);
    }


    public function destroy(PhoneUser $phoneUser)
    {
        $response = PhoneUserQuery::deletePhoneUser($phoneUser);

        return response()->json($response->data, $response->status);
    }


    public function userPhone(User $user)
    {
        $response = PhoneUserQuery::getUserPhone($user);

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = PhoneUserQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
