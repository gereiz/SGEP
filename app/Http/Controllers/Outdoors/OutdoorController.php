<?php

namespace App\Http\Controllers\Outdoors;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Outdoor;
use App\Models\Bairro;
use App\Models\Bisemana;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Cidade;
use DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\SendReservaEmail;
use App\Models\OutdoorTipo;
use Illuminate\Support\Facades\File;

class OutdoorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user()->name;
        $userId = auth()->user()->id;
        $paineis = Outdoor::orderBy('identificacao', 'asc')->paginate(8);
        $bairro = Bairro::all();
        $bisemanas = Bisemana::where('fim', '>', date("Y-m-d"))->get();
        $clientes = Cliente::all();
        
        dd($userId);

        return view('outdoors.OutdoorGrid',[
            'paineis' => $paineis,
            'user' => $user,
            'baiiro' => $bairro,
            'bisemanas' => $bisemanas,
            'clientes' => $clientes,
            
        ]);

    }

    public function addForm()
    {
        $painelTipo = OutdoorTipo::all();
        $user = auth()->user()->name;
        $bairros = Bairro::all();
        return view('outdoors.OutdoorForm', [
            'bairros' => $bairros,
            'user' => $user,
            'painelTipo' => $painelTipo
        ]);
    }

    public function editForm($id)
    {
        $painelTipo = OutdoorTipo::all();
        $user = auth()->user()->name;
        $bairros = Bairro::all();
        $painel = Outdoor::find($id);
        return view('outdoors.OutdoorForm',[
            'painel' => $painel,
            'bairros' => $bairros,
            'user' => $user,
            'painelTipo' => $painelTipo
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
            'referencia' => 'max:40',
            'lat' => 'min:10|max:40',
            'long' => 'min:10|max:40',
            'tipoPainel' => 'required'
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
            $painel->tipo = $request->tipoPainel;

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
            'identificacao' => 'required|string',
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
        $userId = auth()->user()->id;
        $reservado = $request->status == null ? "0" : $request->status;
        $clientes = Cliente::all();
        $bisemana = $request->bisemana == null ? "0" : $request->bisemana;
        $tipo = $request->tipo;
        $periodo = Bisemana::find($bisemana);
        $bisemanas = Bisemana::where('fim', '>', date("Y-m-d"))->get();
        $reserva= Reserva::all();
        $paineis = Outdoor::paginate(6);
        $paineisFiltro = Outdoor::all();
        $cidades = Cidade::all();
        $ids = $request->ids == null ? "0" : $request->ids;
        $id_cidades = $request->id_cidades == null ? "0" : $request->id_cidades;

        $reservadosQuery = DB::select(DB::raw("select outdoor_id from reservas where (bisemana_id = ". $bisemana. " or '". $bisemana. "' = '0')". "and user_id = ". $userId));
        $reservados = [];

        foreach($reservadosQuery as $rq)
        {
            $reservados[] = $rq->outdoor_id;
        }


        if($reservado == 2){
            $status = 'Reservados';

            $paineis = Outdoor::join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
            ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
            ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')
            ->whereRaw("(outdoors.id in (".$ids.") or '".$ids."' = 0)")
            ->whereIn("outdoors.id", $reservados)
            ->whereRaw("(cidades.id in (".$id_cidades.") or '".$id_cidades."' = 0)")
            ->paginate(6)
            ->appends('bisemana', request('bisemana'))
            ->appends('status', request('status'))
            ->appends('id_cidades', request('id_cidades'))
            ->appends('ids', request('ids'));
        }    
        elseif($reservado == 1) {
            $status = 'Disponíveis';

            $paineis = Outdoor::join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
            ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
            ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')
            ->whereRaw("(outdoors.id in (".$ids.") or '".$ids."' = 0)")
            ->whereNotIn("outdoors.id", $reservados)
            ->whereRaw("(cidades.id in (".$id_cidades.") or '".$id_cidades."' = 0)")
            ->paginate(6)
            ->appends('bisemana', request('bisemana'))
            ->appends('status', request('status'))
            ->appends('id_cidades', request('id_cidades'))
            ->appends('ids', request('ids'));
        } else {
            $status = 'Todos';

            $paineis = Outdoor::select("outdoors.*")
            ->whereRaw("(cidades.id in (".$id_cidades.") or ('".$id_cidades."' = 0))")
            ->whereRaw("(outdoors.id in (".$ids.") or ('".$ids."' = '0'))")
            ->join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
            ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
            ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')->paginate(6)
            ->appends('bisemana', request('bisemana'))->appends('status', request('status'))
            ->appends('id_cidades', request('id_cidades'))->appends('ids', request('ids'));
        }            

        $bisemana = $request->bisemana == null ? $bisemanas[0]->id : $request->bisemana;


       return view('outdoors.Outdoor_filtros',[
        'paineis' => $paineis,
        'user' => $user,
        'bisemanas' => $bisemanas,
        'reservado' => $reservado,
        'reserva' => $reserva,
        'clientes' => $clientes,
        'bisemana_id' => $bisemana,
        'reservado' => $reservado,
        'paineisFiltro' => $paineisFiltro,
        'cidades' => $cidades,
        'ids' => $ids,
        'id_cidades' => $id_cidades]); 
    }

    public function viewWithFilters(Request $request)
    {
        $user = auth()->user()->name;
        $userId = auth()->user()->id;
        $reservado = $request->status;
        $clientes = Cliente::all();
        $bisemana = $request->bisemana == null ? "0" : $request->bisemana;
        $ids = $request->out_ids == null ? [0] : $request->out_ids;
        $ids = implode(",",$ids);
        $id_cidades = $request->cidade_ids == null ? [0] : $request->cidade_ids;
        $id_cidades = implode(",",$id_cidades);
        $tipo = $request->tipo;
        $periodo = Bisemana::find($bisemana);
        $bisemanas = Bisemana::where('fim', '>', date("Y-m-d"))->get();
        $reserva= Reserva::all();

        $reservadosQuery = DB::select(DB::raw("select outdoor_id from reservas where (bisemana_id = ". $bisemana. " or '". $bisemana. "' = '0')". "and user_id = ". $userId));
        $reservados = [];

        foreach($reservadosQuery as $rq)
        {
            $reservados[] = $rq->outdoor_id;
        }


        if($reservado == 2){
            $status = 'Reservados'; 
            $paineisReport = Outdoor::select("outdoors.*")->join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
            ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
            ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')
            ->whereRaw("(outdoors.id in (".$ids.") or '".$ids."' = 0)")
            ->whereIn("outdoors.id", $reservados)
            ->whereRaw("(cidades.id in (".$id_cidades.") or '".$id_cidades."' = 0)")
            ->get();
        }    
        elseif($reservado == 1) {
            $status = 'Disponíveis';
            $paineisReport = Outdoor::select("outdoors.*")->join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
            ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
            ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')
            ->whereRaw("(outdoors.id in (".$ids.") or '".$ids."' = 0)")
            ->whereNotIn("outdoors.id", $reservados)
            ->whereRaw("(cidades.id in (".$id_cidades.") or '".$id_cidades."' = 0)")
            ->get();
        } else {
            $status = 'Todos';
            $paineisReport = Outdoor::select("outdoors.*")->whereRaw("(cidades.id in (".$id_cidades.") or ('".$id_cidades."' = 0))")
            ->whereRaw("(outdoors.id in (".$ids.") or ('".$ids."' = '0'))")
            ->join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
            ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
            ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')->get();
        }            

        if(count($paineisReport) == 0)
        {
            return response()->json(['success' => false, 'message' => 'Não há dados para os filtros selecionados']);
        }

        if(in_array($tipo,["pdf","enviar","wpp"]))
        {
            $data = [
                'paineis' => $paineisReport,
                'user' => $user,
                'status' => $status,
                'data' => $periodo->inicio.' a '.$periodo->fim,
            ];

            $pdf = PDF::loadView('outdoors.Outdoor_relatorio',$data);
            $pdf->render();
            $output = $pdf->output();
    
    
            File::ensureDirectoryExists(public_path('storage/pdf/'));
    
            $path = public_path('storage/pdf/'); 
    
            $fileName =  'outdoor'.date("His").'.pdf'; 
    
            $pdf->save($path . '/' . $fileName); 
            $pdf = public_path('storage/pdf/'.$fileName);
        }

        if($tipo === "enviar"){
        if(!env('MAIL_USERNAME') || !env('MAIL_PASSWORD'))
        return response()->json(['success' => false, 'message' => 'Verifique as configurações de SMTP']);
        try 
            {
                $details = new \stdClass();
                $details->nome = 'bryan';
                $details->email = 'bryanfranca2@hotmail.com';
                $details->attachment = 'storage/pdf/'.$fileName;
                SendReservaEmail::dispatchNow($details);
            }
            catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
    
            }
            unlink('pdf/'.$fileName);
            return back()->with('success', 'Email Enviado com sucesso!');
    
        }

        if($tipo == "pdf")
            return response()->download('storage/pdf/'.$fileName)->deleteFileAfterSend(true);

        if($tipo == "wpp")
        {
            $url = 'sgepequipe.com'.Storage::url('pdf/'.$fileName);
            return response()->json(['success' => true, 'message' => $url]);
        }
            
            
    }

    public function viewDisponiveis()
    {

        $user = auth()->user()->name;
        $paineis = Outdoor::paginate(8);
        $bisemanas = Bisemana::where('fim', '>', date("Y-m-d"))->get();


       return view('outdoors.Outdoor_disponivel',[
        'paineis' => $paineis,
        'user' => $user,
        'bisemanas' => $bisemanas,


        ]); 
    }

    public function reservaPainel(Request $request)
    {
        //dd($request->all());
        $userId = auth()->user()->id;


        $reserva = new Reserva();

        $reserva->cliente_id = $request->cliente;
        $reserva->outdoor_id = $request->outdoor;
        $reserva->bisemana_id = $request->bisemana; 
        $reserva->observacao = $request->observacoes;
        $reserva->user_id = $userId;

        // dd($userId);

        $reserva->save();

       return back()->with('success', 'Outdoor reservado com sucesso!');

    }

    public function cancelaReserva($id)
    {
        //dd($id);
        try  
        {
            DB::beginTransaction();
            Reserva::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }
        DB::commit();
        return back()->with('success', 'Reserva cancelada com sucesso!');
    }

    public function getIdentificacoes(Request $request)
    {
        $id_cidades = $request->cidade_ids == null ? [0] : $request->cidade_ids;
        $id_cidades = implode(",",$id_cidades);

        $ids = Outdoor::select('outdoors.*')->whereRaw("cidades.id in (".$id_cidades.") or '".$id_cidades."' = 0")
        ->join('bairros', 'bairros.id', '=', 'outdoors.bairro_id')
        ->join('regioes', 'regioes.id', '=', 'bairros.regiao_id')
        ->join('cidades', 'cidades.id', '=', 'regioes.cidade_id')->get();
        return $ids;
    }

}
