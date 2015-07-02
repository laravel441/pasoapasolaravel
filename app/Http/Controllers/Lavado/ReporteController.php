<?php namespace App\Http\Controllers\Lavado;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use App\sw_adjunto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\PDF;
use mPDF;
use Carbon\Carbon;

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

        //:(
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $id = $request->ctl_id;
        $ctl = sw_ctl_lavado::find($id);
        $ctl->ctl_observacion = $request->ctl_observacion;
        $ctl->ctl_modificado_en = new DateTime();
        $ctl->ctl_modificado_por = Auth::user()->usr_name;

        $ctl->save();
        Session::flash('message', 'Se ha agregado una observación al control. ID: '.$id );
        return redirect()->back();
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

        $ctlregs = \DB::select('
                            select *from
                            fn_registro(?)',array($id));

        //dd($ctlregs);
        //$x  = count($ctlregs);




        //dd($y);


        $numregs = \DB::select('
                            select count (reg_id) from
                            fn_registro(?)',array($id));

        //dd($numregs);
        $numreg=$numregs[0];

        $numaprobs = \DB::select('
                            select count (reg_id) from
                            fn_registro(?) where (reg_aprobacion) = TRUE',array($id));
        $numaprob=$numaprobs[0];


        $numnoveds = \DB::select('
                            select count (reg_id) from
                            fn_registro(?) where (reg_aprobacion) = FALSE',array($id));
        $numnoved=$numnoveds[0];
        //dd($numaprob);

        $mpdf=new mPDF('c','A4','','',20,20,35,35,5,5);


        // Use different Odd/Even headers and footers and mirror margins

        $header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%" align="center"><img src="/images/logo.jpg" width="126px" /></td>
</tr></table>
';
//        $footer = '<div class="main-footer">© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';
        $footer = '<table class="table table-hover" >
<thead>
<tr>

<th  align="center"> <h4>__________________________</h4></th>
<td class="text-danger" align="center"></td>
<th  align="center"><h4>___________________________</h4> </th>
<td class="text-danger" align="center"></td>

</tr>
</thead>
<tbody>
<tr>
<th  align="center"> <h4>'. $pvectl->pvd_nombre.'</h4></th>
<td class="text-danger" align="center"></td>
<th  align="center"><h4>'. Auth::user()->usr_name.'</h4> </th>
<td class="text-danger" align="center"></td>

<thead>
<tr>

<th  align="center"> Proveedor</th>
<td class="text-danger" align="center"></td>
<th  align="center">Auxiliar de Lavado  </th>
<td class="text-danger" align="center"></td>

</tr>
</thead>
</tbody>
</table>
            <div class="text-center">© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';
        $mpdf->SetHTMLHeader($header);

        $mpdf->SetHTMLFooter($footer);
        $footer2 =  '<div class="text-center">© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';



        $html1 = '
<h2 class="text-danger" align="center"> INFORME DE LAVADO #' .$id.'</h2>
<h4 class="text-danger" align="center"> TERMINAL '. $ptoctl->pto_nombre.'</h4><br>
        <h4>Proveedor: '. $pvectl->pvd_nombre.'</h4>
        <h4>Fecha finalización: '. $ctl->ctl_fecha_fin.'</h4>
        <h4>Auxiliar de Lavado: '. Auth::user()->usr_name.'</h4>
        <h4>Cordial Saludo:</h4><br>
        <p align="justify" >La presente acta representa la información del control de lavado No.' . $id. ' realizado en la fecha:
    ' . $ctl->ctl_fecha_inicio. ', hasta '. $ctl->ctl_fecha_inicio.' en la terminal de '. $ptoctl->pto_nombre.',
     realizado por el proveedor '. $pvectl->pvd_nombre.'. Con un total de ' . $numreg->count. ' registros. </p><br>


<table class="table table-hover" border ="1">
<thead>
<tr>
<th  align="center"> Número de Vehiculos Lavados </th>
<td class="text-danger" align="center">' . $numreg->count. '</td>

</tr>
</thead>
<tbody>
<tr>
<th align="center"> Número de Vehiculos entregados a satisfacción </th>
<td class="text-danger" align="center">' . $numaprob->count. '</td>

</tr>
<tr>
<th  align="center"> Número de Vehiculos con novedades</th>
<td class="text-danger" align="center">' . $numnoved->count. '</td>

</tr>

</tbody>
</table>
<table border ="0">
<thead>
<tr>
<th  class="text-danger" align="justify"> Observaciones del Control:</th>
<tbody>
<tr>
<th> </th>
</tbody>
</table>
<p align="justify" > '. $ctl->ctl_observacion.' </p>
<p class="text-danger" align="Left" ><b> Anexo: Relacion de moviles- Aprobación.</b></p>';








        foreach ($ctlregs as $ctlreg){

            $html3[] = $ctlreg->veh_movil;

            $htmlx[] = $ctlreg->reg_aprobacion;
           }
        $n = count($html3);
        $e = 11;
        $j = 0;
        $html6='<h4 class="text-danger" align="center"> ANEXO INFORME DE LAVADO #' .$id.'</h4>
<h5 class="text-danger" align="center"> TERMINAL '. $ptoctl->pto_nombre.'</h5>';
     for($i=0;$i<$n;$i++,$j++) {

             if ($htmlx[$i] == 'TRUE') {
                 $html2 = $html2 . $html3[$i] . ' [Aprobado] <br>';
             } else {
                 $html2 = $html2 . ' <b class ="text-danger">' . $html3[$i] . ' [No Aprobado]</b><br> ';
             }


         }









        //dd($html2);


        $mpdf->SetDisplayMode('fullpage');
        $stylesheet = file_get_contents('bower_components/bootstrap/dist/css/bootstrap.min.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html1);
        $mpdf->AddPage('L');
        $mpdf->SetHTMLFooter($footer2);
        $mpdf->WriteHTML($html6);
        $mpdf->SetColumns(5);
        $mpdf->WriteHTML($html2);
        $mpdf->Output('Reporte_control_'.$id.'.pdf', 'D');

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
        $adjunto = \DB::select('select * from sw_adjunto
        ');
        //dd($vehiculos);
        return view('lavado.updatereg',compact('menus','usr_name','acciones','vehiculos','id',
            'reg','idctl','pto_nombre','pvd_nombre','veh_nombre','ctl','reg_list','adjunto'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
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