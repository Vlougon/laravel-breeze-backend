<?php

namespace App\Queries;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use stdClass;

class AddressQuery
{
    public static function getAllAddresses()
    {
        $addresses = AddressResource::collection(Address::latest()->get());
        $response = new stdClass();

        if ($addresses->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Direcciones!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Direcciones Encontradas!',
            'data' => $addresses,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createAddress($request)
    {
        $address = Address::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Dirección Añadida Exitosamente!',
            'data' => new AddressResource($address),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showAddress($address)
    {
        $response = new stdClass();

        if (is_null($address)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando la Dirección!',
            'data' => new AddressResource($address),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateAddress($request, $address)
    {
        $response = new stdClass();

        if (is_null($address)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $address->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Dirección Actualizada!',
            'data' => new AddressResource($address),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteAddress($address)
    {
        $response = new stdClass();

        if (is_null($address)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $address->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Dirección Eliminada!',
            'data' => $address,
        ];
        $response->status = 204;

        return $response;
    }


    public static function getBeneficiaryAddress($beneficiary)
    {
        $response = new stdClass();

        if (is_null($beneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección del Beneficiario!',
            ];
            $response->status = 404;

            return $response;
        }

        $beneficiaryAddress = AddressResource::collection($beneficiary->addresses);

        $response->data = [
            'status' => 'success',
            'message' => '!Dirección del Beneficiario Encontrado!',
            'data' => $beneficiaryAddress,
        ];
        $response->status = 204;

        return $response;
    }


    public static function getContactAddress($contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección del Contacto!',
            ];
            $response->status = 404;

            return $response;
        }

        $contactAddress = AddressResource::collection($contact->addresses);

        $response->data = [
            'status' => 'success',
            'message' => '!Dirección del Contacto Encontrado!',
            'data' => $contactAddress,
        ];
        $response->status = 204;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Dirección!',
        ];
        $response->status = 400;

        return $response;
    }
}
