<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Products\ProductRequest;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\VSE;


class ProductController extends BaseController
{

    protected $product = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->middleware('auth:api');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->latest()->with('category', 'tags')->paginate(100);

        return $this->sendResponse($products, 'Product list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Products\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->product->create([
            'name' => $request->get('name'),
            // 'sku' => $request->get('sku'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),
            'stocks' => $request->get('stocks'),
            'criticalLevel' => $request->get('criticalLevel'),
            'authoredBy' => $request->get('authoredBy'),
            // 'serialno' => $request->get('serialno')

        ]);

        // update pivot table
        $tag_ids = [];
        foreach ($request->get('tags') as $tag) {
            $existingtag = Tag::whereName($tag['text'])->first();
            if ($existingtag) {
                $tag_ids[] = $existingtag->id;
            } else {
                $newtag = Tag::create([
                    'name' => $tag['text']
                ]);
                $tag_ids[] = $newtag->id;
            }
        }
        $product->tags()->sync($tag_ids);

        return $this->sendResponse($product, 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with(['category', 'tags'])->findOrFail($id);

        return $this->sendResponse($product, 'Product Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // dd($request);
        $product = $this->product->findOrFail($id);

        $product->update($request->all());

        // update pivot table
        $tag_ids = [];
        foreach ($request->get('tags') as $tag) {
            $existingtag = Tag::whereName($tag['text'])->first();
            if ($existingtag) {
                $tag_ids[] = $existingtag->id;
            } else {
                $newtag = Tag::create([
                    'name' => $tag['text']
                ]);
                $tag_ids[] = $newtag->id;
            }
        }
        $product->tags()->sync($tag_ids);

        return $this->sendResponse($product, 'Product Information has been updated');
    }

    public function updateAll(ProductRequest $request, $id)
    {
        // DB::table('purchases')->update(['order_details' => 'qwerty']);
        // Model::query()->update(['name' => 'qwerty']);

        // Want to Update the Product Attribute Table Stock
        $data = response()->validate('updatedOrder','required|json');
        $jsonArray = json_decode($data);
        
        $product = Product::where(['id' => $jsonArray['id']])->first();
        if($product){
            $stock = $product->stocks - $jsonArray->order_details->qty;
            $product->update(['stocks' => $stock]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $product = $this->product->findOrFail($id);

        $product->delete();

        return $this->sendResponse($product, 'Product has been Deleted');
    }

    public function upload(Request $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);

        return response()->json(['success' => true]);
    }

    public function orderproduct(Request $request){
        
        // //check mo muna if naipapasa ang data
        $order= $request->all();
        //dd($order);
        $countarray = count($order)-1;
        for($i=0;$i<=$countarray;$i++){ 
 
            $item=DB::table('products')
            ->where('id', [$order[$i]['id']])
            ->get();
                //maconvert dapat sa int string pa ata ito

            $NewQty=(int)$item[0]->stocks-(int)$order[$i]['qty'];
            $NewSold=(int)$item[0]->sold+(int)$order[$i]['qty'];

            DB::table('products')->where('id', [$order[$i]['id']])->update(
                ['stocks' => $NewQty, 'sold' => $NewSold]);

            // $updateStocks=product::updateOrCreate(['id' => $order[$i]['id']],[
            //     'stocks' => $NewQty, 'sold' => $NewSold
                
            // ]);
            // $updateStocks->save();
        }

        // $id = $request->id;
        // $qty = $request->qty;

        // for($i=0; i < count($id); $i++){
        //    $datahere = [
        //         'id' => $id[$i],
        //         // 'description' => ,
        //         // 'name' => ,
        //         // 'price' => ,
        //         // 'category' => ,
        //         'stocks' => $qty[$i]
        //    ];

        //    DB::table('products')->update($datahere);
        // }
        // Session::put('success', 'update successfull!');

        return response('Stocks Updated');
    }

    public function getProductsWithSerialNos(){
        $product = DB::table('products')
        // ->join('customers', 'customers.id', '=', 'purchases.customer_ID')
        ->join('serials', 'serials.ssku', '=', 'products.id')
   
        // ->where('purchases.ID', $request['ID'])
        ->get();
        return $product;
    }
}
