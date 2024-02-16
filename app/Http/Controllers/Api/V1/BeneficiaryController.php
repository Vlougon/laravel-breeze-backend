<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BeneficiaryRequest;
use App\Http\Resources\BeneficiaryResource;
use App\Models\Beneficiary;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = BeneficiaryResource::collection(Beneficiary::latest()->get());

        if ($beneficiaries->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Beneficiarios!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Beneficiarios Encontrados!',
            'data' => $beneficiaries,
        ], 200);
    }

    public function store(BeneficiaryRequest $request)
    {
        $beneficiary = Beneficiary::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Beneficiario Creado Exitosamente!',
            'data' => new BeneficiaryResource($beneficiary),
        ], 201);
    }

    public function show(Beneficiary $beneficiary)
    {
        if (is_null($beneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Mostrando Datos del Beneficiario ' . $beneficiary->name . '!',
            'data' => new BeneficiaryResource($beneficiary),
        ], 200);
    }

    public function update(BeneficiaryRequest $request, Beneficiary $beneficiary)
    {
        if (is_null($beneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario para Actualziar!',
            ], 404);
        }

        $beneficiary->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Beneficiario Actualizado!',
            'data' => new BeneficiaryResource($beneficiary),
        ], 200);
    }

    public function destroy(Beneficiary $beneficiary)
    {
        if (is_null($beneficiary)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario para Eliminar!',
            ], 404);
        }

        $beneficiary->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Beneficiario Eliminado!',
            'data' => $beneficiary,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Beneficiarios!',
        ], 400);
    }
}
