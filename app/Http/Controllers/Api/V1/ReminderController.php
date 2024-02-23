<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use App\Queries\ReminderQuery;

class ReminderController extends Controller
{
    public function index()
    {
        $response = ReminderQuery::getAllReminders();

        return response()->json($response->data, $response->status);
    }


    public function store(ReminderRequest $request)
    {
        $response = ReminderQuery::createReminder($request);

        return response()->json($response->data, $response->status);
    }


    public function show(Reminder $reminder)
    {
        $response = ReminderQuery::showReminder($reminder);

        return response()->json($response->data, $response->status);
    }


    public function update(ReminderRequest $request, Reminder $reminder)
    {
        $response = ReminderQuery::updateReminder($request, $reminder);

        return response()->json($response->data, $response->status);
    }


    public function destroy(Reminder $reminder)
    {
        $response = ReminderQuery::deleteReminder($reminder);

        return response()->json($response->data, $response->status);
    }


    public function ultimateReminder()
    {
        $response = ReminderQuery::ultimateReminderData();

        return response()->json($response->data, $response->status);
    }


    public function error()
    {
        $response = ReminderQuery::errorHandler();

        return response()->json($response->data, $response->status);
    }
}
