<?php

namespace App\Http\Controllers\api;

use App\Models\Network;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NetworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('Authorization:network-create', ['only' => 'create']);
        $this->middleware('Authorization:network-edit', ['only' => 'edit']);
        $this->middleware('Authorization:network-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Network $network)
    {
        return response($network->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO: Make create method for NetworkController
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: Make update method for NetworkController
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Make destroy method for NetworkController
    }
}
