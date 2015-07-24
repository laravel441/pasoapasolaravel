<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\sw_modulo;
use App\sw_rol;
use App\sw_usuario_x_rol;
use DateTime;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Route;

class RRolesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));
        $roles = sw_rol::where('rol_estado','=',true)->orderBy('rol_id')->paginate(100);

        return view('admin.roles.crearRol',compact('menus','roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//dd($request->all());
        $usuario = Auth::user()->usr_name;
        $v = Validator::make($request->all(),['rol_nombre' => 'required|unique:sw_roles|alpha']);
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }else{
            $nombre=$request->input('rol_nombre');
            $rol = new sw_rol();
            $rol->rol_nombre = $nombre;
            $rol->rol_creado_en = new DateTime();
            $rol->rol_creado_por = "Swcapital";
            $rol->rol_modificado_en = new DateTime();
            $rol->rol_modificado_por = $usuario;
            $rol->rol_estado = "TRUE";
            $rol->save();
        }
        $mensaje ="Rol creado exitosamente";
        Session::flash('message', $mensaje);

        return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($idr)
	{
        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));
        $obrol = sw_rol::findOrFail($idr);
        $modulosRol = \DB::table('sw_modulos')
            ->leftJoin ('sw_modulo_x_roles', function($join) use($idr){
                $join->on('sw_modulo_x_roles.mxr_mod_id','=','sw_modulos.mod_id')
                    ->where( 'sw_modulo_x_roles.mxr_rol_id' ,'=', $idr);
            })->orderBy('mod_id')

            ->get();
       // dd($modulosRol);

        return view('admin.roles.detallesRol',compact('menus','obrol','modulosRol'));
	}
    public function verpermisos($idr)
    {
        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));
        $obrol = sw_rol::findOrFail($idr);
        $modulosRol = \DB::table('sw_modulos')
            ->leftJoin ('sw_modulo_x_roles', function($join) use($idr){
                $join->on('sw_modulo_x_roles.mxr_mod_id','=','sw_modulos.mod_id')
                    ->where( 'sw_modulo_x_roles.mxr_rol_id' ,'=', $idr);
            })->orderBy('mod_id')

            ->get();
        // dd($modulosRol);
        $modulos = sw_modulo::all();
        $tamModulos = count($modulos);
       // dd($tamModulos);
        $modulosVacio = false;
        $contador =0;
        foreach ($modulosRol as $modulo){
            if($modulo->mxr_id == null){
                $contador=$contador+1;
            }
        }
       // dd($contador);
        if($contador == $tamModulos){
            $modulosVacio = true;
        }

        //dd($modulosVacio);
        return view('admin.roles.verPermisosRol',compact('menus','obrol','modulosRol','modulosVacio'));
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $idr)
	{
        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));
        $obrol = sw_rol::findOrFail($idr);
        $modulosRol = \DB::table('sw_modulos')
            ->leftJoin ('sw_modulo_x_roles', function($join) use($idr){
                $join->on('sw_modulo_x_roles.mxr_mod_id','=','sw_modulos.mod_id')
                    ->where( 'sw_modulo_x_roles.mxr_rol_id' ,'=', $idr);
            })->orderBy('mod_id')

            ->get();
         // dd($modulosRol);
        return view('admin.roles.editarRol', compact('obrol','menus','modulosRol'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($idr,Request $request)
	{
        $usuario = Auth::user()->usr_name;
        $obrol = sw_rol::findOrFail($idr);
        $obrol->rol_nombre =$request->rol_nombre;
        $obrol->rol_modificado_en =new DateTime();
        $obrol->rol_modificado_por =$usuario;
        $obrol->save();
        $mensaje ="Rol modificado exitosamente";
        Session::flash('message', $mensaje);


        return redirect()->back();


}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id )
	{
       // dd($id);
       $borrar_roles = \DB::select('select * from sw_usuario_x_roles where uxr_rol_id ='.$id);


        if( $borrar_roles == null){

            $objrol = sw_rol::findOrFail($id);

            \DB::table('sw_roles')
                ->where('rol_id', $id)
                ->update(['rol_estado' => false]);

            $mensaje ="El rol con el nombre"." ". $objrol->rol_nombre." "."fue borrado.";
            Session::flash('message', $mensaje);
            return redirect()->back();
        }else{
            foreach($borrar_roles as $das){
                $wer[] = $das->uxr_usr_id;
            }
            //dd($borrar_roles,$wer);
            $users = \DB::table('sw_usuarios')->whereIn('usr_id', $wer)->get();
            //dd($users);
            $id =Auth::user()->usr_id;
            $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));


            $mensaje = "El rol que esta intentando eliminar tiene los siguientes  usuarios asignados ";
            Session::flash('messagesl', $mensaje);
            return view('admin.roles.borrarRoles', compact('users','menus','borrar_roles'));
        }

	}

    public function borrar($id){
       // dd($id);
        $borrar_roles = \DB::select('select * from sw_usuario_x_roles where uxr_rol_id ='.$id);
        foreach($borrar_roles as $das){
            $wer[] = $das->uxr_usr_id;
        }
       // dd($id,$wer);
        foreach($wer as $delete){
            \DB::table('sw_usuario_x_roles')->where('uxr_usr_id', '=',$delete )
                ->where('uxr_rol_id','=',$id)
                ->delete();
        }

        $mensaje = "Todos los usuarios asignados al rol fueron desvinculados  ";
        Session::flash('messages', $mensaje);
        return redirect()->route('admin.roles.index');
    }



    public  function modulos(Request $request, $idr){
       // dd($idr);
        $usuario = Auth::user()->usr_name;
        $modulos_seleccionados= $request->input('modulos_seleccionados');
        $lista_todos_modulos= $request->input('lista_todos_modulos');
        $modulos_asignados = $request->input('modulos_asignados');

        //dd($lista_todos_modulos,$modulos_asignados,$modulos_seleccionados);
        $valores =count($modulos_seleccionados);
        //dd($valores);
        if($valores == 0 && $modulos_asignados == null){

                return redirect()->back();
        }else{
            if($modulos_asignados != null){
                if($modulos_seleccionados == null){
                    foreach($modulos_asignados as $delete){
                        \DB::table('sw_modulo_x_roles')->where('mxr_mod_id', '=',$delete )
                            ->where('mxr_rol_id','=',$idr)
                            ->delete();
                    }
                    return redirect()->back();
                }else{
                    $eliminar = array_diff($modulos_asignados,$modulos_seleccionados);
                    //dd($eliminar);
                    foreach($eliminar as $delete){
                        \DB::table('sw_modulo_x_roles')->where('mxr_mod_id', '=',$delete )
                            ->where('mxr_rol_id','=',$idr)
                            ->delete();
                    }
                }

            }
        }


        if($modulos_asignados == null){
            foreach ($modulos_seleccionados as $ins){
                \DB::table('sw_modulo_x_roles')->insert(
                    array('mxr_mod_id' => $ins, 'mxr_rol_id' => $idr, 'mxr_flag_crear' => 'FALSE', 'mxr_flag_consultar' => 'FALSE',
                        'mxr_flag_modificar'=> 'FALSE', 'mxr_flag_eliminar'=> 'FALSE',
                        'mxr_creado_en' => new DateTime(),'mxr_creado_por' => 'Swcapital',
                        'mxr_modificado_en' => new DateTime(), 'mxr_modificado_por' => $usuario)
                );
            }

        }else{
            $noasignados = array_diff($lista_todos_modulos,$modulos_asignados);
            //dd($noasignados);
            $insertar =array_intersect($noasignados,$modulos_seleccionados);
            //dd($insertar);
            foreach ($insertar as $ins){
                \DB::table('sw_modulo_x_roles')->insert(
                    array('mxr_mod_id' => $ins, 'mxr_rol_id' => $idr, 'mxr_flag_crear' => 'FALSE', 'mxr_flag_consultar' => 'FALSE',
                        'mxr_flag_modificar'=> 'FALSE', 'mxr_flag_eliminar'=> 'FALSE',
                        'mxr_creado_en' => new DateTime(),'mxr_creado_por' => 'Swcapital',
                        'mxr_modificado_en' => new DateTime(), 'mxr_modificado_por' => $usuario)
                );
            }
        }


        $mensaje = 'Modulo asignado con exito';
        Session::flash('message',$mensaje);
        return redirect()->back();
    }

    public function permisos($id , $idm){
        //dd($id,$idm);
        $idu =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($idu));

        $modulosRol = \DB::table('sw_modulos')
            ->leftJoin ('sw_modulo_x_roles', function($join) use($id,$idm){
                $join->on('sw_modulo_x_roles.mxr_mod_id','=','sw_modulos.mod_id')
                    ->where( 'sw_modulo_x_roles.mxr_rol_id' ,'=', $id)
                    ->where( 'sw_modulo_x_roles.mxr_mod_id' ,'=', $idm)
                    ->where('sw_modulo_x_roles.mxr_id', '<>' ,null );
            })->orderBy('mod_id')

            ->get();
       // dd($modulosRol);
        $permisosModulo = \DB::table('sw_modulo_x_roles')->select('*')
            ->where('sw_modulo_x_roles.mxr_rol_id' ,'=', $id)
            ->where( 'sw_modulo_x_roles.mxr_mod_id' ,'=', $idm)
            ->get();
       //dd($permisosModulo);
        $obrol = sw_rol::findOrFail($id);
        //dd($obrol);
        return view('admin.roles.permisosRol',compact('obrol','modulosRol','menus','permisosModulo'));
    }


    public function permisoscambiar(Request $request, $id = null , $idm = null ){
       $total = $request->all();
        //dd($total,$id,$idm);
        $usuario = Auth::user()->usr_name;
        $modulo_id = $request->input('modulo_id');
        $rol_id = $request->input('rol_id');
        $estado_crear = $request->input('estado_crear');
        $estado_consultar = $request->input('estado_consultar');
        $estado_modificar = $request->input('estado_modificar');
        $estado_eliminar = $request->input('estado_eliminar');
        $crear= $request->input('crear');
        $consultar= $request->input('consultar');
        $modificar= $request->input('modificar');
        $eliminar= $request->input('eliminar');

        if($estado_crear == 1 && isset($crear) == false){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_crear' => false , 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario ));
        }

        if($estado_consultar == 1 && isset($consultar) == false){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_consultar' => false , 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }

        if($estado_modificar == 1 && isset($modificar) == false){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_modificar' => false, 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }

        if($estado_eliminar == 1 && isset($eliminar) == false){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_eliminar' => false, 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }

        ////////////////////////////////////
        if($estado_crear === "" && $crear === ""){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_crear' => true, 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }

        if($estado_consultar === "" && $consultar === ""){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_consultar' => true, 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }
        if($estado_modificar === "" && $modificar === ""){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_modificar' => true, 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }
        if($estado_eliminar === "" && $eliminar === ""){
            \DB::table('sw_modulo_x_roles')
                ->where('mxr_rol_id', $rol_id)
                ->where('mxr_mod_id', $modulo_id)
                ->update(array('mxr_flag_eliminar' => true, 'mxr_modificado_en' => new DateTime() , 'mxr_modificado_por' => $usuario));
        }
        $mensaje = 'Pemiso modificado con exito';
        Session::flash('message',$mensaje);

        return redirect()->back();
    }

}
