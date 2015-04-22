@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrarme</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Apellido</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Rol</label>
							<div class="col-md-6">
								<select name="type" class="form-control" name="type" value="{{ old('type') }}">
  								<option value="admin">Admin</option> 
  								<option value="user" selected>User</option>
  								</select>
							</div>
						</div>



					
						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registrarme
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection