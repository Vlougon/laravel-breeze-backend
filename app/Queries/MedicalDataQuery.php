<?php

namespace App\Queries;

use App\Http\Resources\MedicalDataResource;
use App\Models\Beneficiary;
use App\Models\MedicalData;
use stdClass;

class MedicalDataQuery
{
    public static function getAllMedicalDatas()
    {
        $medicalData = MedicalDataResource::collection(MedicalData::latest()->get());
        $response = new stdClass();

        if ($medicalData->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Datos Médicos!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Datos Médicos Encontrados!',
            'data' => $medicalData,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createMedicalData($request)
    {
        $beneficiaryMedicalData = Beneficiary::find($request->beneficiary_id)->medicalData;
        $response = new stdClass();

        if (is_object($beneficiaryMedicalData)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡Este Beneficiario Ya tiene Datos Médicos!',
                'medical_data_id' => $beneficiaryMedicalData->id,
            ];
            $response->status = 409;

            return $response;
        }

        $medicalData = MedicalData::create($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Datos Médicos Añadidos Correctamente!',
            'data' => new MedicalDataResource($medicalData),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showMedicalData($medicalData)
    {
        $response = new stdClass();

        if (is_null($medicalData)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado los Datos Médicos del Beneficiario!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando Datos Medicos!',
            'data' => new MedicalDataResource($medicalData),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateMedicalData($request, $medicalData)
    {
        $response = new stdClass();

        if (is_null($medicalData)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado los Datos Médicos para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $medicalData->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Datos Médicos Actualizados!',
            'data' => new MedicalDataResource($medicalData),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteMedicalData($medicalData)
    {
        $response = new stdClass();

        if (is_null($medicalData)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado los Datos Médicos para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $medicalData->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Datos Médicos Eliminados!',
            'data' => $medicalData,
        ];
        $response->status = 204;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Datos Médicos!',
        ];
        $response->status = 400;

        return $response;
    }
}
