<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = ReminderResource::collection(Reminder::latest()->get());

        if ($reminders->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Recordatorios!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Recordatorios Obtenidos!',
            'data' => $reminders,
        ], 200);
    }

    public function store(ReminderRequest $request)
    {
        $reminder = Reminder::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Recordatorio Añadido!',
            'data' => new ReminderResource($reminder),
        ], 201);
    }

    public function show(Reminder $reminder)
    {
        if (is_null($reminder)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Recordatorio!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '!Recordatorio: ' . $reminder->title . '!',
            'data' => new ReminderResource($reminder),
        ], 200);
    }

    public function update(ReminderRequest $request, Reminder $reminder)
    {
        if (is_null($reminder)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado el Recordatorio para Actualizar!',
            ], 404);
        }

        $reminder->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => '¡Recordatorio Actualizado!',
            'data' => new ReminderResource($reminder),
        ], 200);
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Recordatorio Eliminado!',
            'data' => $reminder,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Recordatorios!',
        ], 400);
    }
}
