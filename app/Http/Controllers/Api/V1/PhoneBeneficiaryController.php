<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PhoneBeneficiary;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneBeneficiaryRequest;
use App\Models\Beneficiary;
use App\Queries\PhoneBeneficiaryQuery;

class PhoneBeneficiaryController extends Controller
{
    public function index()
    {
        $response = PhoneBeneficiaryQuery::getAllPhonesBeneficiary();

        return response()->json($response->data, $response->status);
    }


    public function store(PhoneBeneficiaryRequest $request)
    {
        $response = PhoneBeneficiaryQuery::createPhoneBeneficiary($request);

        return response()->json($response->data, $response->status);
    }


    public function show(PhoneBeneficiaryRequest $phoneBeneficiary)
    {
        $response = PhoneBeneficiaryQuery::showPhoneBeneficiary($phoneBeneficiary);

        return response()->json($response->data, $response->status);
    }


    public function update(PhoneBeneficiaryRequest $request, PhoneBeneficiary $phoneBeneficiary)
    {
        $response = PhoneBeneficiaryQuery::updatePhoneBeneficiary($request, $phoneBeneficiary);

        return response()->json($response->data, $response->status);
    }


    public function destroy(PhoneBeneficiary $phoneBeneficiary)
    {
        $response = PhoneBeneficiaryQuery::deletePhoneBeneficiary($phoneBeneficiary);

        return response()->json($response->data, $response->status);
    }


    public function beneficiaryPhone(Beneficiary $beneficiary)
    {
        $response = PhoneBeneficiaryQuery::getBeneficiaryPhone($beneficiary);

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = PhoneBeneficiaryQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
