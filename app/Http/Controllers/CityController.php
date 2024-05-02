<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Support\Str;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$cities = City::with(['region', 'municipalities'])
        ->orderBy('nom', 'asc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $cities = $cities->get();
        } else {
            $cities = $cities->paginate();
        }

        $data = [
            'success' => true,
            'cities' => $cities
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
    public function store(StoreCityRequest $request)
    {
        $validated = $request->validated();

        $city = new City;

        $city->nom = $validated['nom'] ?? null;
		$city->slug = $validated['slug'] ?? null;
		$city->region_id = $validated['region_id'] ?? null;

        $city->save();

        $data = [
            'success'       => true,
            'city'   => $city
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $data = [
            'success' => true,
            'city' => $city
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $validated = $request->validated();

        $city->nom = $validated['nom'] ?? null;
		$city->slug = $validated['slug'] ?? null;
		$city->region_id = $validated['region_id'] ?? null;

        $city->save();

        $data = [
            'success'       => true,
            'city'   => $city
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        $data = [
            'success' => true,
            'city' => $city
        ];

        return response()->json($data);
    }
}
