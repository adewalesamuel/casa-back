<?php
namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use Illuminate\Support\Str;


class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$regions = Region::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $regions = $regions->get();
        } else {
            $regions = $regions->paginate();
        }

        $data = [
            'success' => true,
            'regions' => $regions
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
    public function store(StoreRegionRequest $request)
    {
        $validated = $request->validated();

        $region = new Region;

        $region->nom = $validated['nom'] ?? null;
		$region->slug = $validated['slug'] ?? null;
		
        $region->save();

        $data = [
            'success'       => true,
            'region'   => $region
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        $data = [
            'success' => true,
            'region' => $region
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        $validated = $request->validated();

        $region->nom = $validated['nom'] ?? null;
		$region->slug = $validated['slug'] ?? null;
		
        $region->save();

        $data = [
            'success'       => true,
            'region'   => $region
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {   
        $region->delete();

        $data = [
            'success' => true,
            'region' => $region
        ];

        return response()->json($data);
    }
}