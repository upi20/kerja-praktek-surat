<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use League\Config\Exception\ValidationException;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function fetch(Request $request)
    {
        $profile = $request->user();
        $profile->roles;
        $rt = $profile->penduduk->rt;
        $rw = $rt->rw;

        unset($profile->penduduk->rt);
        unset($rt->rw);

        $profile->penduduk->rt = $rt;
        $profile->penduduk->rw = $rw;


        return ResponseFormatter::success(['user' => $profile], 'Data profile user berhasil diambil');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required|string',
                'password' => 'required'
            ]);

            $credentials = request(['nik', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = User::with(['roles', 'penduduk'])->where('nik', $request->nik)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated');
        } catch (ValidationException $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', new Password]
            ]);

            User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('nik', $request->nik)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch (ValidationException $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'old_password' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);

            $user = Auth::user();
            if (!Hash::check($request->old_password, $user->password, [])) {
                throw new \Exception('Password lama yang anda masukan salah');
            }

            $user->password = Hash::make($request->password);
            $user->save();
            return ResponseFormatter::success(['user' => $user], 'Password berhasil diubah');
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }
}
