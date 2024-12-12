<?php
namespace App\Http\Controllers;

use App\Http\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\View;
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\Product;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$views = View::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $views = $views->get();
        } else {
            $views = $views->paginate();
        }

        $data = [
            'success' => true,
            'views' => $views
        ];

        return response()->json($data);
    }

    public function user_index(Request $request)
    {
        $auth_user = Auth::getUser($request, Auth::USER);

        $user_product_id_list = $auth_user->products()->pluck(['id'])->toArray();
    	$views = View::whereIn('product_id', $user_product_id_list)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $views = $views->get();
        } else {
            $views = $views->paginate();
        }

        $data = [
            'success' => true,
            'views' => $views
        ];

        return response()->json($data);
    }

    public function product_index(Request $request, Product $product) {
        $data = [
            'success' => true,
            'views' => $product->views()->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data, 200);
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
    public function store(StoreViewRequest $request)
    {
        $validated = $request->validated();

        $view = new View;

        $view->product_id = $validated['product_id'] ?? null;
		$view->user_id = $validated['user_id'] ?? null;

        $view->save();

        $data = [
            'success'       => true,
            'view'   => $view
        ];

        return response()->json($data);
    }

    public function user_store(StoreViewRequest $request)
    {
        $auth_user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();

        $view = new View;

        $view->product_id = $validated['product_id'] ?? null;
		$view->user_id = $validated['user_id'] ?? null;

        $view->user_id = $auth_user->id;

        $view->save();

        $data = [
            'success'       => true,
            'view'   => $view
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function show(View $view)
    {
        $data = [
            'success' => true,
            'view' => $view
        ];

        return response()->json($data);
    }

    public function user_show(Request $request, View $view)
    {
        $auth_user = Auth::getUser($request, Auth::USER);

        $data = [
            'success' => true,
            'view' => View::where('id', $view->id)
            ->where('user_id', $auth_user->id)->firstOrFail()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        $validated = $request->validated();

        $view->product_id = $validated['product_id'] ?? null;
		$view->user_id = $validated['user_id'] ?? null;

        $view->save();

        $data = [
            'success'       => true,
            'view'   => $view
        ];

        return response()->json($data);
    }

    public function user_update(UpdateViewRequest $request, View $view)
    {
        $auth_user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();
        $view = View::where('id', $view->id)
        ->where('user_id', $auth_user->id)->firstOrFail();

        $view->product_id = $validated['product_id'] ?? null;
		$view->user_id = $validated['user_id'] ?? null;

        $view->user_id = $auth_user->id;

        $view->save();

        $data = [
            'success'       => true,
            'view'   => $view
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function destroy(View $view)
    {
        $view->delete();

        $data = [
            'success' => true,
            'view' => $view
        ];

        return response()->json($data);
    }

    public function user_destroy(Request $request, View $view)
    {
        $auth_user =  Auth::getUser($request, Auth::USER);
        $view = View::where('id', $view->id)
        ->where('user_id', $auth_user->id)->firstOrFail();

        $view->delete();

        $data = [
            'success' => true,
            'view' => $view
        ];

        return response()->json($data);
    }
}
