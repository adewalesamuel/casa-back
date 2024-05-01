<?php
namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMunicipalityRequest;
use App\Http\Requests\UpdateMunicipalityRequest;
use Illuminate\Support\Str;


class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$municipalities = Municipality::with(['city'])
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $municipalities = $municipalities->get();
        } else {
            $municipalities = $municipalities->paginate();
        }

        $data = [
            'success' => true,
            'municipalities' => $municipalities
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
    public function store(StoreMunicipalityRequest $request)
    {
        $validated = $request->validated();

        $municipality = new Municipality;

        $municipality->nom = $validated['nom'] ?? null;
		$municipality->slug = $validated['slug'] ?? null;
		$municipality->city_id = $validated['city_id'] ?? null;

        $municipality->save();

        $data = [
            'success'       => true,
            'municipality'   => $municipality
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        $data = [
            'success' => true,
            'municipality' => $municipality
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipality $municipality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMunicipalityRequest $request, Municipality $municipality)
    {
        $validated = $request->validated();

        $municipality->nom = $validated['nom'] ?? null;
		$municipality->slug = $validated['slug'] ?? null;
		$municipality->city_id = $validated['city_id'] ?? null;

        $municipality->save();

        $data = [
            'success'       => true,
            'municipality'   => $municipality
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();

        $data = [
            'success' => true,
            'municipality' => $municipality
        ];

        return response()->json($data);
    }
}
