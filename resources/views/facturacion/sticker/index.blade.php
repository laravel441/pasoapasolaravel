@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading"><h2 align="center">Generación de Sticker
                         </h2><h6 align="center"> {{ Auth::user()->usr_name }}
                           <?php $date = new DateTime();  echo date_format($date, 'd-m-Y (H:i)');?></h6>
                    </div>

				<div class="panel-body">
				<div class="form-group">
                     @if(Session::has('message'))
                     <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                     @endif
                 </div>

                                <div class="col-md-12 col-md-offset-0">

                                                                {{--<p class="help-block text-info "><i>Hay {{$users->total()}} registros</i></p>--}}
                                   {!!Form::model(['route'=>['facturacion.sticker.show'], 'method'=> 'GET'])!!}
                                    @include('facturacion.sticker.partials.sticker')
                                   {!!Form::close()!!}

                                </div>
                                  @include('facturacion.sticker.partials.table')

				</div>

			</div>
		</div>
	</div>
</div>

@endsection