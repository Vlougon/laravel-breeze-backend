<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;
use App\Models\Address;
use App\Models\Beneficiary;
use App\Models\Contact;
use App\Queries\AddressQuery;

class AddressController extends Controller
{
    public function index()
    {
        $response = AddressQuery::getAllAddresses();

        return response()->json($response->data, $response->status);
    }


    public function store(AddressRequest $request)
    {
        $response = AddressQuery::createAddress($request);

        return response()->json($response->data, $response->status);
    }


    public function show(Address $address)
    {
        $response = AddressQuery::showAddress($address);

        return response()->json($response->data, $response->status);
    }


    public function update(AddressRequest $request, Address $address)
    {
        $response = AddressQuery::updateAddress($request, $address);

        return response()->json($response->data, $response->status);
    }


    public function destroy(Address $address)
    {
        $response = AddressQuery::deleteAddress($address);

        return response()->json($response->data, $response->status);
    }


    public function beneficiaryAddress(Beneficiary $beneficiary)
    {
        $response = AddressQuery::getBeneficiaryAddress($beneficiary);

        return response()->json($response->data, $response->status);
    }


    public function contactAddress(Contact $contact)
    {
        $response = AddressQuery::getContactAddress($contact);

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = AddressQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
