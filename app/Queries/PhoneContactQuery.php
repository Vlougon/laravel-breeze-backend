<?php

namespace App\Queries;

use App\Http\Resources\PhoneContactResource;
use App\Models\PhoneContact;
use stdClass;

class PhoneContactQuery
{
    public static function getAllPhonesContact()
    {
        $phoneContacts = PhoneContactResource::collection(PhoneContact::latest()->get());
        $response = new stdClass();

        if ($phoneContacts->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Teléfonos de Contactos!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Estos son los Teléfonos de los Contactos!',
            'data' => $phoneContacts,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createPhoneContact($request)
    {
        $phoneContact = PhoneContact::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Añadido Nuevo Teléfono para el Contacto!',
            'data' => new PhoneContactResource($phoneContact),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showPhoneContact($phoneContact)
    {
        $response = new stdClass();

        if (is_null($phoneContact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Contacto!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Teléfono Encontrado!',
            'data' => new PhoneContactResource($phoneContact),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updatePhoneContact($request, $phoneContact)
    {
        $response = new stdClass();

        if (is_null($phoneContact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Contacto para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $phoneContact->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Teléfono de Contacto Actualizado!',
            'data' => new PhoneContactResource($phoneContact),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deletePhoneContact($phoneContact)
    {
        $response = new stdClass();

        if (is_null($phoneContact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Contacto para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $phoneContact->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Teléfono de Contacto Eliminado!',
            'data' => $phoneContact,
        ];
        $response->status = 204;

        return $response;
    }


    public static function getContactPhone($contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado al Contacto con Teléfono!',
            ];
            $response->status = 404;

            return $response;
        }

        $contactPhone = PhoneContactResource::collection($contact->phoneContacts);

        $response->data = [
            'status' => 'success',
            'message' => '!Teléfono de Contactp Encontrado!',
            'data' => $contactPhone,
        ];
        $response->status = 200;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para los Teléfonos de Contacto!',
        ];
        $response->status = 400;

        return $response;
    }
}
