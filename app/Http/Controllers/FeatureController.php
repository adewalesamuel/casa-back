<?php
namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use Illuminate\Support\Str;


class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$features = Feature::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $features = $features->get();
        } else {
            $features = $features->paginate();
        }

        $data = [
            'success' => true,
            'features' => $features
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
    public function store(StoreFeatureRequest $request)
    {
        $validated = $request->validated();

        $feature = new Feature;

        $feature->nom = $validated['nom'] ?? null;
		$feature->slug = Str::slug($validated['nom']);
		$feature->icon_img_url = $validated['icon_img_url'] ?? null;
		$feature->display_img_url = $validated['display_img_url'] ?? null;
		
        $feature->save();

        $data = [
            'success'       => true,
            'feature'   => $feature
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        $data = [
            'success' => true,
            'feature' => $feature
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $validated = $request->validated();

        $feature->nom = $validated['nom'] ?? null;
		$feature->icon_img_url = $validated['icon_img_url'] ?? null;
		$feature->display_img_url = $validated['display_img_url'] ?? null;
		
        $feature->save();

        $data = [
            'success'       => true,
            'feature'   => $feature
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {   
        $feature->delete();

        $data = [
            'success' => true,
            'feature' => $feature
        ];

        return response()->json($data);
    }
}