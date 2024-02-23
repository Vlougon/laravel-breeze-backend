<?php

namespace App\Queries;

use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReminderQuery
{
    public static function getAllReminders()
    {
        $reminders = ReminderResource::collection(Reminder::latest()->get());
        $response = new stdClass();

        if ($reminders->isEmpty()) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se Encontraron Recordatorios!',
                'data' => [],
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '¡Recordatorios Obtenidos!',
            'data' => $reminders,
        ];
        $response->status = 200;

        return $response;
    }


    public static function createReminder($request)
    {
        $reminder = Reminder::create($request->validated());
        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Recordatorio Añadido!',
            'data' => new ReminderResource($reminder),
        ];
        $response->status = 201;

        return $response;
    }


    public static function showReminder($reminder)
    {
        $response = new stdClass();

        if (is_null($reminder)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Recordatorio!',
            ];
            $response->status = 404;

            return $response;
        }

        $response->data = [
            'status' => 'success',
            'message' => '!Recordatorio: ' . $reminder->title . '!',
            'data' => new ReminderResource($reminder),
        ];
        $response->status = 200;

        return $response;
    }


    public static function updateReminder($request, $reminder)
    {
        $response = new stdClass();

        if (is_null($reminder)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Recordatorio para Actualizar!',
            ];
            $response->status = 404;

            return $response;
        }

        $reminder->update($request->validated());

        $response->data = [
            'status' => 'success',
            'message' => '¡Recordatorio Actualizado!',
            'data' => new ReminderResource($reminder),
        ];
        $response->status = 200;

        return $response;
    }


    public static function deleteReminder($reminder)
    {
        $response = new stdClass();

        if (is_null($reminder)) {
            $response->data = [
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Recordatorio para Eliminar!',
            ];
            $response->status = 404;

            return $response;
        }

        $reminder->delete();

        $response->data = [
            'status' => 'success',
            'message' => '¡Recordatorio Eliminado!',
            'data' => $reminder,
        ];
        $response->status = 204;

        return $response;
    }

    public static function ultimateReminderData()
    {
        $reminder = DB::table('reminders')
            ->join('users', 'reminders.user_id', '=', 'users.id')
            ->join('beneficiaries', 'reminders.beneficiary_id', '=', 'beneficiaries.id')
            ->select(
                'reminders.title',
                'reminders.start_date',
                'reminders.start_time',
                'reminders.end_date',
                'reminders.end_time',
                'reminders.repeat',
                'users.name',
                'users.email',
                'users.role',
                'beneficiaries.name',
            )
            ->get();

        $response = new stdClass();

        $response->data = [
            'status' => 'success',
            'message' => '¡Mostrando los Datos más Importantes de los Usuarios!',
            'data' => $reminder,
        ];
        $response->status = 200;

        return $response;
    }

    public static function errorHandler()
    {
        $response = new stdClass();

        $response->data = [
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Recordatorios!',
        ];
        $response->status = 400;

        return $response;
    }
}
