<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CallRequest;
use App\Http\Resources\CallResource;
use App\Models\Call;

class CallController extends Controller
{
    public function index()
    {
        $calls = CallResource::collection(Call::latest()->get());

        if ($calls->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se Encontraron Llamadas!',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Llamadas Encontradas!',
            'data' => $calls,
        ], 200);
    }


    public function store(CallRequest $request)
    {
        $call = Call::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Llamada Guardada!',
            'data' => new CallResource($call),
        ], 201);
    }

    public function show(Call $call)
    {
        if (is_null($call)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Llamada!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Llamada Encontrada!',
            'data' => new CallResource($call),
        ], 200);
    }

    public function update(CallRequest $request, Call $call)
    {
        if (is_null($call)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Llamada para Actualizar!',
            ], 404);
        }

        $call->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => '¡Llamada Actualizada!',
            'data' => new CallResource($call),
        ], 200);
    }

    public function destroy(Call $call)
    {
        if (is_null($call)) {
            return response()->json([
                'status' => 'failed',
                'message' => '¡No se ha encontrado la Llamada para Elimminar!',
            ], 404);
        }

        $call->delete();

        return response()->json([
            'status' => 'success',
            'message' => '¡Llamada Eliminada!',
            'data' => $call,
        ], 204);
    }

    public function error()
    {
        return response()->json([
            'status' => 'error',
            'message' => '¡Ha Ocurrido un Error con los Métodos del Controlador para Llamadas!',
        ], 400);
    }
}
