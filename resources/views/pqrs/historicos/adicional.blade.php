@extends('......layouts.sidebar')

{!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
@section('content')


   <div class="container">
         <div class="col-md col-md-offset-0">
          	  <div class="panel panel-default" >
          		    <div class="panel-heading"><div class="col-md-4"><button type="button" class="btn btn-danger" onClick="history.go(-1);return true;"><span class="glyphicon glyphicon-chevron-left"></span></buttton></div><h3 align="center">Información Adicional</h3></div>
          		    <div class="panel-body " >
          				<div class="form-group">
                               @if(Session::has('message'))
                               <p class="alert alert-info" text-center>{{Session::get('message')}}</p>
                               @endif
                         </div>
                        {!!Form::model(['route'=>['pqrs.historicos.show'], 'method'=> 'GET'])!!}

                            @foreach($hist as $histo)
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                    <div class="text-default"><h5>Numero Requerimiento:</h5></div>
                                                       <label class="form-control" disabled name="pqrs_num_requerimiento" >{{ $histo->pqrs_num_requerimiento}}</label>
                                                       <span class="material-input"></span>
                                                </div>
                                           </div>
<br>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                    <div class="text-default"><h5>Descripcion:</h5></div>
                                                    <textarea class="form-control" rows="4" disabled="disabled" name="pqrs_descripcion">{{ $histo->pqrs_descripcion}}</textarea>
                                                    <span class="material-input"></span>
                                                 </div>
                                           </div>
<br>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                    <div class="text-default"><h5>Fecha de Respuesta:</h5></div>
                                                        <label class="form-control" disabled name="rta_fecha_ingreso">{{ $histo->rta_fecha_ingreso}}</label>
                                                        <span class="material-input"></span>
                                                </div>
                                           </div>
<br>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                     <div class="text-default"><h5>Respuesta:</h5></div>
                                                     <textarea class="form-control" rows="4" disabled name="rta_descripcion">{{ $histo->rta_descripcion}}</textarea>
                                                     <span class="material-input"></span>
                                                </div>
                                           </div>
<br>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                     <div class="text-center"><h4>Datos del Usuario</h4></div>
                                                </div>
                                           </div>
<br>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                     <div class="text-default"><h5>Nombre:</h5></div>
                                                     <label class="form-control" disabled name="pqrs_afectado">{{ $histo->pqrs_afectado}}</label>
                                                     <span class="material-input"></span>
                                                </div>
                                           </div>
<br>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                <div class="text-default"><h5>Numero Celular:</h5></div>
                                                <label class="form-control" disabled name="pqrs_num_celuar_afectado">{{ $histo->pqrs_num_celuar_afectado}}</label>
                                                <span class="material-input"></span>
                                                </div>
                                           </div>
<br/>
                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                     <div class="text-default"><h5>Email:</h5></div>
                                                     <label class="form-control" disabled name="pqrs_num_correo_afectado">{{ $histo->pqrs_num_correo_afectado}}</label>
                                                     <span class="material-input"></span>
                                                </div>
                                           </div>

                                           <div class="form-group-danger ">
                                                <div class="form-control-wrapper col-md-10 col-md-offset-1">
                                                     <div class="text-center"><h4>Archivos Adjuntos</h4></div>
                                                       <ul id="list" class="adj">
                                                        <?php foreach ($adj_pqrs as $key => $adjuntos): ?>
                                                            <li><a class="thumb" href="#" data-image-id="" data-toggle="modal" data-title="{{ $adjuntos->nombre }}"  data-image="/pqrs_adjuntos/{{$histo->pqrs_id}}/{{ $adjuntos->nombre }}" data-target="#image-gallery"> <img src="/pqrs_adjuntos/{{$histo->pqrs_id}}/{{ $adjuntos->nombre }}" class="thumb"></a></li>
                                                              <?php endforeach ?>
                                                        </ul>

                                            </div>
                                                            
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <center><img id="image-gallery-image" class="img-responsive" src=""></center>
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image"><span class="glyphicon glyphicon-chevron-left"></span>Ant.</button>
                </div>

                <div class="col-md-8 text-justify" id="image-gallery-caption">
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-primary">Sig.<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>
                                                </div>
                                           </div>
                            @endforeach
                        {!!Form::close()!!}

                    </div>
              </div>
         </div>
    </div>
@endsection

<style>
.thumb {
  height:75px;
  margin: 5px 5px 0 0;;
}
.adj{
  list-style: none;
}
.adj li
{
  display: inline-block;
}

.adj li img
{
  display: block;
}
</style>

<script type="text/javascript">

$(document).ready(function() {

    loadGallery(true, 'a.thumb');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#show-previous-image, #show-next-image').show();
        if(counter_max == counter_current){
            $('#show-next-image').hide();
        } else if (counter_current == 1){
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function(){
            if($(this).attr('id') == 'show-previous-image'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }
});
</script>
