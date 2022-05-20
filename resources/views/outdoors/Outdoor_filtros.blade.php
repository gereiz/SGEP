@extends('layouts.layout-2')

<link rel="stylesheet" href="{{asset('assets/css/paineis.css')}}"> 

@section('content')

<header>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</header>
<div class="card mb-4">
    <div class="row no-gutters">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card-body" id="dados_empresa">
                <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-label">Bisemana</label>
                    <select name="bisemana_id" id="bisemana_id" class="form-control">
                        @foreach($bisemanas as $b)
                            <option value="{{$b->id}}"> {{$b->inicio}} até {{$b->fim}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label">Status</label>
                    <select name="reservado" id="reservado" class="form-control">
                        <option value=0> Reservado </option>
                        <option value=1> Disponível </option>
                    </select>
                </div>
                    <button name="filtrar" id="filtrar" class="btn btn-primary" style="margin-top:17px; margin-bottom:17px;">Filtrar</button>
                </div>
                    <div id="outdoors">
                <div>
            </div>
        </div>
    </div>
</div>
<br>




<script>
    $(document).ready(function () 
    {
        $('#filtrar').on('click',function()
        {
            bisemana = $('#bisemana_id').val();
            status = $('#status').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('view_outdoor_filter') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    bisemana: bisemana,
                    status: status
                },
                success: function(resposta){
                    $('#outdoors').html(resposta);
                }
            });

        });
                
    });
            

</script>
@endsection