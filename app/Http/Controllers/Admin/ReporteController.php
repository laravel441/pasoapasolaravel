<?php namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Faker\Factory as Faker;
class ReporteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $idreg = ($request->reg_id);
        $id =($request->reg_ctl_id);
        //dd($request->all());
        $array_bd = ($request->acciones_bd);
        $array_true = ($request->acciones);
        $array_false = array_diff($array_bd, $array_true);
        //dd($array_false);
        $registro= sw_registro_lavado::find($idreg);
        $registro->fill($request->all());
        //dd($registro);
        $registro->reg_veh_id =$request->pto_id;
        $registro->reg_aprobacion=$request->reg_aprobacion;
        $registro->reg_observacion=$request->reg_observacion;
        $registro->reg_creado_en = new DateTime();
        $registro->reg_creado_por =Auth::user()->usr_name;
        $registro->reg_modificado_en = new DateTime();
        $registro->reg_modificado_por =Auth::user()->usr_name;
        $registro->save();
        //dd($registro);
        $regsdelete = \DB::select('
                           delete from
                            sw_det_lavado where det_reg_id ='.$idreg.'') ;
        foreach($array_true as $arreglotrue) {
            $detalle = new sw_det_lavado();
            $detalle->fill($request->all());
            $detalle->det_reg_id = $registro->reg_id;
            $detalle->det_acc_id = $arreglotrue;
            $detalle->det_acc_estado = 'TRUE';
            $detalle->det_creado_en = new DateTime();
            $detalle->det_creado_por = Auth::user()->usr_name;
            $detalle->det_modificado_en = new DateTime();
            $detalle->det_modificado_por = Auth::user()->usr_name;
            //dd($detalle);
            $detalle->save();
        }
        foreach($array_false as $arreglofalso) {
            $detalle = new sw_det_lavado();
            $detalle->fill($request->all());
            $detalle->det_reg_id = $registro->reg_id;
            $detalle->det_acc_id = $arreglofalso;
            $detalle->det_acc_estado = 'FALSE';
            $detalle->det_creado_en = new DateTime();
            $detalle->det_creado_por = Auth::user()->usr_name;
            $detalle->det_modificado_en = new DateTime();
            $detalle->det_modificado_por = Auth::user()->usr_name;
            //dd($detalle);
            $detalle->save();
        }
        Session::flash('message', 'Se ha editado el registro. ID: '.$idreg );
        return redirect()->back();
        //return Redirect::action('RegistroController@index');
        //return redirect()->route('reporte.show',compact('id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $ctl=sw_ctl_lavado::find($id);
        $ptoid = $ctl->ctl_pto_id;
        $pveid = $ctl->ctl_pve_an8;
        $ptoctls = \DB::select('select pto_nombre from sw_patio where pto_id ='.$ptoid);
        $pvectls = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pveid);
        $ptoctl= $ptoctls[0];
        $pvectl= $pvectls[0];
        $numregs = \DB::select('
                            select count (reg_id) from
                            fn_registro(?)',array($id));
        $numreg=$numregs[0];
        //dd($numreg);


        $pdf = App::make('dompdf'); //Note: in 0.6.x this will be 'dompdf.wrapper'
        //dd($pdf);
        $pdf->loadHTML('<html>
            <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Actionable emails e.g. reset password</title>
                 <h2 ><i><center> EN CONSTRUCIÓN</center></i></h2>
                <h2 class="text-primary"><center> REPORTE DE LAVADO CONTROL #' .$id.'</center></h2>
            </head>
   
        <h3>Señor:</h3>
<       <h4>Funcionario Masivo Capital</h4><br>
        <h4>Cordial Saludo:</h4><br>
        <hr>
    <BODY><br><br>La presente acta representa la información del control de lavado No.' . $id. ' realizado en la fecha:
    ' . $ctl->ctl_fecha_inicio. ', hasta '. $ctl->ctl_fecha_inicio.' en la terminal de '. $ptoctl->pto_nombre.',
     realizado por el proveedor '. $pvectl->pvd_nombre.'. Con un total de ' . $numreg->count. '
    <br><br>
    <hr>
    </BODY><br><br>
    <br><br><br><br><br><h3>Atentamente:</h3>
   <br> _________________________________________<br>
    <h3>Masivo Capital SAS - 2015</h3>
</HTML>');
        return $pdf->setPaper('a4')->setWarnings(false)->save($id)->download('Reporte_control_'.$id.'.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //dd($id);
        $iduser =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));
        //dd($menus);
        $reg = sw_registro_lavado::find($id);
        $idctl = $reg->reg_ctl_id;
        //dd($idctl);
        $reg_list = \DB::select('
                           select * from
                            fn_reg_list ('.$idctl.') where reg_id ='.$id.' order by acc_id ASC') ;
        //dd($reg_list);
        $ctl = sw_ctl_lavado::find($idctl);
        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;
        $veh_id = $reg->reg_veh_id;
        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);
        $vehnombre = \DB::select('select veh_movil from sw_vehiculo where veh_id ='.$veh_id);
        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];
        $veh_nombre= $vehnombre[0];
        //dd($veh_nombre);
        $usr_name = Auth::user()->usr_name ;
        //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');
        $vehiculos = \DB::select('select * from sw_vehiculo
        ');
        //dd($vehiculos);
        return view('lavado.updatereg',compact('menus','usr_name','acciones','vehiculos','id',
            'reg','idctl','pto_nombre','pvd_nombre','veh_nombre','ctl','reg_list'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        dd($id);
        $ctl = sw_registro_lavado::find($id);
        dd($ctl);
        $iduser =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));
        //dd($menus);
        $ctl = sw_ctl_lavado::find($id);
        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;
        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);
        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];
        //dd($ptonombre);
        $usr_name = Auth::user()->usr_name ;
        //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');
        $patios = \DB::select('select * from sw_patio
        ');
        $vehiculos = \DB::select('select * from sw_vehiculo
        ');
        $proveedores = \DB::select('select * from sw_proveedor
        ');
        //dd($vehiculos);
        return view('lavado.updatectl',compact('menus','usr_name','acciones','vehiculos','id','pto_nombre','pvd_nombre','patios','proveedores','ctl'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}