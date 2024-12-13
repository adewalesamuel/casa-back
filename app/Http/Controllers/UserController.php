<?php
namespace App\Http\Controllers;

use App\Http\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$users = User::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $users = $users->get();
        } else {
            $users = $users->paginate();
        }

        $data = [
            'success' => true,
            'users' => $users
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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User;

        $user->nom = $validated['nom'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->password = $validated['password'] ?? null;
		$user->profile_img_url = $validated['profile_img_url'] ?? null;
		$user->genre = $validated['genre'] ?? null;
		$user->adresse = $validated['adresse'] ?? null;
		$user->numero_telephone = $validated['numero_telephone'] ?? null;
		$user->numero_whatsapp = $validated['numero_whatsapp'] ?? null;
		$user->numero_telegram = $validated['numero_telegram'] ?? null;
		$user->company_name = $validated['company_name'] ?? null;
		$user->company_logo_url = $validated['company_logo_url'] ?? null;
		$user->type = $validated['type'] ?? 'client';
		$user->api_token = Str::random(60);
		$user->is_active = $validated['is_active'] ?? true;
		$user->is_company = $validated['is_company'] ?? false;
		$user->id_card_url = $validated['id_card_url'] ?? false;

        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    public function profile_show(Request $request, User $user)
    {
        $user = Auth::getUser($request, Auth::USER);

        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->nom = $validated['nom'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->profile_img_url = $validated['profile_img_url'] ?? null;
		$user->genre = $validated['genre'] ?? null;
		$user->adresse = $validated['adresse'] ?? null;
		$user->numero_telephone = $validated['numero_telephone'] ?? null;
		$user->numero_whatsapp = $validated['numero_whatsapp'] ?? null;
		$user->numero_telegram = $validated['numero_telegram'] ?? null;
		$user->company_name = $validated['company_name'] ?? null;
		$user->company_logo_url = $validated['company_logo_url'] ?? null;
		$user->type = $validated['type'] ?? 'client';
		$user->is_active = $validated['is_active'] ?? true;
		$user->is_company = $validated['is_company'] ?? false;
		$user->id_card_url = $validated['id_card_url'] ?? false;

        if (isset($validated['password']))
            $user->password = $validated['password'];

        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];

        return response()->json($data);
    }

    public function profile_update(UpdateUserRequest $request)
    {
        $user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();

        $user->nom = $validated['nom'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->profile_img_url = $validated['profile_img_url'] ?? null;
		$user->genre = $validated['genre'] ?? null;
		$user->adresse = $validated['adresse'] ?? null;
		$user->numero_telephone = $validated['numero_telephone'] ?? null;
		$user->numero_whatsapp = $validated['numero_whatsapp'] ?? null;
		$user->numero_telegram = $validated['numero_telegram'] ?? null;
		$user->company_name = $validated['company_name'] ?? null;
		$user->company_logo_url = $validated['company_logo_url'] ?? null;
		$user->type = $validated['type'] ?? 'client';
		$user->is_company = $validated['is_company'] ?? false;
		$user->id_card_url = $validated['id_card_url'] ?? false;

        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();

        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    public function profile_destroy(Request $request)
    {
        $user = Auth::getUser($request, Auth::USER);

        $user->forceDelete();

        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }
}
