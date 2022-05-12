<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendReservaEmail;


class MailController extends Controller
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

    public function index() {

        $user = auth()->user()->name;
         
         return view('mail.envio-email', ['user' => $user]);
 
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sendMail(Request $request)
    {
        $data = $request->all();
        $details = new \stdClass();
        $details->nome = $data['nome'];
        $details->email = $data['email'];

        try 
        {
            SendReservaEmail::dispatchNow($details);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        return back()->with('success', 'Email Enviado com sucesso!');
    }
}
