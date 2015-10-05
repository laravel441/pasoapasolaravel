<?php namespace App\Http\Controllers\Pqrs;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historialController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $id =Auth::user()->usr_id;
        $menus = \DB::select('select * from fn_get_modules(?)',array($id));
        $historico  = \DB::select('select * from fn_historicos_pqrs()');
        return view('pqrs.historicos.indexhisto',compact('menus','historico'));
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

        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));


        $hist  = \DB::select('select * from fn_prueba_historicos(?)',array($id));
        $adj_pqrs = \DB::select('select adj_id as id, adj_ruta as ruta, adj_nombre as nombre from sw_adjuntos_pqrs where adj_pqrs_id ='.$id);
        $formato = array();
        foreach ($adj_pqrs as $archivo) {

            $formato[] = explode('.', $archivo->nombre);
        }
        return view('pqrs.historicos.adicional', compact('menus','hist','adj_pqrs','formato'));
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
