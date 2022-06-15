<?php

namespace App\Http\Controllers;

use App\Models\serial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SerialController extends Controller
{

    protected $serial = '';

    public function save_serial(){
        $serial = new Serial;
        $serial->ssku = request()->sku;
        $serial->serialnumber = request()->serialno;
        $serial->petsa = request()->petsa;
        $serial->authoredBy = request()->authoredBy;
        $serial->ser_createdBy = request()->ser_createdBy;
        $serial->ser_updatedAt = request()->ser_updatedAt;
        $serial->save();

        return $serial;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $serial = serial::all();
        // return response()->json($serial);
        $serial = DB::table('serials')
        ->join('products', 'products.id', '=', 'serials.ssku')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->get(['serials.*', 'products.category_id', 'categories.warranty', 'categories.name']);
        return response()->json($serial);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function show(serial $serial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function edit(serial $serial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, serial $serial, $id)
    {
        $serial = serial::findOrFail($id);

      $serial->update($request->all());
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function destroy(serial $serial, $id)
    {
        // $this->authorize('isAdmin');

        $serial = serial::findOrFail($id);

        $serial->delete();
        return response()->json($serial);
    }

    public function productsWithSerialNo(){
        $product = DB::table('serials')
        // ->join('customers', 'customers.id', '=', 'purchases.customer_ID')
        ->join('products', 'products.id', '=', 'serials.ssku')
   
        // ->where('purchases.ID', $request['ID'])
        ->get();
        return $product;
    }
}
