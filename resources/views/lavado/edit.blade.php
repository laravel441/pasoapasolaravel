@extends('layouts.sidebar')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                                <div class="panel-heading"><h2 align="center">Control de calidad y planilla de servicio de lavado [#{{$id}}] </h2><h6 align="center"> {{ Auth::user()->usr_name }} <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>
                                     </h6>
                                </div>
                                <div class="form-group">
                                     @if(Session::has('message'))
                                     <p class="alert alert-danger" text-center>{{Session::get('message')}} <br>{{Session::get('message2')}}</p>

                                     @endif



                               </div>
                                     <div class="panel-body">



                                         <div>@include('lavado.partials.checklist')</div>




                            </div>
                        </div>
                    </div>
                 </div>

                    @endsection