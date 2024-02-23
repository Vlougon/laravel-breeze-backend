<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BeneficiaryContactRequest;
use App\Models\BeneficiaryContact;
use App\Queries\BeneficiaryContactQuery;

class BeneficiaryContactController extends Controller
{
    public function index()
    {
        $response = BeneficiaryContactQuery::getAllBeneficiaryContacts();

        return response()->json($response->data, $response->status);
    }

    public function store(BeneficiaryContactRequest $request)
    {
        $response = BeneficiaryContactQuery::createBeneficiaryContact($request);

        return response()->json($response->data, $response->status);
    }

    public function show(BeneficiaryContact $contact)
    {
        $response = BeneficiaryContactQuery::showBeneficiaryContact($contact);

        return response()->json($response->data, $response->status);
    }

    public function update(BeneficiaryContactRequest $request, BeneficiaryContact $contact)
    {
        $response = BeneficiaryContactQuery::updateBeneficiaryContact($request, $contact);

        return response()->json($response->data, $response->status);
    }

    public function destroy(BeneficiaryContact $contact)
    {
        $response = BeneficiaryContactQuery::deleteBeneficiaryContact($contact);

        return response()->json($response->data, $response->status);
    }
}
