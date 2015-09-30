<?php namespace App\Http\Controllers\Pqrs;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sw_registro_pqrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class excelreporteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $id =Auth::user()->usr_id;
        $menus = \DB::select('select * from fn_get_modules(?)',array($id));
        $tipo = 4;
        $ini = date("Y-m-d");
        $fin =  date("Y-m-d");


        return view('pqrs.reportes.prueba',compact('menus','data','channel','filtros','tipo','ini','fin'));
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
	public function store($id)
	{
        $idUser =Auth::user()->usr_id;
        $menus = \DB::select('select * from fn_get_modules(?)',array($idUser));


        return view('pqrs.reportes.prueba',compact('menus'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
    {
    	
    	//dd($request->all());

    	$tipo = $request->optradio;	

		$id =Auth::user()->usr_id;
        $menus = \DB::select('select * from
                              fn_get_modules(?)',array($id));

    	if ($tipo == 1){
		    			
    	$data= \DB::select('select * from
                            fn_incidencia_tmsa(?,?)',array($request->ini,$request->fin));


    	}elseif ($tipo == 2) {
    		$channel=\DB::select('select * from
                              fn_canal_pqrs(?,?)',array($request->ini,$request->fin));
    		# code...
    	}elseif ($tipo == 3) {
    		$filtros= \DB::select('select * from
                                fn_calendario(?,?)',array($request->ini,$request->fin));
    		# code...
    	}else{
    		$tipo = 4;
    	}
    	$ini = $request->ini;
    	$fin = $request->fin;

        

       return view('pqrs.reportes.prueba',compact('menus','data','channel','filtros','tipo','ini','fin'));
        		
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

	public function ExcelExport($optradio, $ini, $fin,Request $request)
{

    if ($optradio==1) {
         $results =\DB::select('select * from
                            fn_incidencia_tmsa(?,?)',array($ini,$fin));

         if(!empty($results)){

                Excel::create('Reporte-Transmilenio-'.$ini."-".$fin, function($excel) use($ini,$fin) {

                    $excel->sheet('Reporte-Transmilenio', function($sheet) use($ini,$fin) {

                        //$products = \DB::select('select * from  fn_inspeccion()');
                        $results =\DB::select('select * from
                                    fn_incidencia_tmsa(?,?)',array($ini,$fin));

                        $data = array();
                        foreach ($results as $result) {
                         $data[] = (array)$result;  

                     }
                     $sheet->cells('A1:B1', function($cells)
                     {
                        $cells->setBackground('#AF3838');
                        $cells->setFontColor('#FFFFFF');
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontWeight('bold');
                        $cells->setBorder('solid', 'none', 'none', 'solid');
                    });
                     $sheet->setAutoFilter('A1:B1');
                     $sheet->setAutoSize(true);

                     $sheet->fromArray($data);

                 });
                })->download('xlsx');
        }else{

        $request->session()->flash('status', 'No se encontraron coincidencias entre las fechas '.$ini.' y '.$fin);
        return redirect()->back();
    }
}
if ($optradio==2) {
            $results =\DB::select('select * from
                              fn_canal(?,?)',array($ini,$fin));
        if(!empty($results)){

                    Excel::create('Reporte-Canales-'.$ini."-".$fin, function($excel) use($ini,$fin,$results){

                        $excel->sheet('Reporte-Canales', function($sheet) use($ini,$fin,$results){

                            //$products = \DB::select('select * from  fn_inspeccion()');
                            

                            $data = array();
                            foreach ($results as $result) {
                             $data[] = (array)$result;  

                         }
                         $sheet->cells('A1:B1', function($cells)
                         {
                            $cells->setBackground('#03A9F4');
                            $cells->setFontColor('#FFFFFF');
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontWeight('bold');
                            $cells->setBorder('solid', 'none', 'none', 'solid');
                        });
                         $sheet->setAutoFilter('A1:B1');
                         $sheet->setAutoSize(true);

                         $sheet->fromArray($data);

                     });
                    })->download('xlsx');
        }else{

        $request->session()->flash('status', 'No se encontraron coincidencias entre las fechas '.$ini.' y '.$fin);
        return redirect()->back();
    }
}elseif ($optradio==3) {

	 $results =\DB::select('select * from
                                fn_calendario(?,?)',array($ini,$fin));


    if(!empty($results)){

        Excel::create('Reporte-Calendario-'.$ini."-".$fin, function($excel) use($ini,$fin,$results){

                $excel->sheet('Reporte-Calendario', function($sheet) use($ini,$fin,$results){

                    //$products = \DB::select('select * from  fn_inspeccion()');
                   

                    $data = array();
                    foreach ($results as $result) {
                     $data[] = (array)$result;  

                 }
                 $sheet->cells('A1:L1', function($cells)
                 {
                    $cells->setBackground('#5CB85C');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setBorder('solid', 'none', 'none', 'solid');
                });
                 $sheet->setAutoFilter('A1:L1');
                 $sheet->setAutoSize(true);

                 $sheet->fromArray($data);

             });
            })->download('xlsx');
        
    }else{

        $request->session()->flash('status', 'No se encontraron coincidencias entre las fechas '.$ini.' y '.$fin);
        return redirect()->back();
    }
}
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
