<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Queries\UserQuery;

class UserController extends Controller
{
    public function index()
    {
        $response = UserQuery::getAllUsers();

        return response()->json($response->data, $response->status);
    }


    public function store(UserRequest $request)
    {
        $response = UserQuery::createUser($request);

        return response()->json($response->data, $response->status);
    }


    public function show(User $user)
    {
        $response = UserQuery::showUser($user);

        return response()->json($response->data, $response->status);
    }


    public function update(UserRequest $request, User $user)
    {
        $response = UserQuery::updateUser($request, $user);

        return response()->json($response->data, $response->status);
    }


    public function destroy(User $user)
    {
        $response = UserQuery::deleteUser($user);

        return response()->json($response->data, $response->status);
    }

    public function ultimateUser()
    {
        $response = UserQuery::ultimateUserData();

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = UserQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
