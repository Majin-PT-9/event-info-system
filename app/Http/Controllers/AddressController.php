<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the Addresses.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try{
            $addresses = Address::with('events')->get();

        }catch(\Exception $e){
            return response()->json(["message" => $e->getMessage()]);
        }
        return response()->json($addresses);
    }
    /**
     * Store a newly created Address in storage.
     */
    public function store(StoreAddressRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $address = Address::create($request->validated());
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
        return response()->json(["message" => "success", "id" => $address->id], 201);
    }

    /**
     * Display the specified Address.
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        //VM - Used two catch statements as the model being used was returned in the message in case it did not find the record, the second for other exceptions
        try{
            $address = Address::with(['events'])->findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response()->json(["message" => 'Address not found.'], 404);
        }catch (\Exception $e){
            return response()->json(["message" => $e->getMessage()],500);
        }
        return response()->json($address,200);
    }

    /**
     * Update the Address resource in storage.
     */
    public function update(UpdateAddressRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $address = Address::findOrFail($id);
            $address->update($request->validated());
        }catch (ModelNotFoundException $e){
            return response()->json(["message" => 'Address not found.'], 404);
        }catch (\Exception $e){
            return response()->json(["message" => $e->getMessage()], 500);
        }
        return response()->json(["message" => "success", "id" => $address->id], 200);
    }
    /**
     * Remove the specified Address from storage.
     */
    public function destroy(Address $address): \Illuminate\Http\JsonResponse
    {
        try {
            //example of automatic object definition in the method
            $address->delete();
        }catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()],500);
        }
        return response()->json(["message" => 'Address deleted successfully'], 200);
    }
}
