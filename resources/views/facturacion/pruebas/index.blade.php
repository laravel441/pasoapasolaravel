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
					<h4>Prueba Excel</h4>
                        {{--<audio src="audio/sample.mp3" autoplay>--}}
                        {{--</audio>--}}


                           </button>
                           <input type="text" class="form-control" data-toggle="modal" data-target="#exampleModal" data-value="@fat">
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-value="@fat">Open modal for @fat</button>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-value="@getbootstrap">Open modal for @getbootstrap</button>
                           ...more buttons...

                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                             <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                 <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                   <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                                 </div>
                                 <div class="modal-body">
                                   <form>
                                     <div class="form-group">
                                       <label for="x-name" class="control-label">Recipient:</label>
                                       <input type="text" class="form-control" id="x-name" >
                                     </div>
                                     <div class="form-group">
                                       <label for="message-text" class="control-label">Message:</label>
                                       <textarea class="form-control" id="message-text"></textarea>
                                     </div>
                                   </form>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   <button type="button" class="btn btn-primary">Send message</button>
                                 </div>
                               </div>
                             </div>
                           </div>

                           <script>
                           $('#exampleModal').on('show.bs.modal', function (event) {
                             var button = $(event.relatedTarget) // Button that triggered the modal
                             var x = button.data('value')
                             var recipient2 = button.data('value')
                             // Extract info from data-* attributes
                             // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                             // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                             var modal = $(this)
                             modal.find('.modal-title').text('New message to ' + x)
                             modal.find('.modal-body input').val(x)
                             modal.find('.modal-body textarea').val(x)
                           })

                           </script>


				</div>

			</div>
		</div>
	</div>
</div>

@endsection