<?php

namespace App\Queries;

use App\Http\Resources\CallResource;
use App\Models\Call;
use Illuminate\Support\Facades\DB;
use stdClass;

class CallQuery
{
    public static function getAllCalls()
    {
        $calls = CallResource::collection(Call::latest()->get());
        $response = new stdClass();

        if ($calls->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Llamadas!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Llamadas Encontradas!',
            'data' => $calls,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createCall($request)
    {
        $call = Call::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Llamada Guardada!',
            'data' => new CallResource($call),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showCall($call)
    {
        $response = new stdClass();

        if (is_null($call)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Llamada!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Llamada Encontrada!',
            'data' => new CallResource($call),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateCall($request, $call)
    {
        $response = new stdClass();

        if (is_null($call)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Llamada para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $call->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Llamada Actualizada!',
            'data' => new CallResource($call),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteCall($call)
    {
        $response = new stdClass();

        if (is_null($call)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Llamada para Elimminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $call->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Llamada Eliminada!',
            'data' => $call,
        ];
        $response->status = 204;

        return $response;
    }


    public static function ultimateCallData()
    {
        $calls = DB::table('calls')
            ->join('users', 'calls.user_id', '=', 'users.id')
            ->join('beneficiaries', 'calls.beneficiary_id', '=', 'beneficiaries.id')
            ->select(
                'calls.date',
                'calls.time',
                'calls.duration',
                'calls.call_type',
                'calls.call_kind',
                'calls.turn',
                'calls.answered_call',
                'calls.observations',
                'calls.description',
                'calls.contacted_112',
                'users.name as user_name',
                'users.email',
                'users.role',
                'beneficiaries.name as beneficiary_name',
                'beneficiaries.first_surname',
                'beneficiaries.second_surname',
                'beneficiaries.dni',
            )
            ->get();
        $response = new stdClass();

        if ($calls->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron las Llamadas!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de las Llamadas!',
            'data' => $calls,
        ];
        $response->status = 200;

        return $response;
    }


    public static function ultimateIncomingCallData()
    {
        $incomingCalls = DB::table('calls')
            ->join('users', 'calls.user_id', '=', 'users.id')
            ->join('beneficiaries', 'calls.beneficiary_id', '=', 'beneficiaries.id')
            ->select(
                'calls.date',
                'calls.time',
                'calls.duration',
                'calls.call_type',
                'calls.call_kind',
                'calls.turn',
                'calls.answered_call',
                'calls.observations',
                'calls.description',
                'calls.contacted_112',
                'users.name as user_name',
                'users.email',
                'users.role',
                'beneficiaries.name as beneficiary_name',
                'beneficiaries.first_surname',
                'beneficiaries.second_surname',
                'beneficiaries.dni',
            )
            ->where('calls.call_kind', '=', 'incoming')
            ->get();
        $response = new stdClass();

        if ($incomingCalls->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron las Llamadas Entrantes!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de las Llamadas Entrantes!',
            'data' => $incomingCalls,
        ];
        $response->status = 200;

        return $response;
    }


    public static function ultimateOutgoingCallData()
    {
        $outGoingCalls = DB::table('calls')
            ->join('users', 'calls.user_id', '=', 'users.id')
            ->join('beneficiaries', 'calls.beneficiary_id', '=', 'beneficiaries.id')
            ->select(
                'calls.date',
                'calls.time',
                'calls.duration',
                'calls.call_type',
                'calls.call_kind',
                'calls.turn',
                'calls.answered_call',
                'calls.observations',
                'calls.description',
                'calls.contacted_112',
                'users.name as user_name',
                'users.email',
                'users.role',
                'beneficiaries.name as beneficiary_name',
                'beneficiaries.first_surname',
                'beneficiaries.second_surname',
                'beneficiaries.dni',
            )
            ->where('calls.call_kind', '=', 'outgoing')
            ->get();
        $response = new stdClass();

        if ($outGoingCalls->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron las Llamadas Salientes!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de las Llamadas Salientes!',
            'data' => $outGoingCalls,
        ];
        $response->status = 200;

        return $response;
    }


    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Llamadas!',
        ];
        $response->status = 400;

        return $response;
    }
}
