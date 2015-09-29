<?php namespace App\Http\Controllers\Remuneracion;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sw_usuario;
use Illuminate\Support\Facades\Auth;
use Excel;

use Illuminate\Http\Request;

class BusquedaReportesController extends Controller {

	/**
	 * Visualiza la p�gina de inicio.
	 *
	 * @return Response
	 */
	public function index(){
        $meses = array();
        $periodo = array();
		return $this->indexdisabled("","","",array(),array(),array()); //Env�a los valores por defecto al formulario de inicio
	}

    /**
     * M�todo encargado de visualizar la pagina de inicio.
     *
     * Recibe los valores por parametro y los visualiza para el env�o al formulario,
     *
     * @param $year string
     * @param $month string
     * @param $period array()
     * @param $meses array()
     * @param $rem array()
     *
     * @return Response
     */

    public function indexDisabled($year,$month,$period,$meses, $periodo,$rem){
        $id =Auth::user()->usr_id; //Toma el id del usuario.
        //Busqueda de los menus asignados al usuario.
        $menus = \DB::select('select * from
                            fn_get_modules(?)',array($id));
        //Busqueda de los registros de los a�os correspondientes a los cargues realizados.
        $anios = \DB::select('SELECT  EXTRACT(Y FROM car_fecha_inicio) anios
                              FROM    sw_remuneracion_cargue_archivos
                              WHERE   car_tip_id = 2
                              GROUP BY
                                    anios
                              ORDER BY
                                    anios');
       // dd($period);

        //Variable que permite validar la habilitaci�n del bot�n de genraci�n de reporte.
        $disable = false;

        return view( 'remuneracion.reportes.index',compact('menus','year','month','period','anios','meses','periodo','rem'));
    }

	/**
	 * M�todo encargado de la habilitacion y las listas de busqueda de los filtros.
     *
     * Se recibe el Request como parametro para la busqeda y habilitacion de las listas correpondintes a l
	 *
     * @param Request $request
     *
	 * @return Response
	 */
	public function store(Request $request)	{
        //B�sca lor meses los cuales han sido cargados correspondientes al a�o seleccionado.
        $meses = \DB::select("SELECT 	EXTRACT(Month FROM car_fecha_inicio) num_mes,
                                    to_char(car_fecha_inicio, 'TMMonth') mes
                              FROM 	sw_remuneracion_cargue_archivos
                              WHERE	to_char(car_fecha_inicio,'YYYY') = '".$request->anio_id."'
                              AND	car_tip_id = 2
                              GROUP BY
                                    num_mes,
                                    mes
                              ORDER BY
                                    num_mes;");
        $periodo = array();
        if(array_key_exists('mes_id', $request->all())){    //Valida si mes_id existe en el $request.

            //Se realiz� la b�squeda de los per�odos correspondientes al mes y al a�o seleccionados.
            $periodo = \DB::select("SELECT 	to_char(car_fecha_inicio, 'YYYY-MM') anio,
                                    to_char(car_fecha_inicio, 'DD TMMonth YYYY') fecha_inicio,
                                    to_char(car_fecha_fin, 'DD TMMonth YYYY') fecha_fin
                                FROM 	sw_remuneracion_cargue_archivos
                                WHERE	car_tip_id = 2
                                AND	to_char(car_fecha_inicio, 'YYYY-TMMonth') = '".$request->anio_id."-". $request->mes_id."'");

            if($request->mes_id == $request->m){    //Validaci�n correspondiente al cambio de mes.

                if(array_key_exists('per_id', $request->all())){    //Se valida si por_id existe en el $request

                    if($request->per_id == $request->p){    //Validaci�n del cambio de per�odo.
                        if($request->mes_id == $request->m and $request->per_id == $request->p){    //Validaci�n del cambio de per�odo y mes.
                            return $this->indexdisabled($request->anio_id,"","",$meses,$periodo,array());
                        }
                        return $this->indexdisabled($request->anio_id,$request->mes_id,"",$meses,$periodo,array());
                    } else {
                        return $this->indexdisabled($request->anio_id,$request->mes_id,$request->per_id,$meses,$periodo,array());
                    }
                }
                return $this->indexdisabled($request->anio_id,"","",$meses,$periodo,array());

            } else {
                return $this->indexdisabled($request->anio_id,$request->mes_id,"",$meses,$periodo,array());
            }

        }
        return $this->indexdisabled($request->anio_id,"","",$meses,$periodo,array());
	}

	/**
	 * M�todo encargado de cargar la lista de Remuneraciones correspondiente al per�odo seleccionado.     *
     *
	 * De acuerdo al a�o, mes y per�odo seleccionado realiza la busqueda de los valores de remuneraci�n correspondientes.
	 * @param  Request $request
	 * @return Response
	 */
	public function update(Request $request){

        //dd($request->all());

		$date = $request->valores_buscar[0]."-".$request->valores_buscar[1]."-".substr($request->valores_buscar[2],0,2);    //Concatenaci�n de la fecha seleccionada.
        $rem = \DB::select("SELECT * FROM fn_remuneraciones_reporte('".$date."')"); //B�squeda de los valores.
//dd($date,$rem);
        if(count($rem) > 0){

          //Validaci�n de la cantidad de registros encontrados.
            return $this->indexdisabled($request->valores_buscar[0],$request->valores_buscar[1],$request->valores_buscar[2],array(),array(),$rem);
        } else {
            Session::flash('message3', 'No se encontrar&oacute;n registros correspondientes al per&iacute;odo seleccionado');
            return redirect()->back();
        }

	}

    /**
     * M�todo encargado de generar el reporte final.     *
     *
     * De acuerdo al per�odo seleccionado busca y exporta los datos a formato excel(xlsx).
     *
     * @param  Request $request
     * @return Response
     */

    public function generarReporte(Request $request){

        //B�squeda del archivo cargado correspondientes al per�odo seleccionado.

        //dd($request->all());
        $periodo = explode(" ", $request->p);

        $fecha_inicio = $periodo[2].'-'.$periodo[1].'-'.$periodo[0];
        //dd($fecha_inicio);
        $rem = \DB::select("SELECT * FROM fn_remuneraciones_reporte('".$fecha_inicio."')");
        $cuentas = \DB::select("SELECT tip_valor2 FROM sw_detalle_tipos WHERE tip_mtp_id = 13");
        $fidu = \DB::select("SELECT tip_valor3, tip_valor2 FROM sw_detalle_tipos WHERE tip_nombre = 'TER'");

        //dd($rem,$cuentas,$fidu);

        $report = \DB::select("SELECT 	*
                               FROM	sw_remuneracion_cargue_archivos
                               WHERE	car_tip_id = 2
                               AND	to_char(car_fecha_inicio, 'YYYY-TMMonth-dd') =   '$fecha_inicio' ");
        //Se b�scan los registros correpondientes al per�odo seleccionado.
        //dd($report);
        $rowsReport = \DB::table('sw_remuneracion_reporte_jde')
            ->where('rjd_fecha','>=', $report[0]->car_fecha_inicio)
            ->where('rjd_fecha','<=', $report[0]->car_fecha_fin)
            ->get();
        //dd($rowsReport);
        Excel::create('ReporteSW '.$request->p, function($excel) use($rowsReport,$rem,$cuentas,$fidu) {  //Generaci�n del Reporte Final

            $excel->sheet('Reporte', function($sheet) use($rowsReport,$rem,$cuentas,$fidu) {    //Nombre de la hoja generada.

                //Estilo de las columnas.
                $sheet->setBorder('A1:I1', 'thin');

                $sheet->cells('A1:I1', function($cells)
                {
                    $cells->setBackground('#009688');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->setAutoFilter('A1:I1');
                $sheet->setBorder('A1:I1', 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array
                    (
                        'A' => '15',
                        'B' => '25',
                        'C' => '20',
                        'D' => '15',
                        'E' => '15',
                        'F' => '20',
                        'G' => '15',
                        'H' => '20',
                        'I' => '20'

                    )
                );

                $data=[];
                //Se agregan los nombres de las columnas.
                array_push($data, array('Linea', 'Cuenta', 'Importe', 'T. Aux', 'LM Aux', 'Unidades', 'UM', 'Active', 'Período'));
                $sheet->fromArray($data, null, 'A1', false, false);

                $r = 2; //Indicador de la fila para excel.
                foreach($rowsReport as $reg){   //Reccorre los registros encontrados.




//                    $sheet->cells('A'.$r.':I'.$r, function($cells)
//                    {
//                        $cells->setBackground('#EBF1DE');
//                        $cells->setFontColor('#000000');
//                        $cells->setAlignment('center');
//                        $cells->setValignment('center');
//                    });
//                    $sheet->setBorder('A'.$r.':I'.$r, 'thin');


                    $sheet->row($r, array(  //Impr�me una fila en el excel con la informaci�n del registro recorrido.


                        $reg->rjd_rut_nombre, $reg->rjd_cuenta, $reg->rjd_importe, $reg->rjd_auxiliar, $reg->rjd_linea, $reg->rjd_cantidad, $reg->rjd_unidad_medida, $reg->rjd_veh_movil, $reg->rjd_fecha
                    ));
                    $r++;
                }
                $s = $r+1;

                $sheet->cells('A'.$s.':K'.$s, function($cells)
                {
                    $cells->setBackground('#009688');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->setWidth(array
                    (
                        'J' => '20',
                        'K' => '20',
                        'L' => '20'

                    )
                );
                $sheet->setBorder('A'.$s.':K'.$s, 'thin');

                $sheet->row($s, array(  'Zona', 'Periodo','Cuenta', 'T. Aux','LM Aux','GMF', 'Renta', 'ICA', 'CREE', 'Total Retenciones', 'Total Recaudo' ));
                $t = $s+1;
                $i=0;
                foreach($rem as $reg){   //Reccorre los registros encontrados.
                    $sheet->row($t, array(  //Impr�me una fila en el excel con la informaci�n del registro recorrido.


                        $reg->zon_nombre, $reg->fecha_inicio.'-'.$reg->fecha_final, $cuentas[$i]->tip_valor2, $fidu[0]->tip_valor2,$fidu[0]->tip_valor3,
                        $reg->valor_gravamen, $reg->valor_renta, $reg->valor_ica,$reg->valor_cree,$reg->valor_total,$reg->total_recaudo
                    ));
                    $t++;
                    $i++;
                }



            });
        })->download('xlsx'); //Exportaci�n del archivo generado.


    }
}
