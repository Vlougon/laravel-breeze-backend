<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BeneficiaryRequest;
use App\Models\Beneficiary;
use App\Queries\BeneficiaryQuery;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $response = BeneficiaryQuery::getAllCBeneficiaries();

        return response()->json($response->data, $response->status);
    }


    public function store(BeneficiaryRequest $request)
    {
        $response = BeneficiaryQuery::createBeneficiary($request);

        return response()->json($response->data, $response->status);
    }


    public function show(Beneficiary $beneficiary)
    {
        $response = BeneficiaryQuery::showBeneficiary($beneficiary);

        return response()->json($response->data, $response->status);
    }


    public function update(BeneficiaryRequest $request, Beneficiary $beneficiary)
    {
        $response = BeneficiaryQuery::updateBeneficiary($request, $beneficiary);

        return response()->json($response->data, $response->status);
    }


    public function destroy(Beneficiary $beneficiary)
    {
        $response = BeneficiaryQuery::deleteBeneficiary($beneficiary);

        return response()->json($response->data, $response->status);
    }


    public function contactsBeneficiary(Beneficiary $beneficiary)
    {
        $response = BeneficiaryQuery::getBeneficiaryContacts($beneficiary);

        return response()->json($response->data, $response->status);
    }


    public function fullBeneficiary()
    {
        $response = BeneficiaryQuery::getFullBeneficiary();

        return response()->json($response->data, $response->status);
    }


    public function firstBeneficiary()
    {
        $response = BeneficiaryQuery::getFirstBeneficiary();

        return response()->json($response->data, $response->status);
    }


    public function ultimateBeneficiary()
    {
        $response = BeneficiaryQuery::ultimateBeneficiaryData();

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = BeneficiaryQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
