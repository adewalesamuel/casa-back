<?php

namespace App\Http\Controllers\Auth;

use App\Http\Auth as HttpAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ApiAdminAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");

        if (!Auth::guard('admin')->once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $admin = Admin::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "admin" => $admin,
            'token' => $admin->api_token,
        ];

        return response()->json($data);

    }

    public function logout(Request $request) {
        $admin = HttpAuth::getUser($request, HttpAuth::ADMIN);

        if (!$admin) {
            $data = [
                "error" => true,
                "message" => "Une erreure est survenue"
            ];

            return response()->json($data, 500);
        }

        $admin->api_token = Str::random(60);

        $admin->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }

}
