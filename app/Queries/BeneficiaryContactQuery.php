<?php

namespace App\Queries;

use App\Http\Resources\BeneficiaryContactResource;
use App\Models\BeneficiaryContact;
use stdClass;

class BeneficiaryContactQuery
{
    public static function getAllBeneficiaryContacts()
    {
        $contacts = BeneficiaryContactResource::collection(BeneficiaryContact::all());
        $response = new stdClass();

        if ($contacts->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Contactos de Beneficiarios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Contactos de Beneficiarios Encontrados!',
            'data' => $contacts,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createBeneficiaryContact($request)
    {
        $contact = BeneficiaryContact::create($request->all());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Creado!',
            'data' => new BeneficiaryContactResource($contact),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showBeneficiaryContact($contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto de Beneficiario!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Obtenido!',
            'data' => new BeneficiaryContactResource($contact),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateBeneficiaryContact($request, $contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto de Beneficiario pars Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $contact->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Actualizado!',
            'data' => new BeneficiaryContactResource($contact),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteBeneficiaryContact($contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto de Beneficiario pars Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $contact->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Eliminado!',
            'data' => $contact,
        ];
        $response->status = 204;

        return $response;
    }
}
