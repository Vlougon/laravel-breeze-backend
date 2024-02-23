<?php

namespace App\Queries;

use App\Http\Resources\PhoneBeneficiaryResource;
use App\Models\PhoneBeneficiary;
use stdClass;

class PhoneBeneficiaryQuery
{
    public static function getAllPhonesBeneficiary()
    {
        $phoneBeneficiaries = PhoneBeneficiaryResource::collection(PhoneBeneficiary::all());
        $response = new stdClass();

        if ($phoneBeneficiaries->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Teléfonos de Beneficiarios!',

                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Estos son los Teléfonos de los Beneficiarios!',
            'data' => $phoneBeneficiaries,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createPhoneBeneficiary($request)
    {
        $phoneBeneficiary = PhoneBeneficiary::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Añadido Nuevo Teléfono para el Beneficiario!',
            'data' => new PhoneBeneficiaryResource($phoneBeneficiary),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showPhoneBeneficiary($phoneBeneficiary)
    {
        $response = new stdClass();

        if (is_null($phoneBeneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Beneficiario!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Teléfono Encontrado!',
            'data' => new PhoneBeneficiaryResource($phoneBeneficiary),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updatePhoneBeneficiary($request, $phoneBeneficiary)
    {
        $response = new stdClass();

        if (is_null($phoneBeneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Beneficiario para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $phoneBeneficiary->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Teléfono de Beneficiario Actualizado!',
            'data' => new PhoneBeneficiaryResource($phoneBeneficiary),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deletePhoneBeneficiary($phoneBeneficiary)
    {
        $response = new stdClass();

        if (is_null($phoneBeneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Beneficiario para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $phoneBeneficiary->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Teléfono de Beneficiario Eliminado!',
            'data' => $phoneBeneficiary,
        ];
        $response->status = 204;

        return $response;
    }


    public static function getBeneficiaryPhone($beneficiary)
    {
        $response = new stdClass();

        if (is_null($beneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado al Beneficiario con Teléfono!',
            ];
            $response->status = 404;

            return $response;
        }

        $beneficiaryPhone = PhoneBeneficiaryResource::collection($beneficiary->phoneBeneficiaries);

        $response->data = [
            'status' => 'success',
            'message' => '!Teléfono de Beneficiario Encontrado!',
            'data' => $beneficiaryPhone,
        ];
        $response->status = 204;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para los Teléfonos de Beneficiarios!',
        ];
        $response->status = 400;

        return $response;
    }
}
