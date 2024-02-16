<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MedicalDataRequest;
use App\Http\Resources\MedicalDataResource;
use App\Models\MedicalData;

class MedicalDataController extends Controller
{
    public function index()
    {
        $medicalData = MedicalDataResource::collection(MedicalData::all());

        if ($medicalData->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Datos Médicos!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Datos Médicos Encontrados!',
            'data' => $medicalData,
        ], 200);
    }

    public function store(MedicalDataRequest $request)
    {
        $medicalData = MedicalData::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Datos Médicos Añadidos Correctamente!',
            'data' => new MedicalDataResource($medicalData),
        ], 201);
    }

    public function show(MedicalData $medicalData)
    {
        if (is_null($medicalData)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado los Datos Médicos del Beneficiario!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Mostrando Datos Medicos!',
            'data' => new MedicalDataResource($medicalData),
        ], 200);
    }

    public function update(MedicalDataRequest $request, MedicalData $medicalData)
    {
        if (is_null($medicalData)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado los Datos Médicos para Actualizar!',
            ], 404);
        }

        $medicalData->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Datos Médicos Actualizados!',
            'data' => new MedicalDataResource($medicalData),
        ], 200);
    }

    public function destroy(MedicalData $medicalData)
    {
        if (is_null($medicalData)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado los Datos Médicos para Eliminar!',
            ], 404);
        }

        $medicalData->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Datos Médicos Eliminados1',
            'data' => $medicalData,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Datos Médicos!',
        ], 400);
    }
}
