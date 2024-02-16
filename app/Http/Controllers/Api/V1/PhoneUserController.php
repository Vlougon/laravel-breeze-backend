<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PhoneUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneUserRequest;
use App\Http\Resources\PhoneUserResource;

class PhoneUserController extends Controller
{
    public function index()
    {
        $phoneUsers = PhoneUserResource::collection(PhoneUser::all());

        if ($phoneUsers->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Teléfonos de Usuarios!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Estos son los Teléfono de los Usuarios!',
            'data' => $phoneUsers,
        ], 200);
    }

    public function store(PhoneUserRequest $request)
    {
        $phoneUser = PhoneUser::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Añadido Nuevo Teléfono para el Usuario!',
            'data' => new PhoneUserResource($phoneUser),
        ], 201);
    }

    public function show(PhoneUser $phoneUser)
    {
        if (is_null($phoneUser)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Usuario!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Teléfono Encontrado!',
            'data' => new PhoneUserResource($phoneUser),
        ], 200);
    }

    public function update(PhoneUserRequest $request, PhoneUser $phoneUser)
    {
        if (is_null($phoneUser)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono de Usuario para Actualizar!',
            ], 404);
        }

        $phoneUser->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Teléfono de Usuario Actualizado!',
            'data' => new PhoneUserResource($phoneUser),
        ], 200);
    }

    public function destroy(PhoneUser $phoneUser)
    {
        if (is_null($phoneUser)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono de Usuario para Eliminar!',
            ], 404);
        }

        $phoneUser->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Teléfono de Usuario Eliminado!',
            'data' => $phoneUser,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para los Teléfonos de Usuarios!',
        ], 400);
    }
}
