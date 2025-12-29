<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users', [
            'users' => User::with(['role', 'areaUnit'])->get(),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                Password::min(10)->mixedCase()->numbers()->symbols(),
            ],
            'role_id' => ['required'],
            'area_unit_id' => ['nullable'],
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return back();
    }
}
