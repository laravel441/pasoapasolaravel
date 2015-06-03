@extends('layouts.sidebar')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14 col-md-offset-0">
                <div class="panel panel-default">
                                   <div class="panel-heading"><h2 align="center">Control de calidad y planilla de servicio de lavado [#{{$ctls->ctl_id}}] </h2><h6 align="center"> {{ Auth::user()->usr_name }} <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?></h6>
                                   </div><br>

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


                                                    <div>@include('lavado.partials.checklistreg')</div>







                                              <div class="form-group">
                                                        <div class="col-md-0 col-md-offset-5">
                                                                <button type="submit" onclick="return confirm ('Esta seguro de cerrar el control?')"class=" btn btn-danger btn-sm glyphicon glyphicon-lock">
                                                                Cerrar Control
                                                                </button>
                                                        </div>
                                              </div>
                                             <div class="fa-hover ">
                                                        <a href="http://swcapital.com/lavado">
                                                        <i class="fa fa-arrow-circle-o-left fa-3x" title="Regresar Controles"></i></a>
                                             </div>



             </div>
         </div>
    </div>
</div>
@endsection