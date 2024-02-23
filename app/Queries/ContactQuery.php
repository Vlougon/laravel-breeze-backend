<?php

namespace App\Queries;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use stdClass;

class ContactQuery
{
    public static function getAllContacts()
    {
        $contacts = ContactResource::collection(Contact::all());
        $response = new stdClass();

        if ($contacts->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Contactos!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Contactos Encontrados!',
            'data' => $contacts,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createContact($request)
    {
        $contact = Contact::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto Añadido Correctamente!',
            'data' => new ContactResource($contact),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showContact($contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando Datos del Contacto ' . $contact->name . '!',
            'data' => new ContactResource($contact),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateContact($request, $contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto para Actualziar!',
            ];
            $response->status = 404;

            return $response;
        }

        $contact->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto Actualizado!',
            'data' => new ContactResource($contact),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteContact($contact)
    {
        $response = new stdClass();

        if (is_null($contact)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Contacto para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $contact->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto Eliminado!',
            'data' => $contact,
        ];
        $response->status = 204;

        return $response;
    }


    public static function ultimateContactData()
    {
        $contacts = DB::table('contacts')
            ->join('beneficiary_contacts', 'contacts.id', '=', 'beneficiary_contacts.contact_id')
            ->join('beneficiaries', 'beneficiary_contacts.beneficiary_id', '=', 'beneficiaries.id')
            ->leftJoin('addresses', 'contacts.id', '=', 'addresses.addressable_id')
            ->leftJoin('phone_contacts', 'contacts.id', '=', 'phone_contacts.contact_id')
            ->select(
                'contacts.name as contact_name',
                'contacts.first_surname as contact_fs',
                'contacts.second_surname as contact_ss',
                'contacts.contact_type',
                'phone_contacts.phone_number',
                'addresses.province',
                'addresses.locality',
                'addresses.postal_code',
                'addresses.street',
                'addresses.number',
                'beneficiaries.name as beneficiary_name',
                'beneficiaries.first_surname as beneficiary_fs',
                'beneficiaries.second_surname as beneficiary_ss',
                'beneficiaries.dni',
            )
            ->get();
        $response = new stdClass();

        if ($contacts->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron los Contactos!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de los Contactos!',
            'data' => $contacts,
        ];
        $response->status = 200;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Contactos!',
        ];
        $response->status = 400;

        return $response;
    }
}
