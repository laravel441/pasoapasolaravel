

    <div class="col-sm-6">

	
		<div class="form-group">
			{!! Form::text('nit',null,['class'=>'form-control floating-label','placeholder'=>'NIT:','required'])!!}
			@if($errors -> has('nit'))
			    <p class="text-danger">{{$errors->first('nit')}} </p>
			@endif
		</div>

		<div class="form-group">
			{!! Form::text('nombre',null,['class'=>'form-control floating-label','placeholder'=>'Nombre:','required'])!!}
			@if($errors -> has('nombre'))
                <p class="text-danger">{{$errors->first('nombre')}} </p>
            @endif
		</div>

		<div class="form-group">
			{!! Form::select('rol',
			['cliente'=>'Cliente','proveedor'=>'Proveedor'],
			null,
			['class'=>'form-control floating-label','placeholder'=>'Rol:'])!!}
			@if($errors -> has('rol'))
                <p class="text-danger">{{$errors->first('rol')}} </p>
             @endif
		</div>

		<div class="form-group">
			{!! Form::text('direccion',null,['class'=>'form-control floating-label','placeholder'=>'Dirección:','required'])!!}
            @if($errors -> has('direccion'))
                <p class="text-danger">{{$errors->first('direccion')}} </p>
            @endif
		</div>

		<div class="form-group">
			{!! Form::text('telefono',null,['class'=>'form-control floating-label','placeholder'=>'Telefono:','required'])!!}
            @if($errors -> has('telefono'))
                <p class="text-danger">{{$errors->first('telefono')}} </p>
            @endif
		</div>
		
	</div>{{--/.col-sm-6--}}


    <div class="col-sm-6">
		<div class="form-group">
			{!! Form::email('email',null,['class'=>'form-control floating-label','placeholder'=>'Email:','required'])!!}
        @if($errors -> has('email'))
                <p class="text-danger">{{$errors->first('email')}} </p>
            @endif
		</div>

		<div class="form-group">
			{!! Form::textarea('notas',null,['class'=>'form-control floating-label','rows'=>'8','placeholder'=>'Notas:'])!!}
		</div>
		

    </div>{{--/.col-sm-6--}}
	

