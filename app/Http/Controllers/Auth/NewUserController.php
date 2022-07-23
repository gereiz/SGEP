<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;

class NewUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function registerNewUser()
    {
        $user = auth()->user()->name;

        return view('auth.new_user', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $valdated = $request->validate([
            'email' => 'unique:users,email',
            'password_confirmation' => 'same:password'
        ]);

        try {
            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

        }
        catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }
        DB::commit();
        return back()->with('success', 'Novo usuário cadastrado!');
    }

}
