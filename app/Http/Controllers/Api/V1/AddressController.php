<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $user = auth()->user();
        
            if (auth()->user()->can('create', $user)) {
            $address = new Address(['address'=>$request->address,'latitude'=>$request->latitude,'longitude'=>$request->longitude]);


            $user->addresses()->save($address);

            return $address;
            }
            return response(['message' => 'Forbidden'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {

        if (auth()->user()->can('view', $address)) {
            return $address;
        }

        return response(['message' => 'Forbidden'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        if (auth()->user()->can('update', $address)) {
            $address->update($request->all());
            return response()->json($address, 200);
        }
        return response(['message' => 'Forbidden'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        if (auth()->user()->can('delete', $address)) {


            if ($address) {

                $address->delete();
                return response(['message' => 'Address Deleted'], 200);

            }
            return Response(['message' => 'Address Not Found'], 404);
           

        }

        return response(['message' => 'Forbidden'], 403);
    }
}
