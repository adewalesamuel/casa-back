<?php
namespace App\Http\Controllers;

use App\Http\Auth;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$products = Product::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $products = $products->get();
        } else {
            $products = $products->paginate();
        }

        $data = [
            'success' => true,
            'products' => $products
        ];

        return response()->json($data);
    }

    public function category_index(Request $request, Category $category)
    {
    	$products = Product::where('category_id', $category->id)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $products = $products->get();
        } else {
            $products = $products->paginate();
        }

        $data = [
            'success' => true,
            'products' => $products
        ];

        return response()->json($data);
    }

    public function user_index(Request $request)
    {
        $user = Auth::getUser($request, Auth::USER);

    	$products = Product::where('user_id', $user->id)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $products = $products->get();
        } else {
            $products = $products->paginate();
        }

        $data = [
            'success' => true,
            'products' => $products
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
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = new Product;

        $product->nom = $validated['nom'] ?? null;
		$product->slug = Str::slug($validated['slug']);
		$product->description = $validated['description'] ?? null;
		$product->prix = $validated['prix'] ?? null;
		$product->type_paiement = $validated['type_paiement'] ?? null;
		$product->type = $validated['type'] ?? null;
		$product->display_img_url_list = $validated['display_img_url_list'] ?? null;
		$product->images_url_list = $validated['images_url_list'] ?? null;
		$product->category_id = $validated['category_id'] ?? null;
		$product->municipality_id = $validated['municipality_id'] ?? null;
		$product->user_id = $validated['user_id'] ?? null;

        $product->save();

        $data = [
            'success'       => true,
            'product'   => $product
        ];

        return response()->json($data);
    }

    public function user_store(StoreProductRequest $request)
    {
        $user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();

        $product = new Product;

        $product->nom = $validated['nom'] ?? null;
		$product->slug = Str::slug($validated['slug']);
		$product->description = $validated['description'] ?? null;
		$product->prix = $validated['prix'] ?? null;
		$product->type_paiement = $validated['type_paiement'] ?? null;
		$product->type = $validated['type'] ?? null;
		$product->display_img_url_list = $validated['display_img_url_list'] ?? null;
		$product->images_url_list = $validated['images_url_list'] ?? null;
		$product->category_id = $validated['category_id'] ?? null;
		$product->municipality_id = $validated['municipality_id'] ?? null;
		$product->user_id = $user->id;

        $product->save();

        $data = [
            'success'       => true,
            'product'   => $product
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data = [
            'success' => true,
            'product' => $product
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->nom = $validated['nom'] ?? null;
		$product->slug = Str::slug($validated['slug']);
		$product->description = $validated['description'] ?? null;
		$product->prix = $validated['prix'] ?? null;
		$product->type_paiement = $validated['type_paiement'] ?? null;
		$product->type = $validated['type'] ?? null;
		$product->display_img_url_list = $validated['display_img_url_list'] ?? null;
		$product->images_url_list = $validated['images_url_list'] ?? null;
		$product->category_id = $validated['category_id'] ?? null;
		$product->municipality_id = $validated['municipality_id'] ?? null;
		$product->user_id = $validated['user_id'] ?? null;

        $product->save();

        $data = [
            'success'       => true,
            'product'   => $product
        ];

        return response()->json($data);
    }

    public function user_update(UpdateProductRequest $request, Product $product)
    {
        $user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();

        if ($user->id !== $product->user_id) {
            $data = [
                'error' => true,
                'message' => 'forbidden'
            ];

            return response()->json($data, 403);
        }

        $product->nom = $validated['nom'] ?? null;
		$product->slug = Str::slug($validated['slug']);
		$product->description = $validated['description'] ?? null;
		$product->prix = $validated['prix'] ?? null;
		$product->type_paiement = $validated['type_paiement'] ?? null;
		$product->type = $validated['type'] ?? null;
		$product->display_img_url_list = $validated['display_img_url_list'] ?? null;
		$product->images_url_list = $validated['images_url_list'] ?? null;
		$product->category_id = $validated['category_id'] ?? null;
		$product->municipality_id = $validated['municipality_id'] ?? null;
		$product->user_id = $user->id;

        $product->save();

        $data = [
            'success'       => true,
            'product'   => $product
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $data = [
            'success' => true,
            'product' => $product
        ];

        return response()->json($data);
    }

    public function user_destroy(Request $request, Product $product)
    {
        $user = Auth::getUser($request, Auth::USER);

        if ($product->user_id !== $user->id ) {
            $data = [
                'error' => true,
                'message' => 'forbidden'
            ];

            return response()->json($data, 403);
        }

        $product->delete();

        $data = [
            'success' => true,
            'product' => $product
        ];

        return response()->json($data);
    }
}
