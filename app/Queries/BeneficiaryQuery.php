<?php

namespace App\Queries;

use App\Http\Resources\BeneficiaryResource;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\DB;
use stdClass;

class BeneficiaryQuery
{
    public static function getAllCBeneficiaries()
    {
        $beneficiaries = BeneficiaryResource::collection(Beneficiary::latest()->get());
        $response = new stdClass();

        if ($beneficiaries->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Beneficiarios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Beneficiarios Encontrados!',
            'data' => $beneficiaries,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createBeneficiary($request)
    {
        $beneficiary = Beneficiary::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Beneficiario Creado Exitosamente!',
            'data' => new BeneficiaryResource($beneficiary),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showBeneficiary($beneficiary)
    {
        $response = new stdClass();

        if (is_null($beneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando Datos del Beneficiario ' . $beneficiary->name . '!',
            'data' => new BeneficiaryResource($beneficiary),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateBeneficiary($request, $beneficiary)
    {
        $response = new stdClass();

        if (is_null($beneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario para Actualziar!',
            ];
            $response->status = 404;

            return $response;
        }

        $beneficiary->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Beneficiario Actualizado!',
            'data' => new BeneficiaryResource($beneficiary),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteBeneficiary($beneficiary)
    {
        $response = new stdClass();

        if (is_null($beneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $beneficiary->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Beneficiario Eliminado!',
            'data' => $beneficiary,
        ];
        $response->status = 204;

        return $response;
    }


    public static function getBeneficiaryContacts($beneficiary)
    {
        $response = new stdClass();

        if (is_null($beneficiary)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Beneficiario!',
            ];
            $response->status = 404;

            return $response;
        }

        $contactsBeneficiary = $beneficiary->contacts;

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando Contactos del Beneficiario ' . $beneficiary->name . '!',
            'data' => $contactsBeneficiary,
            'beneficiary' => $beneficiary->name,
        ];
        $response->status = 200;

        return $response;
    }


    public static function getFullBeneficiary()
    {
        $fullbeneficiary = DB::table('beneficiaries')
            ->leftJoin('medical_datas', 'beneficiaries.id', '=', 'medical_datas.beneficiary_id')
            ->select('beneficiaries.id', 'beneficiaries.name', 'beneficiaries.dni', 'medical_datas.id as medicaldata_id')
            ->get();
        $response = new stdClass();

        if ($fullbeneficiary->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Beneficiarios ni sus Datos Médicos!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Mostrando Datos del Beneficiario con Datos Médicos!',
            'data' => $fullbeneficiary,
        ];
        $response->status = 200;

        return $response;
    }


    public static function getFirstBeneficiary()
    {
        $beneficiary = Beneficiary::first();
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Contacto de Beneficiario Obtenido!',
            'data' => $beneficiary,
        ];
        $response->status = 200;

        return $response;
    }


    public static function ultimateBeneficiaryData()
    {
        $beneficiaries = DB::table('beneficiaries')
            ->join('beneficiary_contacts', 'beneficiaries.id', '=', 'beneficiary_contacts.beneficiary_id')
            ->join('contacts', 'beneficiary_contacts.contact_id', '=', 'contacts.id')
            ->leftJoin('medical_datas', 'beneficiaries.id', '=', 'medical_datas.beneficiary_id')
            ->leftJoin('addresses', 'beneficiaries.id', '=', 'addresses.addressable_id')
            ->leftJoin('phone_beneficiaries', 'beneficiaries.id', '=', 'phone_beneficiaries.beneficiary_id')
            ->select(
                'beneficiaries.name as beneficiary_name',
                'beneficiaries.first_surname as beneficiary_fs',
                'beneficiaries.second_surname as beneficiary_ss',
                'beneficiaries.birth_date',
                'beneficiaries.dni',
                'beneficiaries.social_security_number',
                'beneficiaries.rutine',
                'beneficiaries.gender',
                'beneficiaries.marital_status',
                'beneficiaries.beneficiary_type',
                'phone_beneficiaries.phone_number',
                'addresses.province',
                'addresses.locality',
                'addresses.postal_code',
                'addresses.street',
                'addresses.number',
                'medical_datas.allergies',
                'medical_datas.illnesses',
                'medical_datas.morning_medication',
                'medical_datas.afternoon_medication',
                'medical_datas.night_medication',
                'medical_datas.preferent_morning_calls_hour',
                'medical_datas.preferent_afternoon_calls_hour',
                'medical_datas.preferent_night_calls_hour',
                'medical_datas.emergency_room_on_town',
                'medical_datas.firehouse_on_town',
                'medical_datas.police_station_on_town',
                'medical_datas.outpatient_clinic_on_town',
                'medical_datas.ambulance_on_town',
                'contacts.name as contact_name',
                'contacts.first_surname as contact_fs',
                'contacts.second_surname as contact_ss',
                'contacts.contact_type',
            )
            ->get();
        $response = new stdClass();

        if ($beneficiaries->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron los Beneficiarios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de los Beneficiarios!',
            'data' => $beneficiaries,
        ];
        $response->status = 200;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Beneficiarios!',
        ];
        $response->status = 400;

        return $response;
    }
}
