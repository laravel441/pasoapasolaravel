
 {!!Form::open(['route'=>['registros-id'], 'method'=> 'POST'])!!}
                       @if (count($errors) > 0)

                                  <div class="alert alert-danger">
                                   Debe digitar los siguientes campos:  <br><br>
                                    <ul>
                                      @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                      @endforeach
                                    </ul>
                                  </div>
                                @endif
                                <div class="form-group-danger ">
                                    <div class="form-control-wrapper col-md-0 col-md-offset-0">
                                        <div class="text-default"><strong>Numero de Requerimiento:</strong></div>
                                        </br>
                                        <label class="form-control" disabled="disabled" name="pqrs_num_requerimiento">{{ $regi->pqrs_num_requerimiento }}</label>
                                        <input type="hidden" name="pqrs_id" value="{{ $regi->pqrs_id }}">
                                        <span class="material-input"></span>
                                    </div>
                                </div>

                                <div class="form-group-danger ">
                                    <div class="form-control-wrapper col-md-0 col-md-offset-0">
                                        <div class="text-default"><strong>Descripcion:</strong></div>
                                        </br>
                                        <textarea class="form-control" rows="4" disabled="disabled" name="pqrs_descripcion">{{ $regi->pqrs_descripcion}}</textarea>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
<br>

                                 <div class="bs-example" data-example-id="textarea-form-control">
                                       <div class="col-md-18 col-md-offset-0">
                                              <div class="floating-label"><strong>Respuesta:</strong></div>
                                              </br>
                                             <textarea class="form-control" rows="4" maxlength="10000" placeholder="Digite la Respuesta." name="rta_descripcion" required="required"></textarea>
                                             <h6>Cantidad maxima de caracteres 10.000</h6>
                                       </div>
                                 </div>

<br>

<div class="form-group">


  <ul id="list" class="adj">

    @foreach($adj_pqrs as $key => $adjuntos)

                @if($formato[$key][1]=='jpg'||$formato[$key][1]=='bmp'||$formato[$key][1]=='jpeg'||$formato[$key][1]=='gif'||$formato[$key][1]=='png')
                <li>
                    <a class="thumb" href="#" data-image-id="" data-toggle="modal" data-title="{{ $adjuntos->nombre }}"  data-image="/pqrs_adjuntos/{{$regi->pqrs_id}}/{{ $adjuntos->nombre }}" data-target="#image-gallery"> <img src="/pqrs_adjuntos/{{$regi->pqrs_id}}/{{ $adjuntos->nombre }}" class="thumb"></a>
                </li>
              @endif

    @endforeach



</ul>
<ul  id="list" class="adj" >
@foreach($adj_pqrs as $key => $adjuntos)
      @if($formato[$key][1]=='doc'||$formato[$key][1]=='docx')
                 <div class="fa fa-file-word-o"><a class="media" href="/pqrs_adjuntos/{{$regi->pqrs_id}}/{{ $adjuntos->nombre }}">   {{ $adjuntos->nombre }}</a> </div><br>
      @endif
      @if($formato[$key][1]=='xls'||$formato[$key][1]=='xlsx')
                  <div class="fa fa-file-excel-o"><a class="media" href="/pqrs_adjuntos/{{$regi->pqrs_id}}/{{ $adjuntos->nombre }}">   {{ $adjuntos->nombre }}</a> </div><br>
      @endif
      @if($formato[$key][1]=='pdf')
                   <div class="fa fa-file-pdf-o"><a class="media" href="/pqrs_adjuntos/{{$regi->pqrs_id}}/{{ $adjuntos->nombre }}">   {{ $adjuntos->nombre }}</a> </div><br>
      @endif

   @endforeach
   </ul>
<output id="prueba"></output>


<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <center><img id="image-gallery-image" class="img-responsive" src=""></center>
                <center><div id="archivo"></div></center>
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image"><span class="glyphicon glyphicon-chevron-left "></span>Ant.</button>
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

{!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
<script type="text/javascript">
$(document).ready(function(){

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
            prueba = $sel.data('image');
            prueba2 = prueba.split('.').pop();
            current_image = $sel.data('image-id');
            if(prueba2=='jpg'||prueba2=='png'||prueba2=='jpeg'||prueba2=='gif'||prueba2=='bmp'){
                $('#image-gallery-caption').text($sel.data('caption'));
                $('#image-gallery-title').text($sel.data('title'));
                $('#image-gallery-image').attr('src', $sel.data('image'));
                disableButtons(counter, $sel.data('image-id'));

            }else if(prueba2=='xlsx'||prueba2=='xls'){

                $('#archivo').attr('class', 'fa fa-file-excel-o fa-4x');
                $('#image-gallery-title').text($sel.data('title'));

                $('#image-gallery-image').attr('src','');
                disableButtons(counter, $sel.data('image-id'));

            }else if(prueba2=='doc'||prueba2=='docx'){

                $('#archivo').attr('class', 'fa fa-file-word-o fa-4x');
                $('#image-gallery-title').text($sel.data('title'));

                $('#image-gallery-image').attr('src','');
                disableButtons(counter, $sel.data('image-id'));
            }else if(prueba2=='pdf'){

                $('#archivo').attr('class', 'fa fa-file-pdf-o fa-4x');
                $('#image-gallery-title').text($sel.data('title'));

                $('#image-gallery-image').attr('src','');
                disableButtons(counter, $sel.data('image-id'));
            }

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
});</script>
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
</div>

                             <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#myModal">Asignar Descargo</button>

                           <center> <button action="store" type="submit" class="btn btn-primary">Enviar</button> </center>

                                 <div class="modal fade" id="myModal" role="dialog">
                                      <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                               <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h3 class="modal-title"></h3>
                                                </div>
                                               <div class="modal-body">
                                                    @include('pqrs.registros.partials.datosoper')
                                              </div>
                                          </div>
                                      </div>
                                </div>
<input type="hidden" value="{{$regi->pqrs_id}}" name="escondido">
                                  {!!Form::close()!!}



