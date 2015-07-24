@extends('layouts.sidebar_lavado')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
        <div class="panel-heading"><h3 align="center">Control de calidad y planilla de servicio de lavado [#{{$id}}] </h3><h6 align="center"> {{ Auth::user()->usr_name }} <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>
          </h6></div><br>

                              @if (count($errors) > 0)
                                <div class="alert alert-danger" text-center>
                                  <strong>Oops!</strong> Ocurrio algun problema con su Ingreso.<br><br>
                                  <ul>
                                    @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                    @endforeach
                                  </ul>
                                </div>
                              @endif


                            {!!Form::open(['route'=>['registro.store'], 'method'=> 'POST'])!!}
                           <div>
                           @include('lavado.partials.checklistupdate')</div>
                            {!!Form::close()!!}



     </div>
    </div>
  </div>

@endsection