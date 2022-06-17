<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Rules\Password;

class UserApiController extends Controller
{
    public function users()
    {
        $users = User::with('store')->get();
        return ResponseFormatter::success($users, 'Data semua user berhasil diambil');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', new Password],
            ]);

            User::create([
                'name' =>  $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $crendentials = request(['email', 'password']);
            if (!Auth::attempt($crendentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized',
                ], 'Authentication Failed', 500);
            }

            $user = User::with('store')->where('email', $request->email)->first();


            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function fetch(Request $request)
    {
        $user = User::with('store')->find($request->user());
        foreach ($user as $item) {
            if ($item->profile_photo_path != null) {
                $item->profile_photo_path = url(Storage::url($item->profile_photo_path));
            } else {
                url($item->profile_photo_path);
            }
        }
        return ResponseFormatter::success($user, 'Data profil berhasil diambil');
    }

    public function logout(Request $request)
    {

        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($request->$token, 'Token berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::with('store')->findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg'
            ]);
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'profile_photo_path' => $request->hasFile('profile_photo_path') ?  $request->file('profile_photo_path')->store('assets/user', 'public') : null,
            ]);

            return ResponseFormatter::success($user, 'Data berhasil diubah');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => $error,
            ], 'Data gagal diubah');
        }
    }

    public function delete($id)
    {
        try {
            $user = User::destroy($id);

            if (empty($user)) {
                return ResponseFormatter::error([
                    'message' => 'User tidak ditemukan',
                ], 'Not Found');
            }
            return ResponseFormatter::success($user, 'Data user berhasil dihapus');
        } catch (Exception $err) {
            return ResponseFormatter::error([
                'message' => $err,
            ], 'Data user gagal dihapus');
        }
    }
}
