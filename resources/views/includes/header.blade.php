
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{!! url('/') !!}"><img src="/images/logo.png" width="45%"></a>
            <!--a class="navbar-brand" href="#">Swcapital</a-->
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li></li>
                <!--li><a href="{!! url('/') !!}">Inicio</a></li-->
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())

                @elseif(Auth::user()->usr_stu_id == '1')
                {{--<li><a href="{{route('admin.users.index')}}">Empleados</a></li>--}}
                <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->usr_name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{!! url('/admin/users/cambio') !!}" >Cambio de contraseña</a></li>
                            <li><a href="{!! url('/auth/logout') !!}" >Cerrar Sesión</a></li>

                            </ul>
                    </li>


                     @else
                      <li class="dropdown">

                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->usr_name }} <span class="caret"></span></a>
                             <ul class="dropdown-menu" role="menu">
                             <li><a href="{!! url('/admin/users/cambio') !!}" >Cambio de contraseña</a></li>
                                 <li><a href="{!! url('/auth/logout') !!}" >Cerrar Sesión</a></li>

                             </ul>
                         </li>



                @endif
            </ul>
        </div>
    </div>
</nav>



	{!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
	{!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
	{!! Html::script('bower_components/bootstrap-material-design/dist/js/material.min.js') !!}
	{!! Html::script('bower_components/bootstrap-material-design/dist/js/ripples.min.js') !!}
	<!-- List Lavados-->
	{!! Html::script('js/list.js') !!}
	{!! Html::script('js/list_admin.js') !!}<!--roles-->
	<!-- Combobox-->
	{!! Html::script('js/bootstrap-combobox.js') !!}


    <!-- Calendario-->
    {!! Html::script('bower_components/datepicker/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('bower_components/datepicker/locales/bootstrap-datepicker.es.min.js') !!}
    <!-- Jquery-ui-->
    {!! Html::script('bower_components/bootstrap-table/src/bootstrap-table.js') !!}
    {!! Html::script('bower_components/bootstrap-table/src/bootstrap-table-export.js') !!}

    {!! Html::script('bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js') !!}
    {!! Html::script('tableExport/tableExport.min.js') !!}
    {!! Html::script('tableExport/libs/FileSaver/FileSaver.min.js') !!}
    {!! Html::script('tableExport/libs/html2canvas/html2canvas.min.js') !!}

    {!! Html::script('tableExport/libs/jsPDF/jspdf.min.js') !!}
    {!! Html::script('tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js') !!}



     {!! Html::script('bower_components/bootstrap-table/src/extensions/filter/bootstrap-table-filter.js') !!}
     {!! Html::script('bower_components/bootstrap-table-filter/src/bootstrap-table-filter.js') !!}

     {!! Html::script('bower_components/bootstrap-fileinput/js/fileinput.min.js') !!}
     {!! Html::script('bower_components/bootstrap-fileinput/js/fileinput_locale_es.js') !!}













<script type="text/javascript">
		$(document).on('ready', function(){
			$.material.init();
		});
</script>
    <script type="text/javascript">
          $(document).ready(function(){
            $('.combobox').combobox();
          });
        </script>

