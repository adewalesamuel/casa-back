<?php
namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Requests\StorePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use Illuminate\Support\Str;


class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$promo_codes = PromoCode::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $promo_codes = $promo_codes->get();
        } else {
            $promo_codes = $promo_codes->paginate();
        }

        $data = [
            'success' => true,
            'promo_codes' => $promo_codes
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
    public function store(StorePromoCodeRequest $request)
    {
        $validated = $request->validated();

        $promo_code = new PromoCode;

        $promo_code->code = $validated['code'] ?? null;
		$promo_code->expiration_date = $validated['expiration_date'] ?? null;
		$promo_code->type = $validated['type'] ?? null;
		$promo_code->user_id = $validated['user_id'] ?? null;
		
        $promo_code->save();

        $data = [
            'success'       => true,
            'promo_code'   => $promo_code
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromoCode  $promo_code
     * @return \Illuminate\Http\Response
     */
    public function show(PromoCode $promo_code)
    {
        $data = [
            'success' => true,
            'promo_code' => $promo_code
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromoCode  $promo_code
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoCode $promo_code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromoCode  $promo_code
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoCodeRequest $request, PromoCode $promo_code)
    {
        $validated = $request->validated();

        $promo_code->code = $validated['code'] ?? null;
		$promo_code->expiration_date = $validated['expiration_date'] ?? null;
		$promo_code->type = $validated['type'] ?? null;
		$promo_code->user_id = $validated['user_id'] ?? null;
		
        $promo_code->save();

        $data = [
            'success'       => true,
            'promo_code'   => $promo_code
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoCode  $promo_code
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $promo_code)
    {   
        $promo_code->delete();

        $data = [
            'success' => true,
            'promo_code' => $promo_code
        ];

        return response()->json($data);
    }
}