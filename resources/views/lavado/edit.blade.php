@extends('layouts.sidebar')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h2 align="center">Control de calidad y planilla de servicio de lavado [#{{$ctl->ctl_id}}] </h2><h6 align="center"> {{ Auth::user()->usr_name }} <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>
          </h6></div>
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
                     @include('lavado.partials.checklist')



        </div>
         <div class="form-group">
                     <div class="col-md-0 col-md-offset-5">
                     <button type="submit" onclick="return confirm ('Esta seguro de crear el usuario?')"class=" btn btn-danger btn-sm glyphicon glyphicon-floppy-save">
                     Crear Registro
                     </button>

                     </div>
             </div>


      </div>



    </div>
  </div>
</div>
@endsection