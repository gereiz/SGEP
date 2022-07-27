<?php

namespace App\Http\Controllers;

use App\Models\Level_Access;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        $userId = auth()->user()->id;
        $user = auth()->user()->name;
        $acesso = user::where('id', $userId)->first();

        
        // Salva o nível de acesso na session
        $lvlAcesso = $acesso->levelAccess()->first()->level;  
        session(['nivel_acesso' => $lvlAcesso]);
        

        return view('home', ['user' => $user]);
    }
}
