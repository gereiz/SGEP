<?php

namespace App\Http\Controllers\Outdoors;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Outdoor;
use App\Models\Bairro;
use App\Models\Bisemana;
use App\Models\Reserva;
use App\Models\Cliente;
use DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\SendReservaEmail;

class OutdoorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user()->name;
        $paineis = Outdoor::orderBy('identificacao', 'asc')->paginate(8);
        $bairro = Bairro::all();
        $bisemanas = Bisemana::all();
        $clientes = Cliente::all();


        return view('outdoors.OutdoorGrid',[
            'paineis' => $paineis,
            'user' => $user,
            'baiiro' => $bairro,
            'bisemanas' => $bisemanas,
            'clientes' => $clientes
        ]);

    }

    public function addForm()
    {
        $user = auth()->user()->name;
        $bairros = Bairro::all();
        return view('outdoors.OutdoorForm', [
            'bairros' => $bairros,
            'user' => $user
        ]);
    }

    public function editForm($id)
    {
        $user = auth()->user()->name;
        $bairros = Bairro::all();
        $painel = Outdoor::find($id);
        return view('outdoors.OutdoorForm',[
            'painel' => $painel,
            'bairros' => $bairros,
            'user' => $user
        ]);
    }

    public function viewForm($id)
    { 
        $user = auth()->user()->name;
        $painel = Outdoor::find($id);
        //dd($painel->image_url);
        //dd(json_encode($painel->image_url));
        return view('outdoors.OutdoorViewForm',[
            'painel' => $painel,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'identificacao' => 'min:1|max:10',
            'bairro_id' => 'required',
            'logradouro' => 'min:5|max:40',
            'numero' => 'min:2|max:10',
            'posicao' => 'min:3|max:10',
            'cadan' => 'min:6|max:6',
            'dimensao' => 'min:5|max:10',
            'dimensao_lona' => 'min:5|max:10',
            'referencia' => 'min:5|max:40',
            'lat' => 'min:10|max:40',
            'long' => 'min:10|max:40'
            ]);

        //dd($request->all());
        $this->validaForm($request);
        
        try {

            DB::beginTransaction();

            $painel = new Outdoor();
            if(Outdoor::find($request->id))
                $painel = Outdoor::find($request->id);

            $painel->identificacao = $request->identificacao; 
            $painel->bairro_id = $request->bairro_id;
            $painel->logradouro = $request->logradouro;
            $painel->numero = $request->numero;
            $painel->posicao = $request->posicao;
            $painel->cadan = $request->cadan;
            $painel->dimensao = $request->dimensao;
            $painel->dimensao_lona = $request->dimensao_lona;
            $painel->ponto_referencia = $request->referencia;
            $painel->latitude = $request->lat;
            $painel->longitude = $request->long;

            //dd($request->cadan);

            $painel->save(); 

            if($request->id != 0 && $painel->image_url == null)
            {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            }


            if($request->image != null)
            {
                $folder = $painel->id."/";
                $safeName = $painel->id.'.'.$request->image->extension();
                $destinationPath = Storage::disk('outdoorImages')->path('');
    
                if (!is_dir($destinationPath. $folder)) {
                    // dir doesn't exist, make it
                    mkdir($destinationPath. $folder);
                }
    
                $request->image->move($destinationPath.$folder, $painel->id.'.'.$request->image->extension());
    
                $painel->image_url = 'outdoorImages/'.$folder.$safeName;
            }

            $painel->save();

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }

        DB::commit();
        if($request->id != 0)
            return back()->with('success', 'Registro Editado com sucesso!');

        return back()->with('success', 'Registro cadastrado com sucesso!');
    }

    public function deleteOutdoor($id)
    {
        try  
        {
            DB::beginTransaction();
            Outdoor::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }
        DB::commit();
        return back()->with('success', 'Registro Deletado com sucesso!');

    }

    public function validaForm(Request $request)
    {

        $customMessages = [
            'identificacao.required' => 'A Identificação deve ser informada',
            'bairro_id.required' => 'O Bairro deve ser informado',
            'logradouro.required' => 'O Logradouro deve ser informado',
            //'numero.required' => 'O Número deve ser informado',
            'posicao.required' => 'A Posição deve ser informada',
            'dimensao.required' => 'A Dimensão deve ser informada',
            'dimensao_lona.required' => 'A Dimensão da Lona deve ser informada',
            'ponto_referencia.required' => 'O Ponto de referência deve ser informado',
            'latitude.required' => 'A Latitude deve ser informada',
            'longitude.required' => 'A Longitude deve ser informada',
            //'image.required' => 'A Imagem deve ser informada',
        ];


        $this->validate($request, [
            'identificacao' => 'required|integer',
            'bairro_id' => 'required|integer',
            'logradouro' => 'required|string',
           // 'numero' => 'required|integer',
            'posicao' => 'required|string',
            'dimensao' => 'required|string',
            'dimensao_lona' => 'required|string',
            'referencia' => 'required|string',
            'lat' => 'required|string',
            'long' => 'required|string',
        ], $customMessages);

        
    }

    public function viewforFilters(Request $request)
    {

        $user = auth()->user()->name;
        $bisemanas = Bisemana::all();
        


       return view('outdoors.Outdoor_filtros',[
        'user' => $user,
        'bisemanas' => $bisemanas ]); 
    }

    public function viewWithFilters(Request $request)
    {

        $user = auth()->user()->name;
        $reservado = $request->status;
        $bisemana = $request->bisemana;
        $tipo = $request->tipo;
        $periodo = Bisemana::find($bisemana);
        $bisemanas = Bisemana::all();
        $clientes = Cliente::all();

        if($reservado == 1){
            $status = 'Reservados';
            $paineis = Outdoor::whereIn('id', DB::table('reservas')->where('bisemana_id',$bisemana)->pluck('outdoor_id'));
        }    
        else{
            $status = 'Disponíveis';
            $paineis = Outdoor::whereNotIn('id', DB::table('reservas')->where('bisemana_id',$bisemana)->pluck('outdoor_id'));
        }            

        $data = [
            'paineis' => $paineis->get(),
            'user' => $user,
            'status' => $status,
            'data' => $periodo->inicio.' a '.$periodo->fim,
        ];

        
        if($tipo === "pdf")
        {
            $pdf = PDF::loadView('outdoors.Outdoor_relatorio',$data);
            $pdf->render();
            $output = $pdf->output();

            //$data = $request->all();
            $details = new \stdClass();
            $details->nome = 'bryan';
            $details->email = 'bryanfranca2@hotmail.com';
            $details->attachment = $output;

            try 
            {
                SendReservaEmail::dispatchNow($details);
            }
            catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
    
            }
            return back()->with('success', 'Email Enviado com sucesso!');

            file_put_contents('Invoice.pdf', $output);
        }

       return view('outdoors.Outdoor_filtrado',[
        'paineis' => $paineis->paginate(5),
        'user' => $user,
        'bisemanas' => $bisemanas,
        'clientes' => $clientes]); 
    }

    public function viewDisponiveis()
    {

        $user = auth()->user()->name;
        $paineis = Outdoor::paginate(8);
        $bisemanas = Bisemana::all();


       return view('outdoors.Outdoor_disponivel',[
        'paineis' => $paineis,
        'user' => $user,
        'bisemanas' => $bisemanas,


        ]); 
    }

    public function reservaPainel(Request $request)
    {
        //dd($request->all());


       $reserva = new Reserva();

       $reserva->cliente_id = $request->cliente;
       $reserva->outdoor_id = $request->outdoor;
       $reserva->bisemana_id = $request->bisemana;
       $reserva->observacao = $request->observacoes;

       $reserva->save();

       return back()->with('success', 'Outdoor reservado com sucesso!');

    }

}
