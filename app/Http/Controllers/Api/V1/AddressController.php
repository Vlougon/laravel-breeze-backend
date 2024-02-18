<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\Beneficiary;
use App\Models\Contact;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = AddressResource::collection(Address::latest()->get());

        if ($addresses->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Direcciones!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Direcciones Encontradas!',
            'data' => $addresses,
        ], 200);
    }

    public function store(AddressRequest $request)
    {
        $address = Address::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Dirección Añadida Exitosamente!',
            'data' => new AddressResource($address),
        ], 201);
    }

    public function show(Address $address)
    {
        if (is_null($address)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Mostrando la Dirección!',
            'data' => new AddressResource($address),
        ], 200);
    }

    public function update(AddressRequest $request, Address $address)
    {
        if (is_null($address)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección para Actualizar!',
            ], 404);
        }

        $address->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Dirección Actualizada!',
            'data' => new AddressResource($address),
        ], 200);
    }

    public function destroy(Address $address)
    {
        if (is_null($address)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección para Eliminar!',
            ], 404);
        }

        $address->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Dirección Eliminada!',
            'data' => $address,
        ], 204);
    }

    public function beneficiaryAddress(Beneficiary $beneficiary)
    {
        if (is_null($beneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección del Beneficiario!',
            ], 404);
        }

        $beneficiaryAddress = AddressResource::collection($beneficiary->addresses);

        return response()->json([
            'status' => 'success',
            'message' => '!Dirección del Beneficiario Encontrado!',
            'data' => $beneficiaryAddress,
        ], 200);
    }

    public function contactAddress(Contact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Dirección del Contacto!',
            ], 404);
        }

        $contactAddress = AddressResource::collection($contact->addresses);

        return response()->json([
            'status' => 'success',
            'message' => '!Dirección del Contacto Encontrado!',
            'data' => $contactAddress,
        ], 200);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Dirección!',
        ], 400);
    }
}
