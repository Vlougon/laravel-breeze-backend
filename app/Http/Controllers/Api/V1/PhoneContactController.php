<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PhoneContact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneContactRequest;
use App\Models\Contact;
use App\Queries\PhoneContactQuery;

class PhoneContactController extends Controller
{
    public function index()
    {
        $response = PhoneContactQuery::getAllPhonesContact();

        return response()->json($response->data, $response->status);
    }

    
    public function store(PhoneContactRequest $request)
    {
        $response = PhoneContactQuery::createPhoneContact($request);

        return response()->json($response->data, $response->status);
    }


    public function show(PhoneContact $phoneContact)
    {
        $response = PhoneContactQuery::showPhoneContact($phoneContact);

        return response()->json($response->data, $response->status);
    }


    public function update(PhoneContactRequest $request, PhoneContact $phoneContact)
    {
        $response = PhoneContactQuery::updatePhoneContact($request, $phoneContact);

        return response()->json($response->data, $response->status);
    }


    public function destroy(PhoneContact $phoneContact)
    {
        $response = PhoneContactQuery::deletePhoneContact($phoneContact);

        return response()->json($response->data, $response->status);
    }


    public function contactPhone(Contact $contact)
    {
        $response = PhoneContactQuery::getContactPhone($contact);

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = PhoneContactQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
