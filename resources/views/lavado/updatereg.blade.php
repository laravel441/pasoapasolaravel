@extends('layouts.sidebar')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2 align="center">Control de calidad y planilla de servicio de lavado [#{{$idctl}}] </h2>
                        <h3 align="center">Edición de registro [#{{$id}}] </h3><h6 align="center"> {{ Auth::user()->usr_name }} <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>
                         </h6>
                    </div>
                    <div class="form-group">
                                                         @if(Session::has('message'))
                                                         <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                                                         @endif
                                                     </div>
                             <div class="panel-body">
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


                            {!!Form::open(['route'=>['reporte.create'], 'method'=> 'GET'])!!}

                           @include('lavado.partials.checklistregupdate')
                            {!!Form::close()!!}
                </div>


        </div>
    </div>
  </div>

@endsection