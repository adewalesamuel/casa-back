<?php
namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Support\Str;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$favorites = Favorite::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $favorites = $favorites->get();
        } else {
            $favorites = $favorites->paginate();
        }

        $data = [
            'success' => true,
            'favorites' => $favorites
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
    public function store(StoreFavoriteRequest $request)
    {
        $validated = $request->validated();

        $favorite = new Favorite;

        $favorite->product_id = $validated['product_id'] ?? null;
		$favorite->user_id = $validated['user_id'] ?? null;
		
        $favorite->save();

        $data = [
            'success'       => true,
            'favorite'   => $favorite
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        $data = [
            'success' => true,
            'favorite' => $favorite
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        $validated = $request->validated();

        $favorite->product_id = $validated['product_id'] ?? null;
		$favorite->user_id = $validated['user_id'] ?? null;
		
        $favorite->save();

        $data = [
            'success'       => true,
            'favorite'   => $favorite
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {   
        $favorite->delete();

        $data = [
            'success' => true,
            'favorite' => $favorite
        ];

        return response()->json($data);
    }
}