@extends('app') @section('content')

<h2>Custom DataGrid Pager</h2>
    <p>You can append some buttons to the standard datagrid pager bar.</p>
    <div style="margin:20px 0;"></div>
    <table id="dg" class="easyui-datagrid" title="Custom DataGrid Pager" style="height: 250px"
            data-options="rownumbers:false,singleSelect:true,data:data, pagination:true,method:'get'">

	<thead>
		<tr>
			<th data-options="field:'usrid'" style="width: 25%">#</th>
			<th data-options="field:'usr_name'" style="width: 25%">Nombre</th>
			<th data-options="field:'usr_mail'" style="width: 25%">Email</th>
			<th data-options="field:'usr_rol'" style="width: 25%">Rol</th>
			<!-- <th>Acciones</th> -->
		</tr>
	</thead>
</table>
	
<script type="text/javascript">
                    var data=[
								@foreach ($users as $user)
								
	{"usrid":"{{$user->id}}","usr_name":"{{$user->full_name}}","usr_mail":"{{$user->email}}","usr_rol":"{{$user->type}}"},

								@endforeach
								];
								
					</script>
<script type="text/javascript">

    var pager = $('#dg').datagrid().datagrid('getPager');    // get the pager of datagrid
    
    pager.pagination({
        buttons:[{
            iconCls:'icon-search',
            handler:function(){
                alert('search');
            }
        },{
            iconCls:'icon-add',
            handler:function(){
                alert('add');
            }
        },{
            iconCls:'icon-edit',
            handler:function(){
                alert('edit');
            }
        }]
    });            

</script>
	
		 @endsection