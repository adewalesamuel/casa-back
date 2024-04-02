<?php
namespace App\Http\Controllers;

use App\Models\FeatureProduct;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFeatureProductRequest;
use App\Http\Requests\UpdateFeatureProductRequest;
use Illuminate\Support\Str;


class FeatureProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$feature_products = FeatureProduct::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $feature_products = $feature_products->get();
        } else {
            $feature_products = $feature_products->paginate();
        }

        $data = [
            'success' => true,
            'feature_products' => $feature_products
        ];

        return response()->json($data);
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
    public function store(StoreFeatureProductRequest $request)
    {
        $validated = $request->validated();

        $feature_product = new FeatureProduct;

        $feature_product->feature_id = $validated['feature_id'] ?? null;
		$feature_product->product_id = $validated['product_id'] ?? null;
		$feature_product->quantite = $validated['quantite'] ?? null;
		
        $feature_product->save();

        $data = [
            'success'       => true,
            'feature_product'   => $feature_product
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeatureProduct  $feature_product
     * @return \Illuminate\Http\Response
     */
    public function show(FeatureProduct $feature_product)
    {
        $data = [
            'success' => true,
            'feature_product' => $feature_product
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeatureProduct  $feature_product
     * @return \Illuminate\Http\Response
     */
    public function edit(FeatureProduct $feature_product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeatureProduct  $feature_product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeatureProductRequest $request, FeatureProduct $feature_product)
    {
        $validated = $request->validated();

        $feature_product->feature_id = $validated['feature_id'] ?? null;
		$feature_product->product_id = $validated['product_id'] ?? null;
		$feature_product->quantite = $validated['quantite'] ?? null;
		
        $feature_product->save();

        $data = [
            'success'       => true,
            'feature_product'   => $feature_product
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeatureProduct  $feature_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeatureProduct $feature_product)
    {   
        $feature_product->delete();

        $data = [
            'success' => true,
            'feature_product' => $feature_product
        ];

        return response()->json($data);
    }
}