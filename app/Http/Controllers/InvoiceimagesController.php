<?php

namespace App\Http\Controllers;

use App\Models\invoiceimages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class InvoiceimagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceimages = invoiceimages::all();
        return response()->json($invoiceimages);
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
        $image = $request->invoiceimg;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';
        \File::put(public_path(). './images/invoiceImgs/' . $imageName, base64_decode($image));
        
        DB::table('invoiceimages')->insert(['imgId' => $request->imageid, 'invoiceimg' => $imageName]); 
      
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoiceimages  $invoiceimages
     * @return \Illuminate\Http\Response
     */
    public function show(invoiceimages $invoiceimages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoiceimages  $invoiceimages
     * @return \Illuminate\Http\Response
     */
    public function edit(invoiceimages $invoiceimages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoiceimages  $invoiceimages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoiceimages $invoiceimages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoiceimages  $invoiceimages
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoiceimages $invoiceimages)
    {
        //
    }
}
