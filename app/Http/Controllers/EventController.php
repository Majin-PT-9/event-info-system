<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmPresenceRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Mail\EventInfoMail;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JetBrains\PhpStorm\NoReturn;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try{
            $events = Event::with(['address', 'users'])->get();
        }catch(\Exception $e){
            return response()->json(["message" => $e->getMessage()], 500);
        }
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $event = Event::create($request->validated());
        }catch (\Exception $e){
            return response()->json(["message" => $e->getMessage()],500);
        }
        return response()->json(["message" => "success", "id" => $event->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        //VM - Used two catch statements, the first as to not reveal the model being used, the second for other exceptions
        try{
            $event = Event::with(['address', 'users'])->findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response()->json(["message" => 'Event not found.'], 404);
        }catch (\Exception $e){
            return response()->json(["message" => $e->getMessage()],500);
        }
        return response()->json($event,200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $event = Event::findOrFail($id);
            $event->update($request->validated());
        }catch (ModelNotFoundException $e){
            return response()->json(["message" => 'Event not found.'], 404);
        }catch (\Exception $e){
            return response()->json(["message" => $e->getMessage()], 500);
        }
        return response()->json(["message" => "success", "id" => $event->id], 200);
    }
    /**
     * Confirm the presence of a User .
     */
    public function confirmPresence(ConfirmPresenceRequest $request,): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::findOrFail($request->user_id);
            $event = Event::findOrFail($request->event_id);
            $user->events()->updateExistingPivot($event->id, ['maybe' => true]);
        }catch (ModelNotFoundException $e){
            return response()->json(["message" => 'User or Event not found.'], 404);
        }catch (\Exception $e){
            return response()->json(["message" => $e->getMessage()], 500);
        }
        return response()->json(["message" => "success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
        }catch (ModelNotFoundException $e){
            return response()->json(["message" => 'Event not found.'], 404);
        }catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()],500);
        }
        return response()->json(["message" => 'Event deleted successfully'], 200);
    }
}
