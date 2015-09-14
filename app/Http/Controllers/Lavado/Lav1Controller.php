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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;



use App\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use mPDF;
use Maatwebsite\Excel\Facades\Excel;
use DateInterval;
use Carbon\Carbon;
use Faker\Factory as Faker;


class Lav1Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));

        $ctls = sw_ctl_lavado::join('sw_usuarios AS su','sw_ctl_lavado.ctl_usr_id','=','su.usr_id')
            ->join('sw_patio AS spatio', 'sw_ctl_lavado.ctl_pto_id', '=', 'spatio.pto_id')
            ->join('sw_proveedor AS sprovee', 'sw_ctl_lavado.ctl_pve_an8', '=', 'sprovee.pvd_an8')
            ->select('sw_ctl_lavado.ctl_id','su.usr_id','su.usr_name','spatio.pto_nombre',
                'sw_ctl_lavado.ctl_fecha_inicio','sw_ctl_lavado.ctl_fecha_fin','sprovee.pvd_nombre')
            //->where ('ctl_usr_id',$id)
            ->orderBY('ctl_id', 'DESC')
            ->get();




//dd($ctls);


        $usr_name = Auth::user()->usr_name ;

        $patios = \DB::select('select * from sw_patio where pto_bandera =\'' .'TRUE'. '\'');

        $proveedores = \DB::select('select * from sw_proveedor where pvd_mpv_id = 1 '); //proveedores Lavado

        return view('lavado.admin.index',compact('menus','ctls','patios','proveedores','usr_name'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $regis = sw_registro_lavado::join('sw_ctl_lavado AS ctl','sw_registro_lavado.reg_ctl_id','=','ctl.ctl_id')
            ->join('sw_vehiculo AS sveh', 'sw_registro_lavado.reg_veh_id', '=', 'sveh.veh_id')
            ->select('sw_registro_lavado.reg_id','sw_registro_lavado.reg_ctl_id','sveh.veh_id','sveh.veh_movil',
                'sw_registro_lavado.reg_tanqueo','sw_registro_lavado.reg_observacion','sw_registro_lavado.reg_aprobacion',
                'sw_registro_lavado.reg_creado_en')

            ->where ('reg_ctl_id',$id)
            ->orderBY('reg_id', 'DESC')

            ->first();

        if (empty($regis)){
            Session::flash('message2', 'No tiene aún registros creados');
            return redirect()->back();
        }

        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));



        $regs = sw_registro_lavado::join('sw_ctl_lavado AS ctl','sw_registro_lavado.reg_ctl_id','=','ctl.ctl_id')
            ->join('sw_vehiculo AS sveh', 'sw_registro_lavado.reg_veh_id', '=', 'sveh.veh_id')
            ->select('sw_registro_lavado.reg_id','sw_registro_lavado.reg_ctl_id','sveh.veh_id','sveh.veh_movil',
                'sw_registro_lavado.reg_tanqueo','sw_registro_lavado.reg_observacion','sw_registro_lavado.reg_aprobacion',
                'sw_registro_lavado.reg_creado_en')

            ->where ('reg_ctl_id',$id)
            ->orderBY('reg_id', 'DESC')

            ->get();

        //dd($regs);

        $reg_list = \DB::select('
                           select * from
                            fn_reg_list (?)',array($id));
        //dd($reg_list);

        $regctl = $regs[0];
        $idctl = $regctl->reg_ctl_id;

        //dd($idctl);
        $ctls = sw_ctl_lavado::find($idctl);

        $ptoid = $ctls->ctl_pto_id;
        $pveid = $ctls->ctl_pve_an8;
        //dd($ctls->ctl_observacion);

        $ptoctls = \DB::select('select pto_nombre from sw_patio where pto_id ='.$ptoid);
        $pvectls = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pveid);

        $ptoctl= $ptoctls[0];
        $pvectl= $pvectls[0];

        $usr_name = Auth::user()->usr_name ;

        $patios = \DB::select('select * from sw_patio where pto_bandera =\'' .'TRUE'. '\'');
        $proveedores = \DB::select('select * from sw_proveedor where pvd_mpv_id = 1 ');
        $adjunto = \DB::select('select * from sw_adjunto
        ');

        return view('lavado.admin.indexreg',compact('menus','ctls','usr_name','ptoctl','pvectl','regs','reg_list','id','adjunto'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{


        $ctl=sw_ctl_lavado::find($id);
       //dd($ctl);


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
<th  align="center"><h4>'. $ctl->ctl_creado_por.'</h4> </th>
<td class="text-danger" align="center"></td>

<thead>
<tr>

<th  align="center"> Proveedor</th>
<td class="text-danger" align="center"></td>
<th  align="center">Supervisor de Lavado  </th>
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
        <h4>Supervisor de Lavado: '. $ctl->ctl_creado_por.'</h4>
        <h4>Cordial Saludo:</h4><br>
        <p align="justify" >La presente acta representa la información del control de lavado No.' . $id. ' realizado en la fecha:
    ' . $ctl->ctl_fecha_inicio. ', hasta '. $ctl->ctl_fecha_fin.' en la terminal de '. $ptoctl->pto_nombre.',
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
        $mpdf->Output('Reporte_control_'.$id.'.pdf', 'I');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//dd($id);
	}

    public function exceles($id)
    {

        $regs = sw_registro_lavado::join('sw_ctl_lavado AS ctl','sw_registro_lavado.reg_ctl_id','=','ctl.ctl_id')
            ->join('sw_vehiculo AS sveh', 'sw_registro_lavado.reg_veh_id', '=', 'sveh.veh_id')
            ->select('sw_registro_lavado.reg_id','sw_registro_lavado.reg_ctl_id','sveh.veh_id','sveh.veh_movil',
                'sw_registro_lavado.reg_tanqueo','sw_registro_lavado.reg_observacion','sw_registro_lavado.reg_aprobacion',
                'sw_registro_lavado.reg_creado_por','sw_registro_lavado.reg_creado_en')

            ->where ('reg_ctl_id',$id)
            ->orderBY('reg_id', 'DESC')

            ->get();

        //dd($regs);
        $ctl = sw_ctl_lavado::find($id);
           Excel::create('Reporte_'.$ctl->ctl_id, function($excel) use($regs,$id)
            {
                $excel->sheet('Control '.$id, function($sheet) use($regs,$id)
                {
                   $sheet->mergeCells('B1:E1');

                    $sheet->setBorder('A2:F2', 'thin');

                    $sheet->cells('A2:F2', function($cells)
                    {
                        $cells->setBackground('#009688');
                        $cells->setFontColor('#FFFFFF');
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                    $sheet->setAutoFilter('A2:E2');
                    $sheet->setBorder('A1:F1', 'thin');

                    $sheet->cells('B1:E1', function($cells)
                    {
                        $cells->setBackground('#009688');
                        $cells->setFontColor('#FFFFFF');
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontSize(24);
                        $cells->setFont(array(
                            'family'     => 'Arial',
                            'size'       => '26',
                            'bold'       =>  false
                        ));
                    });



                    $sheet->setAutoSize(true);
                    $sheet->setWidth(array
                        (
                            'A' => '10',
                            'B' => '20',
                            'C' => '20',
                            'D' => '80',
                            'E' => '20',
                            'F' => '20'

                        )
                    );

                    $sheet->setHeight(array
                        (
                            '1' => '30',
                            '2' => '20'
                        )
                    );


                    $data=[];


                    array_push($data, array('ID', '# De Movil', 'Tanqueo', 'Observación', 'Aprobación', 'Creado Por'));

                    $sheet->fromArray($data, null, 'A2', false, false);
                    $sheet->row('1', array(  //Impríme una fila en el excel con la información del registro recorrido.
                        '','Reporte del Control # '.$id,'','','',
                    ));

                    $r = 3; //Indicador de la fila para excel.
                    foreach($regs as $reg){   //Reccorre los registros encontrados.

                        if ($reg->reg_tanqueo == 1){
                            $tanqueo = "Interno";
                        }else{
                            $tanqueo = "Externo";
                        }
                        if ($reg->reg_aprobacion == 1){
                            $aproba = "Si";
                        }else{
                            $aproba = "No";
                        }

                        $sheet->row($r, array(  //Impríme una fila en el excel con la información del registro recorrido.
                            $reg->reg_id, $reg->veh_movil, $tanqueo, $reg->reg_observacion, $aproba, $reg->reg_creado_por
                        ));
                        $r++;
                    }
                });
            })->download('xlsx');

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
