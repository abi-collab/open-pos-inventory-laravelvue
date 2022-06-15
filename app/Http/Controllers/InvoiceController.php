<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// class InvoiceController implements JsonSerializable {


//     public function __construct($invoice) {
//         $this->$invoice = $invoice;
//     }

//     public function jsonSerialize()
//     {
//         return $this->$invoice;
//     }
// }

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $purchase = invoice::all();
        // return $purchase;

        // $purchase = DB::table('purchases')->get();
        // return $purchase;

        // $purchase = invoice::orderBy('created_at', 'desc')->get();
        // return response()->json($purchase);
        $purchase = invoice::all();
        return response()->json($purchase);

        // return error_log($purchase);
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
    
    //    $purchase = invoice::create($request->all());
    //     return $purchase;

    $purchase = invoice::create($request->all());
    
    $data=$request->order_details;
    
    DB::table('purchase_details')->insert($data); 
  
    return $purchase;

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(invoice $invoice)
    {
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }

    public function getAll(){
        $search=DB::table('purchases')
        // ->join('customers', 'customers.id', '=', 'purchases.customer_ID')
        ->join('purchase_details', 'purchase_details.order_id', '=', 'purchases.ID')
        ->join('products', 'products.id', '=', 'purchase_details.product_ID')
        // ->where('purchases.ID', $request['ID'])
        ->get();
        return $search;
    }


    ///////////////////////////////////////////////////////////////////////

    public function getOrderSpecific(Request $request){
        $search=DB::table('purchases')->latest()
        // ->join('customers', 'customers.id', '=', 'purchases.customer_ID')
        // ->join('purchase_details', 'purchase_details.order_id', '=', 'purchases.ID')
        // ->join('products', 'products.id', '=', 'purchase_details.product_ID')
        // ->where('purchases.ID', $request['ID'])
        ->get();
        return $search;
    }

    public function getPurchaseDetails(Request $request){
        $search=DB::table('purchase_details')
        // ->join('purchases', 'purchases.ID', '=', 'purchase_details.order_id')
        // ->join('customers', 'customers.id', '=', 'purchases.customer_ID')
        // ->join('purchase_details', 'purchase_details.order_id', '=', 'purchases.ID')
        ->join('products', 'products.id', '=', 'purchase_details.product_ID')
        // ->where('purchases.ID', $request['ID'])
        ->get();
        return $search;
    }

    // public function getOrderSpecific(Request $request){
    //     $search=DB::table('purchases')
    //     ->join('customers', 'customers.id', '=', 'purchases.customer_ID')
    //     ->join('purchase_details', 'purchase_details.order_id', '=', 'purchases.ID')
    //     ->join('products', 'products.id', '=', 'purchase_details.product_ID')
    //     ->where('purchases.ID', $request['ID'])
    //     ->get();
    //     return $search;
    // }


    // search for date filters of transactions
    // public function search(){
    //     $query = DB::table('purchases')->select()->get();
    //     dd($query);
    // }
}
