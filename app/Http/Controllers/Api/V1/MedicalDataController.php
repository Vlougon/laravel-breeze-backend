<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MedicalDataRequest;
use App\Models\MedicalData;
use App\Queries\MedicalDataQuery;

class MedicalDataController extends Controller
{
    public function index()
    {
        $response = MedicalDataQuery::getAllMedicalDatas();

        return response()->json($response->data, $response->status);
    }

    public function store(MedicalDataRequest $request)
    {
        $response = MedicalDataQuery::createMedicalData($request);

        return response()->json($response->data, $response->status);
    }

    public function show(MedicalData $medicalData)
    {
        $response = MedicalDataQuery::showMedicalData($medicalData);

        return response()->json($response->data, $response->status);
    }

    public function update(MedicalDataRequest $request, MedicalData $medicalData)
    {
        $response = MedicalDataQuery::updateMedicalData($request, $medicalData);

        return response()->json($response->data, $response->status);
    }


    public function destroy(MedicalData $medicalData)
    {
        $response = MedicalDataQuery::deleteMedicalData($medicalData);

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = MedicalDataQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
