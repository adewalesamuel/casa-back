<?php

namespace App\Http\Controllers\Auth;

use App\Http\Auth as HttpAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Repository\AccountRepository;
use Illuminate\Support\Facades\DB;

class ApiUserAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");

        if (!Auth::guard('user')->once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $user = User::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "user" => $user,
            "token" => $user->api_token
        ];

        return response()->json($data);
    }

    public function register(StoreUserRequest $request) {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $user = new User;
            $token =  Str::random(60);

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
            $user->is_company = $validated['is_company'] ?? false;
            $user->api_token = $token;

            $user->save();

            if ($user->isVendeur()) {
                AccountRepository::store([
                    'user_id' =>  $user->id,
                    'is_active' => true
                ]);
                $user->account;
            }

            // AdminMailNotificationJob::dispatchAfterResponse(
            //  new UserRegisterNotification($user));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            abort(400, $th->getMessage());
        }

        $data = [
            'success'  => true,
            'user'   => $user,
            'token' => $token
        ];

        return response()->json($data);
    }

    // public function forgot_password(ForgotPasswordRequest $request) {
    //     $validated = $request->validated();
    //     $status = Password::sendResetLink($validated);

    //     $data = [
    //         'status' => __($status)
    //     ];

    //     return response()->json($data, 200);
    // }

    // public function reset_password(ResetPasswordRequest $request) {
    //     $validated = $request->validated();

    //     $status = Password::reset(
    //         $validated,
    //         function (User $user, string $password) {
    //             $user->password = $password;
    //             $user->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     $data = [
    //         'status' => __($status)
    //     ];

    //     return response()->json($data, 200);
    // }

    public function logout(Request $request) {
        $user = HttpAuth::getUser($request, HttpAuth::USER);

        $user->api_token = Str::random(60);

        $user->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }

}
