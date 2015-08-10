@extends('......layouts.sidebar')

@section('content')

	<div class="row">
		  <div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				 <div class="panel-heading">

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




             <ul class="nav nav-pills btn-material-grey-800">
               <li class="active" ><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#home">Pendientes</a></li>
               <li><a class="text-" style="color: #FFFFff" data-toggle="pill" href="#menu1">Revisión</a></li>

             </ul>

             <div class="tab-content">
               <div id="home" class="tab-pane fade in active">

                    @include('tesoreria.revision.partials.tab1')

              </div>
               <div id="menu1" class="tab-pane fade ">

                    @include('tesoreria.revision.partials.tab2')

               </div>

             </div>





			</div>
		</div>
	</div>
</div>

@endsection