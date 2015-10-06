                                  <!-- Include Required Prerequisites -->


@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
        @if (session('status'))
              <div class="alert alert-danger">
                  {{ session('status') }}
              </div>
          @endif
    
				 <div class="panel-heading"><h2 align="center">Generación de Reportes PQRS</h2></div>
				<div class="panel-body">
				<div class="form-group">
                     @if(Session::has('message'))
                     <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                     @endif
                 </div>
                 <center><img src="/images/Biarticulado.jpg" height="70" title="Reportes"> </img></center>
                 <br>
                           {!! Form::open(array('route' => 'reportes')) !!}
                 <div class="col-md-12 col-md-offset-0">
                 <table class="table table-striped">
                  <tr>
                      @if($tipo == 1)
                    <td class="danger text-center"><label><input type="radio" value="1" name="optradio" checked>  Transmilenio</label></td>
                    <td class="info text-center"><label><input type="radio" value="2" name="optradio">  Canales</label></td>
                    <td class="success text-center"><label><input type="radio" value="3" name="optradio">  Calendario</label></td>
                    @elseif($tipo == 2)
                     <td class="danger text-center"><label><input type="radio" value="1" name="optradio" >  Transmilenio</label></td>
                    <td class="info text-center"><label><input type="radio" value="2" name="optradio" checked>  Canales</label></td>
                    <td class="success text-center"><label><input type="radio" value="3" name="optradio">  Calendario</label></td>
                     @elseif($tipo == 3)
                     <td class="danger text-center"><label><input type="radio" value="1" name="optradio" >  Transmilenio</label></td>
                    <td class="info text-center"><label><input type="radio" value="2" name="optradio" >  Canales</label></td>
                    <td class="success text-center"><label><input type="radio" value="3" name="optradio" checked>  Calendario</label></td>
                    @else
                    <td class="danger text-center"><label><input type="radio" value="1" name="optradio" checked>  Transmilenio</label></td>
                    <td class="info text-center"><label><input type="radio" value="2" name="optradio" >  Canales</label></td>
                    <td class="success text-center"><label><input type="radio" value="3" name="optradio" >  Calendario</label></td>
                   @endif
                    <td><label>Fecha Inicio </label>
                          <input type="text" class="input-md" name="ini"  id='dateRangePicker'/></td>
                          <td><label>Fecha Final </label>
                          <input type="text" class="input-md" name="fin" id='dateRangePicker2'/></td>
                          <td><button type="submit" class="btn btn-danger" style="margin:0px"><span class="glyphicon glyphicon-search" ></span></button></td>
                          


                   <td>
                    @if($tipo == 4)
                      <a href="{{route('excel',[$tipo,$ini,$fin])}}"><button type="button" class="btn btn-primary" style="margin:0px" name="1"   title="Exportar" id="btnExport" disabled>
                         <span class="fa fa-file-excel-o fa-1x"></span>
                     </button></a>
                     @else
                     <a href="{{route('excel',[$tipo,$ini,$fin])}}"><button type="button" class="btn btn-primary" style="margin:0px" name="4"   title="Exportar" id="btnExport">
                         <span class="fa fa-file-excel-o fa-1x"></span>
                     </button></a>
                    @endif 
                   </td>   
                  </tr>
                </table>
              </div>

              {!! Form::close() !!}   
                 @if($tipo == 1)
                 @include('pqrs.reportes.partials.reporte')
                 @elseif($tipo == 2)
                 @include('pqrs.reportes.partials.canales')
                 @elseif($tipo == 3)
                @include('pqrs.reportes.partials.historicos')
                @else
                 @endif
            </div>
			</div>
		</div>
	</div>

{!! Html::style('bower_components/calendario/daterangepicker.css') !!}
{!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
{!! Html::script('bower_components/calendario/moment.min.js') !!}
{!! Html::script('bower_components/calendario/daterangepicker.js') !!}
<script>
$(document).ready(function() {
$('#dateRangePicker').daterangepicker({
  singleDatePicker: true,
  timePicker: false,
  timePickerIncrement: 30,
  showDropdowns: true,
  locale: {
    format: 'YYYY-MM-DD'
  }
});
});

$(document).ready(function() {
$('#dateRangePicker2').daterangepicker({
  singleDatePicker: true,
  timePicker: false,
  timePickerIncrement: 30,
  showDropdowns: true,
  locale: {
    format: 'YYYY-MM-DD'
  }
});
});
</script>

@endsection



