@extends('layouts.sidebar_lavado')


@section('content')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
        <div class="panel-heading"><h3>Nuevo Registro: {{ Auth::user()->usr_name }} </h3><h6 align="left"><?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?>
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
                                                 <div class="col-md-0 col-md-offset-4">
                                                 <button type="submit" class="btn btn-danger btn-sm">
                                                 Registrar control
                                                 </button>
                                                 </div>
                                                 </div>


      </div>
    </div>
  </div>

@endsection
