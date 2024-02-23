<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Models\Contact;
use App\Queries\ContactQuery;

class ContactController extends Controller
{
    public function index()
    {
        $response = ContactQuery::getAllContacts();

        return response()->json($response->data, $response->status);
    }


    public function store(ContactRequest $request)
    {
        $response = ContactQuery::createContact($request);

        return response()->json($response->data, $response->status);
    }


    public function show(Contact $contact)
    {
        $response = ContactQuery::showContact($contact);

        return response()->json($response->data, $response->status);
    }


    public function update(ContactRequest $request, Contact $contact)
    {
        $response = ContactQuery::updateContact($request, $contact);

        return response()->json($response->data, $response->status);
    }


    public function destroy(Contact $contact)
    {
        $response = ContactQuery::deleteContact($contact);

        return response()->json($response->data, $response->status);
    }


    public function ultimateContact()
    {
        $response = ContactQuery::ultimateContactData();

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = ContactQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
