<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = UserResource::collection(User::latest()->get());

        if ($users->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Usuarios!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Usuarios Encontrados!',
            'data' => $users,
        ], 200);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Usuario Creado Exitosamente!',
            'data' => new UserResource($user),
        ], 201);
    }

    public function show(User $user)
    {
        if (is_null($user)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Usuario!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Mostrando Datos de ' . $user->name . '!',
            'data' => new UserResource($user),
        ], 200);
    }

    public function update(UserRequest $request, User $user)
    {
        if (is_null($user)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Usuario para Actualizar!',
            ], 404);
        }

        if ($request->password === $user->password) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡La Contraseña debe ser Diferente!',
            ], 400);
        }

        if ($request->email !== $user->email) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡El Email debe ser el mismo!',
            ], 400);
        }

        $user->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Usuario actualizado Exitosamente!',
            'data' => new UserResource($user),
        ], 200);
    }

    public function destroy(User $user)
    {
        if (is_null($user)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Usuario para Eliminar!',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Usuario Eliminado Exitosamente!',
            'data' => $user,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Usuarios!',
        ], 400);
    }
}
