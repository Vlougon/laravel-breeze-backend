<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PhoneBeneficiary;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneBeneficiaryRequest;
use App\Http\Resources\PhoneBeneficiaryResource;
use Illuminate\Http\Request;

class PhoneBeneficiaryController extends Controller
{
    public function index()
    {
        $phoneBeneficiaries = PhoneBeneficiaryResource::collection(PhoneBeneficiary::all());

        if ($phoneBeneficiaries->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Teléfonos de Beneficiarios!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Estos son los Teléfonos de los Beneficiarios!',
            'data' => $phoneBeneficiaries,
        ], 200);
    }

    public function store(PhoneBeneficiaryRequest $request)
    {
        $phoneBeneficiary = PhoneBeneficiary::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Añadido Nuevo Teléfono para el Beneficiario!',
            'data' => new PhoneBeneficiaryResource($phoneBeneficiary),
        ], 201);
    }

    public function show(PhoneBeneficiaryResource $phoneBeneficiary)
    {
        if (is_null($phoneBeneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Beneficiario!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Teléfono Encontrado!',
            'data' => new PhoneBeneficiaryResource($phoneBeneficiary),
        ], 200);
    }

    public function update(PhoneBeneficiaryRequest $request, PhoneBeneficiary $phoneBeneficiary)
    {
        if (is_null($phoneBeneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Beneficiario para Actualizar!',
            ], 404);
        }

        $phoneBeneficiary->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Teléfono de Beneficiario Actualizado!',
            'data' => new PhoneBeneficiaryResource($phoneBeneficiary),
        ], 200);
    }

    public function destroy(PhoneBeneficiary $phoneBeneficiary)
    {
        if (is_null($phoneBeneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Teléfono del Beneficiario para Eliminar!',
            ], 404);
        }

        $phoneBeneficiary->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Teléfono de Beneficiario Eliminado!',
            'data' => $phoneBeneficiary,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para los Teléfonos de Beneficiarios!',
        ], 400);
    }
}
