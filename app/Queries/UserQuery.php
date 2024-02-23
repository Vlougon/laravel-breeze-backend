<?php

namespace App\Queries;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use stdClass;

class UserQuery
{
    public static function getAllUsers()
    {
        $users = UserResource::collection(User::latest()->get());
        $response = new stdClass();

        if ($users->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Usuarios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Usuarios Encontrados!',
            'data' => $users,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createUser($request)
    {
        $user = User::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Usuario Creado Exitosamente!',
            'data' => new UserResource($user),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showUser($user)
    {
        $response = new stdClass();

        if (is_null($user)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Usuario!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando Datos de ' . $user->name . '!',
            'data' => new UserResource($user),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateUser($request, $user)
    {
        $response = new stdClass();

        if (is_null($user)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Usuario para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        if ($request->email !== $user->email) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡El Email debe ser el mismo!',
            ];
            $response->status = 400;

            return $response;
        }

        $user->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Usuario actualizado Exitosamente!',
            'data' => new UserResource($user),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteUser($user)
    {
        $response = new stdClass();

        if (is_null($user)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Usuario para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $user->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Usuario Eliminado Exitosamente!',
            'data' => $user,
        ];
        $response->status = 204;

        return $response;
    }


    public static function ultimateUserData()
    {
        $users = DB::table('users')
            ->leftJoin('phone_users', 'users.id', '=', 'phone_users.user_id')
            ->select('users.name', 'users.email', 'users.role', 'phone_users.phone_number')
            ->get();
        $response = new stdClass();

        if ($users->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron los Recordatorios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de los Usuarios!',
            'data' => $users,
        ];
        $response->status = 200;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Usuarios!',
        ];
        $response->status = 400;

        return $response;
    }
}
