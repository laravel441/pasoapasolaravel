<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_usuario;
use App\sw_ctl_lavado;
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
	public function create()
	{
		//
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
