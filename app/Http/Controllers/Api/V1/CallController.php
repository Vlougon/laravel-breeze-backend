<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CallRequest;
use App\Models\Call;
use App\Queries\CallQuery;

class CallController extends Controller
{
    public function index()
    {
        $response = CallQuery::getAllCalls();

        return response()->json($response->data, $response->status);
    }


    public function store(CallRequest $request)
    {
        $response = CallQuery::createCall($request);

        return response()->json($response->data, $response->status);
    }


    public function show(Call $call)
    {
        $response = CallQuery::showCall($call);

        return response()->json($response->data, $response->status);
    }


    public function update(CallRequest $request, Call $call)
    {
        $response = CallQuery::updateCall($request, $call);

        return response()->json($response->data, $response->status);
    }

    
    public function destroy(Call $call)
    {
        $response = CallQuery::deleteCall($call);

        return response()->json($response->data, $response->status);
    }


    public function ultimateCall()
    {
        $response = CallQuery::ultimateCallData();

        return response()->json($response->data, $response->status);
    }


    public function ultimateIncomingCall()
    {
        $response = CallQuery::ultimateIncomingCallData();

        return response()->json($response->data, $response->status);
    }


    public function ultimateOutgoingCall()
    {
        $response = CallQuery::ultimateOutgoingCallData();

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = CallQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
