<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Http\Resources\ContactResource;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = ContactResource::collection(Contact::all());

        if ($contacts->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Contactos!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Contactos Encontrados!',
            'data' => $contacts,
        ], 200);
    }

    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto Añadido Correctamente!',
            'data' => new ContactResource($contact),
        ], 201);
    }

    public function show(Contact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Mostrando Datos del Contacto ' . $contact->name . '!',
            'data' => new ContactResource($contact),
        ], 200);
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto para Actualziar!',
            ], 404);
        }

        $contact->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto Actualizado!',
            'data' => new ContactResource($contact),
        ], 200);
    }

    public function destroy(Contact $contact)
    {
        if (is_null($contact)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto para Eliminar!',
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Contacto Eliminado!',
            'data' => $contact,
        ], 204);
    }

    public function getAllContactsDetails()
    {
        $contacts = DB::table('contacts')
            ->join('beneficiary_contacts', 'contacts.id', '=', 'beneficiary_contacts.contact_id')
            ->join('beneficiaries', 'beneficiaries.id', '=', 'beneficiary_contacts.beneficiary_id')
            ->leftJoin('phone_beneficiaries', 'beneficiaries.id', '=', 'phone_beneficiaries.beneficiary_id')
            ->leftJoin('addresses', 'contacts.id', '=', 'addresses.addressable_id')
            ->select(
                'contacts.name as NameContact',
                'contacts.contact_type as TypeContact',
                'beneficiaries.name as NameBeneficiary',
                'beneficiaries.dni as DNIBeneficiary',
                'phone_beneficiaries.phone_number as PhoneBeneficiary',
                'addresses.locality as Locality',
                'addresses.province as Province',
                'addresses.street as Street'
            )
            ->get();

        if ($contacts->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Contactos!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Contactos Encontrados!',
            'data' => $contacts,
        ], 200);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Contactos!',
        ], 400);
    }
}
