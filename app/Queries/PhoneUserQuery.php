<?php

namespace App\Queries;

use App\Http\Resources\PhoneUserResource;
use App\Models\PhoneUser;
use stdClass;

class PhoneUserQuery
{
    public static function getAllPhonesUser()
    {
        $phoneUsers = PhoneUserResource::collection(PhoneUser::latest()->get());
        $response = new stdClass();

        if ($phoneUsers->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Teléfonos de Usuarios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Estos son los Teléfono de los Usuarios!',
            'data' => $phoneUsers,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createPhoneUser($request)
    {
        $phoneUser = PhoneUser::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Añadido Nuevo Teléfono para el Usuario!',
            'data' => new PhoneUserResource($phoneUser),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showPhoneUser($phoneUser)
    {
        $response = new stdClass();

        if (is_null($phoneUser)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Usuario!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Teléfono Encontrado!',
            'data' => new PhoneUserResource($phoneUser),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updatePhoneUser($request, $phoneUser)
    {
        $response = new stdClass();

        if (is_null($phoneUser)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono de Usuario para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $phoneUser->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Teléfono de Usuario Actualizado!',
            'data' => new PhoneUserResource($phoneUser),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deletePhoneUser($phoneUser)
    {
        $response = new stdClass();

        if (is_null($phoneUser)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono de Usuario para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $phoneUser->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Teléfono de Usuario Eliminado!',
            'data' => $phoneUser,
        ];
        $response->status = 204;

        return $response;
    }


    public static function getUserPhone($user)
    {
        $response = new stdClass();

        if (is_null($user)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado al Usuairo con Teléfono!',
            ];
            $response->status = 404;

            return $response;
        }

        $userPhone = PhoneUserResource::collection($user->phoneUsers);

        $response->data = [
            'status' => 'success',
            'message' => '!Teléfono de Usuario Encontrado!',
            'data' => $userPhone,
        ];
        $response->status = 200;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para los Teléfonos de Usuarios!',
        ];
        $response->status = 400;

        return $response;
    }
}
