@extends('layouts.sidebar_lavado')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 align="center">Control de calidad y planilla de servicio de lavado [#{{$idctl}}] </h3>
                        <h4 align="center">Edición de registro [#{{$id}}] </h4><h6 align="center"> {{ Auth::user()->usr_name }} <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>
                         </h6>
                    </div>
                        <div class="form-group">
                                   @if(Session::has('message'))
                                       <p class="alert alert-primary" text-center>{{Session::get('message')}} </p>
                                       @endif
                                       @if(Session::has('message2'))
                                       <p class="alert alert-info" text-center>{{Session::get('message2')}} </p>
                                        @endif
                                       @if(Session::has('message3'))
                                       <p class="alert alert-danger" text-center>{{Session::get('message3')}} </p>
                                        @endif

                              </div>
                             <div class="panel-body">



                            {!!Form::open(['route'=>['adjunto.store'], 'method'=> 'POST','enctype'=>'multipart/form-data'])!!}

                           @include('lavado.partials.checklistregupdate')
                            {!!Form::close()!!}
                </div>


        </div>
    </div>
  </div>

@endsection