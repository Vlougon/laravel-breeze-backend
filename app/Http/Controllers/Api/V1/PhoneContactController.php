<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PhoneContact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneContactRequest;
use App\Http\Resources\PhoneContactResource;
use Illuminate\Http\Request;

class PhoneContactController extends Controller
{
    public function index()
    {
        $phoneContacts = PhoneContactResource::collection(PhoneContact::all());

        if ($phoneContacts->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Teléfonos de Contactos!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Estos son los Teléfonos de los Contactos!',
            'data' => $phoneContacts,
        ], 200);
    }

    public function store(PhoneContactRequest $request)
    {
        $phoneContact = PhoneContact::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Añadido Nuevo Teléfono para el Contacto!',
            'data' => new PhoneContactResource($phoneContact),
        ], 201);
    }

    public function show(PhoneContact $phoneContact)
    {
        if (is_null($phoneContact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Contacto!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Teléfono Encontrado!',
            'data' => new PhoneContactResource($phoneContact),
        ], 200);
    }

    public function update(PhoneContactRequest $request, PhoneContact $phoneContact)
    {
        if (is_null($phoneContact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Contacto para Actualizar!',
            ], 404);
        }

        $phoneContact->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Teléfono de Contacto Actualizado!',
            'data' => new PhoneContactResource($phoneContact),
        ], 200);
    }

    public function destroy(PhoneContact $phoneContact)
    {
        if (is_null($phoneContact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Contacto para Eliminar!',
            ], 404);
        }

        $phoneContact->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Teléfono de Contacto Eliminado!',
            'data' => $phoneContact,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para los Teléfonos de Contacto!',
        ], 400);
    }
}
