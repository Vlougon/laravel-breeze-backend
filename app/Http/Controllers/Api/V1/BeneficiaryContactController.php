<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BeneficiaryContactRequest;
use App\Http\Resources\BeneficiaryContactResource;
use App\Models\BeneficiaryContact;

class BeneficiaryContactController extends Controller
{
    public function index()
    {
        $contacts = BeneficiaryContactResource::collection(BeneficiaryContact::all());

        if ($contacts->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Contactos de Beneficiarios!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Contactos de Beneficiarios Encontrados!',
            'data' => $contacts,
        ], 200);
    }

    public function store(BeneficiaryContactRequest $request)
    {
        $contact = BeneficiaryContact::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Creado!',
            'data' => new BeneficiaryContactResource($contact),
        ], 201);
    }

    public function show(BeneficiaryContact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto de Beneficiario!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Obtenido!',
            'data' => new BeneficiaryContactResource($contact),
        ], 200);
    }

    public function update(BeneficiaryContactRequest $request, BeneficiaryContact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto de Beneficiario pars Actualizar!',
            ], 404);
        }

        $contact->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Actualizado!',
            'data' => new BeneficiaryContactResource($contact),
        ], 200);
    }

    public function destroy(BeneficiaryContact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto de Beneficiario pars Eliminar!',
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Eliminado!',
            'data' => $contact,
        ], 204);
    }
}
