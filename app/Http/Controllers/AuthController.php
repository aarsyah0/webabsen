<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);
        $user = \App\Models\User::where('nisn', $request->nisn)->first();
        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'NISN atau password salah'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (\Auth::attempt($credentials)) {
            $user = \Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                \Auth::logout();
                return back()->withErrors(['email' => 'Bukan akun admin']);
            }
        }
        return back()->withErrors(['email' => 'Login gagal']);
    }
}
