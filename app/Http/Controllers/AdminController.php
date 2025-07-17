<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        return view('admin.dashboard', compact('userCount'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));
        return redirect()->route('admin.users')->with('success', 'User updated!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted!');
    }

    public function lokasi()
    {
        $lat = Setting::where('key', 'school_lat')->first()?->value;
        $long = Setting::where('key', 'school_long')->first()?->value;
        $radius = Setting::where('key', 'school_radius')->first()?->value;
        return view('admin.lokasi', compact('lat', 'long', 'radius'));
    }

    public function updateLokasi(Request $request)
    {
        Setting::updateOrCreate(['key' => 'school_lat'], ['value' => $request->lat]);
        Setting::updateOrCreate(['key' => 'school_long'], ['value' => $request->long]);
        Setting::updateOrCreate(['key' => 'school_radius'], ['value' => $request->radius]);
        return redirect()->route('admin.lokasi')->with('success', 'Lokasi sekolah diperbarui!');
    }

    public function createUser()
    {
        return view('admin.create_user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('admin.users')->with('success', 'User berhasil ditambah!');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('admin.login_form');
    }
}
