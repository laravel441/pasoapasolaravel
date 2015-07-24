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








<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Open Modal</button>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Open Modal</button>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">Open Modal</button>

<!-- Modal -->
{!!Form::model(Request::all(),['route'=>['facturacion.pruebas.show'], 'method'=> 'GET'])!!}
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-info btn-lg" >Excel1</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

{!!Form::model(Request::all(),['route'=>['facturacion.pruebas.show'], 'method'=> 'GET'])!!}
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-info btn-lg" >Excel2</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

{!!Form::model(Request::all(),['route'=>['facturacion.pruebas.show'], 'method'=> 'GET'])!!}
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-info btn-lg" >Excel3</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





				</div>

			</div>
		</div>
	</div>
</div>

@endsection

