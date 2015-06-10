@extends('layouts.sidebar')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                            <div class="panel-heading"><h3>Registro de Lavado de Vehículos </h3><h6 align="left">{{ Auth::user()->usr_name }}
                                <?php $date = new DateTime();  echo date_format($date, '    d-m-Y (H:i)');?></h6>
                            </div>
                                 <div class="form-group">
                                     @if(Session::has('message'))
                                     <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                                     @endif
                                 </div>
                           <div>
                            <div class="col-md-3 col-md-offset-0">

                                {{--<p class="help-block text-info "><i>Hay {{$users->total()}} registros</i></p>--}}
                           {!!Form::model(['route'=>['lavado.store'], 'method'=> 'POST'])!!}
                            @include('lavado.partials.ctrl')
                            {!!Form::close()!!}

                            </div>



                                {!! Form::model(Request::all(),['route' => 'lavado.index', 'method' => 'GET', 'class'=>'navbar-form navbar-left pull-right', 'role' =>'search']) !!}

                                         <div class="col-md-6 col-md-offset-0 form-group-danger">
                                             {!! Form::text('control',null,['class'=>'form-control floating-label','placeholder'=>'Buscar control '])!!}
                                         </div>

                                          <button type="submit" class="btn btn-danger btn-sm">
                                                <span class="glyphicon glyphicon-search "></span> Buscar

                                           </button>


                                    </div>





                            @include('lavado.partials.table')

                       {!! $ctls->appends(Request::only(['control']))->render() !!}


                </div>
            </div>
        </div>



@endsection
@section('scripts')


@endsection
