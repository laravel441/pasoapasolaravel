<?php

namespace App\Http\Controllers\Remuneracion;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Session;
use PhpSpec\Exception\Exception;
use App\sw_remuneracion_asignacion_km_dia;
use App\sw_remuneracion_cargue_archivos;
use App\sw_remuneracion_detalle_dia;
use App\sw_remuneracion_detalle_semana;
use App\sw_remuneracion_ruta;
use App\sw_remuneracion_ruta_detalle;
use App\sw_remuneracion_total_dia;
use App\sw_remuneracion_total_semana;
use App\sw_remuneracion_total_semana_detalle;
use App\sw_remuneracion_zona_semana;
use App\sw_remuneracion_zona_dia;
use App\sw_remuneraciones;
use App\sw_remuneracion_reporte_jde;
use DateTime;

class CargueKmsController extends Controller {
	
	/**
	 * M�todo que permite visualizar la p�gina de inicio
	 *
	 * Se encarga de enviar los parametros por defecto para y visualizar el formulario de carga
	 * de formularios.
	 *
	 * @return Response
	 */
	
	public function index() {
		$data = array();
		$arrayHeader = array();
        $header = array();
        $arreglob = array();
		return $this->indexdisabled(1, 1,$data, $arrayHeader,$header,$arreglob); //Ejecuta el m�todo enviado los parametros por defecto de inicio.
		
	}

	/**
	 * M�todo encargado de visualizar la pagina de inicio. De acuerdo al par�metro que
	 * reciba, bloquea o desbloquea algunos elementos de la vista
	 *
	 * @param int $disBtn
	 * @param int $disBtnRem
	 * @param array $data
	 * @param array $arrayHeader
	 * @return Response
	 */
	public function indexDisabled($disBtn, $disBtnRem, $data, $arrayHeader, $header,$arreglob){
		$id =Auth::user()->usr_id;
		$menus = \DB::select('select * from
                            fn_get_modules(?)',array($id));
		$valuesRem = \DB::select('SELECT * FROM sw_detalle_tipos WHERE tip_mtp_id = 4');

		return view( 'remuneracion.km.index', compact('menus','disBtn','disBtnRem','data','arrayHeader','valuesRem','header','arreglob') );
	}

	/**
	 * M�todo que permite el cargue del archivo de Kil�metros
	 *
	 * Metodo que realiza la validaci�n del archivo cargado. Debe tener la estructura adecuada para
	 * ser visualizada posteriormente en la tabla de la ventana emergente.
	 *
	 * @param Request $request
	 *
	 * @return indexdisabled()
	 * @return back()
	 */
	public function store(Request $request) {
		
		//dd($request->all());

        $tmp_name = $_FILES['rem']['tmp_name'][0];
		$name = $_FILES['rem']['name'][0];
//		$dir =  \DB::select('SELECT tip_valor2 FROM sw_detalle_tipos WHERE tip_nombre = \'DIRREM\'');
		$dir = 'Z:'.rtrim('\ ');
		$uploads_dir = $dir.$name;
        //dd($uploads_dir);
					
		if(move_uploaded_file($tmp_name, $uploads_dir)){
		//Copia el archivo en una ruta del servidor para poder leerlo posteriormente.

			if($uploads_dir != ""){
			//Validaci�n de la existencia de la ruta del archivo.
				$firstrow = array();
				$results = array();
                $header = array();
				Excel::load($uploads_dir, function($reader) use (&$firstrow, &$results, &$header) {
					//Funci�n encargada de leer el archivo cargado.
					$results = $reader->all();
				});





				if(count($results)>0){
					//Asignacion del primer registro, el cual corresponde al header de la tabla
					$firstrow = $results[0];

					$firstrow = iterator_to_array($firstrow);

				}
                //dd($firstrow);
				//$firstrow3 =	array_change_key_case($firstrow, CASE_UPPER);
                $x = array_keys($firstrow);
                $y = ['ruta','tipo','vehiculo','placa'];



                for ($i = 0; $i<12;$i++){
                    if ($i<4){
                        $arregloa[] = $x[$i];
                    }elseif (3 < $i and $i <11){
                        $z []=$x[$i];
                    }else{
                        $arregloc[] = $x[$i];
                    }

                }
                //dd($arregloa,$z,$arregloc);
                foreach($z as $a){
                    $b = explode("_", $a);
                   if (isset($b[0])&& isset($b[1])&& isset($b[2])){
                       $arreglob[] = $b[0].'-'.$b[1].'-'.$b[2];
                   }else{
                       Session::flash('message3', 'Las fechas no tienen un formato valido');
                       return redirect()->back();
                }
                }

                //dd('Holis2');
                $arreglod = array_merge($arregloa,$arreglob);
                $header = array_merge($arreglod,$arregloc);
                //dd($header,array_keys($firstrow));

				if ($x[0] == $y[0]
                    && $x[1] == $y[1]
                    && $x[2] == $y[2]
                    && $x[3] == $y[3]) {
					//Validaci�n de la estructura del archivo. Solo permite ser visualizados los datos en caso en que la estructura del array
					//corresponda al requerido.
                    //dd($results);
					return $this->indexdisabled(2, 1,$results, array_keys($firstrow),$header,$arreglob);
				} else {
					Session::flash('message3', 'La estructura del archivo no es valida');
					return redirect()->back();
				}
				

				
			}				
			
		}
			
	}

	/**
	 * M�todo que permite el cargue del archivo de Remuneraci�n
	 *
	 * Metodo que realiza la validaci�n del archivo cargado. Debe tener la estructura adecuada para
	 * ser visualizada posteriormente en la tabla de la ventana emergente.
	 *
	 * @param Reuest $request
	 *
	 * @return indexdisabled()
	 * @return back()
	 */

	public function storerem(Request $request) {
		//dd($request->all());
		$tmp_name = $_FILES['remuneracion']['tmp_name'][0];
		$name = $_FILES['remuneracion']['name'][0];
        //		$dir =  \DB::select('SELECT tip_valor2 FROM sw_detalle_tipos WHERE tip_nombre = \'DIRREM\'');
        $dir = 'Z:'.rtrim('\ ');
		$uploads_dir = $dir.$name;

		if(move_uploaded_file($tmp_name, $uploads_dir)){
			//Copia del archivo cargado en una ruta del servidor.

			if($uploads_dir != ""){
				//Validaci�n de la existencia de la ruta del archivo cargado.
				$firstrow = array();
				$results = array();
                $header = array();


				Excel::load($uploads_dir, function($reader) use (&$firstrow, &$results, &$header ) {
					//Funci�n que realiza la lectura del archivo cargado.
					$results = $reader->all();
				});

				if(count($results)>0){
					//Se asigna el primer registro a una variable. El cual corresponde a los header de la tabla de Remuneraci�n.
					$firstrow = $results[0];
					$firstrow = iterator_to_array($firstrow);
				}

				//dd($firstrow);
				//$firstrow =	array_change_key_case($firstrow, CASE_UPPER);

                $x = array_keys($firstrow);
                $y = ['indicador','tipo','subtipo','zona','ruta','lunes','martes','miercoles','jueves','viernes','sabado','domingo','total'];
                //dd($x,$y);

                $r = array_values($firstrow);


                for ($i = 0; $i<13;$i++){
                    if ($i<5){
                        $arregloa[] = $x[$i];
                    }elseif (4 < $i and $i <13) {
                        $arreglob [] = $x[$i];
                        $arregloc [] = $r[$i];
                    }else{
                         }



                }
                foreach($arregloc as $fec_validas){

                    if (isset ($fec_validas)){

                    }else{
                        Session::flash('message3', 'El campo fecha esta vacio');
                        return redirect()->back();
                    }
                }

                //dd($firstrow,$arregloa,$arreglob,$arregloc);




                $arreglod = array_merge($arregloa,$arreglob);
                $header = array_merge($arreglod,$arregloc);


                if ($x[0] == $y[0]
                    && $x[1] == $y[1]
                    && $x[2] == $y[2]
                    && $x[3] == $y[3]
                    && $x[4] == $y[4]
                    && $x[5] == $y[5]
                    && $x[6] == $y[6]
                    && $x[7] == $y[7]
                    && $x[8] == $y[8]
                    && $x[9] == $y[9]
                    && $x[10] == $y[10]
                    && $x[11] == $y[11]){
					//Validaci�n de la estructura del registro. Si corresponde al solicitado permitira visualizar la informaci�n en
					//la tabla de la vista.
					//dd(array_keys($firstrow));
                    //dd($results [0]->LUNES);
					return $this->indexdisabled(1, 2, $results, array_keys($firstrow),$header,$arregloc);
				} else {
					Session::flash('message3', 'La estructura del archivo no es valida');
					return redirect()->back();
				}

				//dd($rows);

			}

		}
	}

	/**
	 * Metodo encargado de formatear fechas.
	 *
	 * Recibe una variable de tipo date y le da el formato requerido para el almacenamiento en la
	 * base de datos.
	 *
	 * @param date $date
	 * @return Date
	 */
	function formatDate($date){
		$dateReg = str_replace('/', '-', $date);
		$datefor = date("Y-m-d", strtotime($dateReg));
		return $datefor;
	}

	/**
	 * M�todo encargado de realizar el almacenamiento en la BD del informe de Kil�metros.
	 *
	 * De acuerdo a la informaci�n visualizada proveniente del archivo cargado, se realiza el almacenamiento en
	 * la BD.
	 *
	 * @return Response
	 */
	public function update(Request $request) {

        //dd('kms');
        set_time_limit(0);

       $fechas = $request->fechas;
		$rows = json_decode($request->rows); //Se toma la data del request.
//dd($rows);
		$firs = $request->firtsRow;	//Se toma la variable firstRow del request.


		$dateIni = $this->formatDate($fechas[0]); //Se formatean las fechas
		$dateFin = $this->formatDate($fechas[6]); //Se formatean las fechas
		//dd($dateIni, $dateFin);
		$arc = \DB::table('sw_remuneracion_cargue_archivos')	//De acuerdo a las fechas, se b�sca si se ha cargado el archivo anteriormente.
			->where('car_fecha_inicio','>=', $dateIni)
			->where('car_fecha_fin','<=', $dateFin)
            ->where ('car_tip_id',1)
			->get();


		$archivo = new sw_remuneracion_cargue_archivos;
		if(empty($arc)){
			//S� el archivo no se ha cargado anteriormente, se crear� el registro
			$archivo->car_fecha_inicio = $dateIni;
			$archivo->car_tip_id = 1;
			$archivo->car_fecha_inicio = $dateIni;
			$archivo->car_fecha_fin = $dateFin;
			$archivo->car_creado_en = new DateTime();
			$archivo->car_creado_por = Auth::user()->usr_name;
			$archivo->save();


		} else {
			//S� ya se encuentra, se modifica el registro.
			\DB::table('sw_remuneracion_cargue_archivos')
				->where('car_id', $arc[0]->car_id)
				->update(['car_modificado_en' => new DateTime(), 'car_modificado_por' => Auth::user()->usr_name]);

		}



		$affectedRows = \DB::table('sw_remuneracion_asignacion_km_dia') //Se eliminan los registros del informe de Kil�metros almacenados.
			->where('akd_fecha','>=', $dateIni)
			->where('akd_fecha','<=', $dateFin)
			->count();

        if ($affectedRows > 0){
            //Se restaura la secuencia de la tabla sw_remuneracion_asignacion_km_dia.
            $deleterows = \DB::table('sw_remuneracion_asignacion_km_dia') //Se eliminan los registros del informe de Kil�metros almacenados.
            ->where('akd_fecha','>=', $dateIni)
                ->where('akd_fecha','<=', $dateFin)
                ->delete();
            //\DB::select('ALTER SEQUENCE sw_remuneracion_asignacion_km_dia_akd_id_seq RESTART ');
        }
       // dd($dateIni,$dateFin,$affectedRows);


        //dd($affectedRows);



		//dd($affectedRows);
//dd($rows);

        foreach($fechas as $fe){
            $b = explode("-", $fe);
            $date2[] = $b[0].'_'.$b[1].'_'.$b[2];
        }

        //dd($date);

            foreach($rows as $key => $reg){

                //Se recorren los registros para el almacenamiento en la BD.
                for($x = 0; $x <= 6; $x++){
                    $date = $fechas[$x]; //Asigna la fecha seg�n la posici�n del arrlego.
                    if($x < 7){
                        //Valida la posici�n del d�a el cual ser� almacenado.

                            $vacio = trim($reg->tipo);
                        if ($vacio == 'BUS'||
                            $vacio == 'BTA'||
                            $vacio == 'MCB'||
                            $vacio == 'PDR'

                                                ){

                                                if (is_numeric($reg->$date2[$x])){
                                                $asigDia = new sw_remuneracion_asignacion_km_dia;
                                                $asigDia->akd_rut_nombre = trim($reg->ruta);
                                                $asigDia->akd_tip_acronimo = trim($reg->tipo);
                                                $asigDia->akd_veh_movil = trim($reg->vehiculo);
                                                $asigDia->akd_veh_placa = trim($reg->placa);
                                                $asigDia->akd_fecha = $this->formatDate($date);
                                                $asigDia->akd_kilometraje = $reg->$date2[$x];
                                                $asigDia->akd_creado_en = new DateTime();
                                                $asigDia->akd_creado_por = Auth::user()->usr_name;

                                                $asigDia->save();

                                            }else{
                                                Session::flash('message3', 'Los datos deben ser n&uacute;mericos: Fila: ('.$reg->ruta.'-'.$reg->placa.'-'.$date.'-'.$reg->$date2[$x].')');
                                                return redirect()->back();
                                            }
                        }else{
                            Session::flash('message3', 'El tipo de veh&iacute;culo no es valido: Fila: ('.$reg->ruta.'-'.$reg->placa.'-'.$date.'-'.$reg->$date2[$x].')');
                            return redirect()->back();
                        }

                            //Almacena el registro
                            //echo "Guard�";



                }
            }
        }

		Session::flash('message2', 'Informe de Kil&oacute;metros cargado correctamente');
		return redirect()->back();

	}

	/**
	 * M�todo encargado de realizar el almacenamiento en la BD del informe de Remuneraciones.
	 *
	 * De acuerdo a la informaci�n visualizada proveniente del archivo cargado, se realiz� el almacenamiento en
	 * la BD.
	 *
	 * @param Request $request
	 * @return Response
	 */

	public function updateRem(Request $request) {

		$rows = json_decode($request->rowsRem);	//Asigna la informaci�n visualiza.
		$frow = $rows[0];	//Asigna el primer registro de la informaci�n.
		$dateIni = $this->formatDate($frow->lunes);	//Formatea la fecha inicio.
		$dateFin = $this->formatDate($frow->domingo);	//Formatea la fecha fin.
		//dd($dateIni, $dateFin);
		$arc = \DB::table('sw_remuneracion_asignacion_km_dia')	//Se b�scan registros del informe de Kil�metros, correspondientes a las fechas del informe de Remuneraciones.
					->where('akd_fecha','>=', $dateIni)
					->where('akd_fecha','<=', $dateFin)
					->count();

		if($arc>0){
			$complete = true;
			//Se valida que existan registros.
			$arch = \DB::table('sw_remuneracion_cargue_archivos')	//Se b�scan registros que coincidan con el informque cargado.
						->where('car_fecha_inicio','>=', $dateIni)
						->where('car_fecha_fin','<=', $dateFin)
						->where('car_tip_id','=',2)
						->get();

            //dd($arch);
			$archivo = new sw_remuneracion_cargue_archivos;
			$idArc = 0;
			if(empty($arch)){

				//Validaci�n de la existencia de registros que coincidan con las fechas del informe cargado.
				//S� no existe, se crear� el registro.
				$archivo->car_tip_id = 2;	//El n�mero 2, corresponde a archivo de tipo Remuneraci�n
				$archivo->car_fecha_inicio = $dateIni;
				$archivo->car_fecha_fin = $dateFin;
				$archivo->car_creado_en = new DateTime();
				$archivo->car_creado_por = Auth::user()->usr_name;
				$archivo->save();
                //dd('No existe');
				$idArc = $archivo->car_id;

			} else {

				//S� existe, se modificar� el registro.
				$idArc = $arch[0]->car_id;
				\DB::table('sw_remuneracion_cargue_archivos')	//Actualizaci�n del registro existente
					->where('car_id', $idArc)
					->update(['car_modificado_en' => new DateTime(), 'car_modificado_por' => Auth::user()->usr_name]);
                  //dd('Si existe');
				//Elimina los registros de tipo ingreso cargados anteriormente correspondientes, a las mismas fechas.
				\DB::select('DELETE FROM sw_remuneracion_ruta WHERE rem_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneracion_ruta_detalle WHERE rmd_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneracion_total_dia WHERE rtd_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneracion_total_semana_detalle WHERE tsd_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneracion_total_semana WHERE rts_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneracion_zona_dia WHERE rzd_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneracion_zona_semana WHERE rzs_car_id ='.$idArc);
				\DB::select('DELETE FROM sw_remuneraciones WHERE rmc_car_id ='.$idArc);
                \DB::select('DELETE FROM sw_remuneracion_reporte_jde WHERE rjd_car_id ='.$idArc);
			}

			//\DB::select('DELETE FROM sw_remuneracion_detalle_dia');	//Eliminar los registros de sw_remuneracion_detalle_dia
			//\DB::select('ALTER SEQUENCE sw_remuneracion_detalle_dia_ddr_id_seq RESTART'); // Restaurar el indice de la tabla sw_remuneracion_detalle_dia
			//\DB::select('DELETE FROM sw_remuneracion_detalle_semana');	//Eliminar los registros de sw_remuneracion_detalle_semana
			//\DB::select('ALTER SEQUENCE sw_remuneracion_detalle_semana_rds_id_seq  RESTART');	// Restaurar el indice de la tabla sw_remuneracion_detalle_semana

			$rowDay = $request->firtsRowRem;
			//dd($rowDay, $frow, $rows);

            //dd($rows);
			foreach($rows as $key => $reg){	//Recorre los registros para su almacenamiento en la BD

				if($reg->tipo != 'DIA' ) {	//Se valida que no sea registros de tipo DIA

					for($x = 1; $x <= 8; $x++ ){	//De acuerdo a la posici�n del registro, se recorren las posiciones de los d�as para el almacenamiento en la tabla correspondientes.
						if($x<=7){
							//Si la posicion corresponde a uno de los d�as, se almacena en la tabla sw_remuneracion_detalle_dia
                            $vacio = trim($reg->tipo);
                            if ($vacio == 'CNK'
                                || $vacio == 'CNP'
                                || $vacio == 'CNV'
                                || $vacio == 'DFR'
                                || $vacio == 'IXK'
                                || $vacio == 'IXP'
                                || $vacio == 'IXV'
                                || $vacio == 'MUL'
                                || $vacio == 'RKD'
                                || $vacio == 'RPD'
                                || $vacio == 'RVD'
                                || $vacio == 'RZ'
                                || $vacio == 'RZF'
                                || $vacio == 'RZN'
                            ){
                                $vacio = trim($reg->subtipo);
                                if ($vacio == 'BUS'
                                    || $vacio == 'PDR'
                                    || $vacio == 'BTA'
                                    || $vacio == 'MCB'
                                    || $vacio == ''
                                 ){
                                                     $vacio = trim($reg->zona);
                                                    if ($vacio == 'KEN'
                                                        || $vacio == 'SUB' )

                                                                          {
                                                                            if (is_numeric($reg->$rowDay[$x])){
                            $rdd = new sw_remuneracion_detalle_dia;
							$rdd->ddr_car_id = $idArc;
							$rdd->ddr_tip_nombre_tr = trim($reg->tipo);
							$rdd->ddr_zon_acronimo = trim($reg->zona);
							$rdd->ddr_tip_nombre_veh = trim($reg->subtipo);
							$rdd->ddr_rut_nombre = trim($reg->ruta);
							$rdd->ddr_fecha_registro = $this->formatDate($frow->$rowDay[$x]);
							$rdd->ddr_valor = $reg->$rowDay[$x];
							$rdd->ddr_creado_en = new DateTime();
							$rdd->ddr_creado_por = Auth::user()->usr_name;
                            $rdd->save();
                                                    }else{
                                                        Session::flash('message3', 'Los datos deben ser n&uacute;mericos: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->ruta.'-'.$reg->subtipo.'-'.$frow->$rowDay[$x].'-'.$reg->$rowDay[$x].')');
                                                        return redirect()->back();
                                                    }
                                       }else{
                                            Session::flash('message3', 'La zona no existe: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->ruta.'-'.$reg->subtipo.'-'.$frow->$rowDay[$x].'-'.$reg->$rowDay[$x].')');
                                            return redirect()->back();
                                        }
                                }else{
                                    Session::flash('message3', 'No es un tipo de Veh&iacute;culo valido: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->ruta.'-'.$reg->subtipo.'-'.$frow->$rowDay[$x].'-'.$reg->$rowDay[$x].')');
                                    return redirect()->back();
                                }
                            }else{
                                Session::flash('message3', 'El tipo no es valido: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->subtipo.'-'.$reg->ruta.'-'.$frow->$rowDay[$x].'-'.$reg->$rowDay[$x].')');
                                return redirect()->back();
                            }

						} elseif($x=8){
							//Si la posicion corresponde al total de la semana, se almacena en la tabla sw_-remuneracion_detalle_semana
                            $vacio = trim($reg->tipo);
                            if ($vacio == 'CNK'
                                || $vacio == 'CNP'
                                || $vacio == 'CNV'
                                || $vacio == 'DFR'
                                || $vacio == 'IXK'
                                || $vacio == 'IXP'
                                || $vacio == 'IXV'
                                || $vacio == 'MUL'
                                || $vacio == 'RKD'
                                || $vacio == 'RPD'
                                || $vacio == 'RVD'
                                || $vacio == 'RZ'
                                || $vacio == 'RZF'
                                || $vacio == 'RZN'
                            ){
                                $vacio = trim($reg->subtipo);
                                if ($vacio == 'BUS'
                                    || $vacio == 'PDR'
                                    || $vacio == 'BTA'
                                    || $vacio == 'MCB'
                                    || $vacio == ''
                                ){
                                    $vacio = trim($reg->zona);
                                    if ($vacio == 'KEN'
                                        || $vacio == 'SUB' )

                                    {
                                        if (is_numeric($reg->total)){

                            $rds = new sw_remuneracion_detalle_semana;
							$rds->rds_car_id = $idArc;
							$rds->rds_tip_nombre_tr = trim($reg->tipo);
							$rds->rds_zon_acronimo = trim($reg->zona);
							$rds->rds_tip_nombre_veh = trim($reg->subtipo);
							$rds->rds_rut_nombre = trim($reg->ruta);
							$rds->rds_fecha_inicio = $dateIni;
							$rds->rds_fecha_fin = $dateFin;
							$rds->rds_valor = $reg->total;
							$rds->rds_creado_en = new DateTime();
							$rds->rds_creado_por = Auth::user()->usr_name;
                            $rds->save();

                                        }else{
                                            Session::flash('message3', 'Los datos deben ser n&uacute;mericos: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->ruta.'-'.$reg->subtipo.'-'.$reg->total.')');
                                            return redirect()->back();
                                        }
                                    }else{
                                        Session::flash('message3', 'La zona no existe: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->ruta.'-'.$reg->subtipo.'-'.$reg->total.')');
                                        return redirect()->back();
                                    }
                                }else{
                                    Session::flash('message3', 'No es un tipo de Veh&iacute;culo valido: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->ruta.'-'.$reg->subtipo.'-'.$reg->total.')');
                                    return redirect()->back();
                                }
                            }else{
                                Session::flash('message3', 'El tipo no es valido: Fila: ('.$reg->tipo.'-'.$reg->zona.'-'.$reg->subtipo.'-'.$reg->ruta.'-'.$reg->total.')');
                                return redirect()->back();
                            }

						}

					}

				}

			}
            //dd('Ok Día y Semana');

			//Redistribucion de la informacion en las tablas correspondientes, seg�n el tipo del registro.
			if($complete){
				$complete = $this->insertRemuneracionRuta($idArc);	//Almacenamiento de los registros de tipo ingresos en la tabla sw_remuneracion_ruta
				if($complete){
					$complete = $this->insertRemuneracionRutaDetalle($idArc);	//Almacenamiento de los registros de tipo cantidad en la tabla sw_remuneracion_ruta_detalle
					if($complete){
						$complete = $this->insertRemuneracionTotalDia($idArc);	//Almacenamiento de los registros de tipo cantidad en la tabla sw_remuneracion_total_dia
						if($complete){
							$complete = $this->insertRemuneracionTotalSemanaDetalle($idArc);	//Almacenamiento de los registros da tipo cantidad por semana en la tabla sw_remuneracion_total_semana_detalle.
							if($complete){
								$complete = $this->insertRemuneracionTotalSemana($idArc);	//Almacenamiento de los registros da tipo cantidad por semana en la tabla sw_remuneracion_total_semana.
								if($complete){
									$complete= $this->insertRemuneracionZonaDia();	//Almacenamiento de los registros da tipo remuneraci�n por semana en la tabla sw_remuneracion_zona_semana.
									if($complete){
										$complete = $this->insertRemuneracionZonaSemana($idArc);	//Almacenamiento de los registros da tipo remuneraci�n por d�a en la tabla sw_remuneracion_zona_dia.
										if($complete){
											$complete = $this->insertRemuneraciones($idArc);	//Almacenamiento de los registros de remuneraci�n en la tablas sw_remuneraciones.
											if($complete){
                                                $complete = $this->reportJde($dateIni, $dateFin); //Almacenamiento de los registros para el reporte de JDE.
                                                Session::flash('message2', 'Informe de remuneraciones cargado correctamente.');
                                                return redirect()->route('remreportes.index');
                                            }
										}
									}
								}
							}
						}
					}
				}
			}

		} else {
			Session::flash('message3', 'No se encuentra un Informe de Kil&oacute;metros cargado, que coincida con el periodo de Remuneraci&oacute;n.');
			return redirect()->back();
		}

	}

	/**
	 * M�todo encargado de almacenar los Ingresos del Informe de Kil�metros .
	 *
	 * Se encarga de buscar los registros de tipo Ingreso, almacenados en la tabla sw_remuneracion_detalle_dia,
	 * y almacenarlos en la tabla sw_remuneracion_ruta.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionRuta($idArc){
		$complete = true;

		$rows = \DB::select('SELECT * FROM fn_remuneraciones_ruta(?)',array($idArc));	//Busca los registros de tipo Ingreso en la BD.
        //dd($rows,$idArc);
		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_ruta.



            $remRuta = new sw_remuneracion_ruta;
			$remRuta->rem_car_id = $row->ddr_car_id;
			$remRuta->rem_tip_nombre_tr = $row->ddr_tip_nombre_tr;
			$remRuta->rem_tip_nombre_veh = $row->ddr_tip_nombre_veh;
			$remRuta->rem_zon_acronimo = $row->ddr_zon_acronimo;
			$remRuta->rem_fecha_registro = $row->ddr_fecha_registro;
			$remRuta->rem_valor = $row->ddr_valor;
			$remRuta->rem_creado_en = new DateTime();
			$remRuta->rem_creado_por = Auth::user()->usr_name;
            $remRuta->save();

		}
        //dd('remuneracion_ruta');
		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las Cantidades del Informe de Kil�metros .
	 *
	 * Se encarga de buscar los registros de tipo Cantidad, almacenados en la tabla sw_remuneracion_detalle_dia,
	 * y almacenarlos en la tabla sw_remuneracion_ruta_detalle.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionRutaDetalle($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones_ruta_detalle(?)',array($idArc));		//Busca los registros de tipo Cantidad en la BD.
		//echo "insert Rutas Ingresos";
		foreach($rows as $key => $row){ //Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_ruta_detalle.

			$remRutaDet = new sw_remuneracion_ruta_detalle();
			$remRutaDet->rmd_car_id = $row->car_id;
			$remRutaDet->rmd_tip_nombre_tr = $row->tip_nombre_tr;
			$remRutaDet->rmd_tip_nombre_veh = $row->tip_nombre_veh;
			$remRutaDet->rmd_zon_acronimo = $row->zon_acronimo;
			$remRutaDet->rmd_rut_nombre = $row->rut_nombre;
			$remRutaDet->rmd_fecha_registro = $row->fecha_registro;
			$remRutaDet->rmd_valor = $row->valor;
			$remRutaDet->rmd_ingreso_total = $row->total;
			$remRutaDet->rmd_creado_en = new DateTime();
			$remRutaDet->rmd_creado_por = Auth::user()->usr_name;
            $remRutaDet->save();


		}

		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las Remuneraciones del Informe de Kil�metros .
	 *
	 * Se encarga de buscar los registros de tipo Remuneracion, almacenados en la tabla sw_remuneracion_detalle_dia,
	 * y almacenarlos en la tabla sw_remuneracion_total_dia.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionTotalDia($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones_total_dia(?)',array($idArc));
			//B�sca los registros de tipo Remuneraci�n en la BD.
		//echo "insert Rutas Ingresos";
        //dd($rows);
		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_total_dia.

			$remTotalDia = new sw_remuneracion_total_dia;
			$remTotalDia->rtd_car_id = $row->ddr_car_id;
			$remTotalDia->rtd_zon_acronimo = $row->ddr_zon_acronimo;
			$remTotalDia->rtd_tip_nombre_tr = $row->tip_nombre_tr;
            $remTotalDia->rtd_tip_nombre_veh = $row->ddr_tip_nombre_veh;
			$remTotalDia->rtd_fecha_registro = $row->ddr_fecha_registro;
			$remTotalDia->rtd_remuneracion_veh_dia = $row->remuneracion_veh_dia;
			$remTotalDia->rdt_remuneracion_km_dia = $row->remuneracion_km_dia;
			$remTotalDia->rtd_remuneracion_pasajeros_dia = $row->remuneracion_pasajeros_dia;
			$remTotalDia->rtd_creado_en = new DateTime();
			$remTotalDia->rtd_creado_por = Auth::user()->usr_name;
            $remTotalDia->save();
		}

		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las Cantidades por semana del Informe de Kil�metros.
	 *
	 * Se encarga de buscar los registros de tipo cantidad por semana, almacenados en la tabla sw_remuneracion_detalle_dia,
	 * y almacenarlos en la tabla sw_remuneracion_total_dia.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionTotalSemanaDetalle($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones_total_semana_detalle(?)',array($idArc));	//B�sca los registros de tipo Cantidad por semana en la BD.
		//echo "insert Rutas Ingresos";

		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_total_semana_detalle.
			$remTotalSemDet = new sw_remuneracion_total_semana_detalle;
			$remTotalSemDet->tsd_car_id = $row->rds_car_id;
			$remTotalSemDet->tsd_zon_acronimo = $row->rds_zon_acronimo;
			$remTotalSemDet->tsd_rut_nombre = $row->rds_rut_nombre;
			$remTotalSemDet->tsd_tip_nombre_tr = $row->rds_tip_nombre_tr;
			$remTotalSemDet->tsd_tip_nombre_veh = $row->rds_tip_nombre_veh;
			$remTotalSemDet->tsd_fecha_inicio = $row->rds_fecha_inicio;
			$remTotalSemDet->tsd_fecha_fin = $row->rds_fecha_fin;
			$remTotalSemDet->tsd_valor = $row->rds_valor;
			$remTotalSemDet->tsd_creado_en = new DateTime();
			$remTotalSemDet->tsd_creado_por = Auth::user()->usr_name;
            $remTotalSemDet->save();
		}

		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las Cantidades por semana del Informe de Kil�metros.
	 *
	 * Se encarga de buscar los registros de tipo cantidad por semana, almacenados en la tabla sw_remuneracion_detalle_dia,
	 * y almacenarlos en la tabla sw_remuneracion_total_dia.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionTotalSemana($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones_total_semana(?)',array($idArc));	//B�sca los registros totales de ingresos y cantidades por semana en la BD.
		//echo "insert Rutas Ingresos";
		//dd($rows);
		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_total_semana.
			$remTotalSem = new sw_remuneracion_total_semana;
			$remTotalSem->rts_car_id = $row->car_id;
			$remTotalSem->rts_zon_acronimo = $row->zon_acronimo;
			$remTotalSem->rts_tip_nombre_tr = $row->tip_nombre_tr;
			$remTotalSem->rts_tip_nombre_veh = $row->tip_nombre_veh;
			$remTotalSem->rts_fecha_inicio = $row->fecha_inicio;
			$remTotalSem->rts_fecha_fin = $row->fecha_fin;
			$remTotalSem->rts_veh_ingreso_semana = $row->veh_ingreso;
			$remTotalSem->rts_veh_cant_semana = $row->veh_cant;
			$remTotalSem->rts_km_ingreso_semana = $row->km_ingreso;
			$remTotalSem->rts_km_cant_semana = $row->km_cant;
			$remTotalSem->rts_pj_ingreso_semana = $row->pas_ingreso;
			$remTotalSem->rts_pj_cant_semana = $row->pas_cant;
			$remTotalSem->rts_creado_en = new DateTime();
			$remTotalSem->rts_creado_por = Auth::user()->usr_name;
            $remTotalSem->save();
		}

		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las valores de remuneraci�n zonal por d�a del Informe de Kil�metros.
	 *
	 * Se encarga de buscar los registros de tipo remunerac�on zonal por d�a, almacenados en la tabla sw_remuneracion_detalle_dia,
	 * y almacenarlos en la tabla sw_remuneraci�n_zona_dia.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionZonaDia($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones_zona_dia(?)',array($idArc));	//B�sca los registros de remuneraci�n zonal por d�a en la BD.
		//echo "insert Rutas Ingresos";

		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_zona_dia.
			$remZonDia = new sw_remuneracion_zona_dia;
			$remZonDia->rzd_car_id = $row->car_id;
			$remZonDia->rzd_zon_acronimo = $row->zon_acronimo;
			$remZonDia->rzd_tip_nombre_tr = $row->tip_nombre_tr;
			$remZonDia->rzd_fecha_registro = $row->fecha_registro;
			$remZonDia->rzd_remuneracion_zonal = $row->rz;
			$remZonDia->rzd_remuneracion_zonal_fq = $row->rzf;
			$remZonDia->rzd_diferencia_remuneraciones = $row->dfr;
			$remZonDia->rzd_total_multas = $row->mul;
			$remZonDia->rzd_remuneracion_zonal_neta = $row->rzn;
			$remZonDia->rzd_creado_en = new DateTime();
			$remZonDia->rzd_creado_por = Auth::user()->usr_name;
            $remZonDia->save();
		}

		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las valores de remuneraci�n zonal por semana del Informe de Kil�metros.
	 *
	 * Se encarga de buscar los registros de tipo remunerac�on zonal por semana, almacenados en la tabla sw_remuneracion_zona_semana,
	 * y almacenarlos en la tabla sw_remuneracion_total_semana.
	 *
	 * @return boolean $complete
	 */

	function insertRemuneracionZonaSemana($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones_zona_semana(?)',array($idArc));	//B�sca los registros de remuneraci�n zonal por semana en la BD.
		//echo "insert Rutas Ingresos";

		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracion_zona_semana.
			$remZonSem = new sw_remuneracion_zona_semana;
			$remZonSem->rzs_car_id = $row->car_id;
			$remZonSem->rzs_zon_acronimo = $row->zon_acronimo;
			$remZonSem->rzs_tip_nombre_tr = $row->tip_nombre_tr;
			$remZonSem->rzs_fecha_inicio = $row->fecha_inicio;
			$remZonSem->rzs_fecha_fin = $row->fecha_fin;
			$remZonSem->rzs_remuneracion_zonal_semana = $row->rz;
			$remZonSem->rzs_remuneracion_zonal_semana_fq = $row->rzf;
			$remZonSem->rzs_diferencia_remuneraciones = $row->dfr;
			$remZonSem->rzs_total_multas = $row->mul;
			$remZonSem->rzs_remuneracion_zonal_neta = $row->rzn;
			$remZonSem->rzs_creado_en = new DateTime();
			$remZonSem->rzs_creado_por = Auth::user()->usr_name;
            $remZonSem->save();
		}

		return $complete;
	}

	/**
	 * M�todo encargado de almacenar las valores de remuneraci�n del Informe de Kil�metros.
	 *
	 * Se encarga de buscar los registros de tipo remunerac�on, almacenados en la tabla sw_remuneracion_zona_semana,
	 * y almacenarlos en la tabla sw_remuneraciones.
	 *
	 * @return boolean $complete
	 */
	function insertRemuneraciones($idArc){
		$complete = true;
		$rows = \DB::select('SELECT * FROM fn_remuneraciones(?)',array($idArc));	//B�sca los registros de remuneraci�n zonal por semana en la BD.
		//echo "insert Rutas Ingresos";
		foreach($rows as $key => $row){	//Recorre los registros encontrados y los alamacena en la tabla sw_remuneracione.
			$rem = new sw_remuneraciones;
			$rem->rmc_car_id = $row->car_id;
			$rem->rmc_zon_acronimo = $row->zon_acronimo;
			$rem->rmc_fecha_inicio = $row->fecha_inicio;
			$rem->rmc_fecha_final = $row->fecha_fin;
			$rem->rmc_valor_gravamen = $row->gmf;
			$rem->rmc_valor_renta = $row->renta;
			$rem->rmc_valor_ica = $row->ica;
			$rem->rmc_valor_cree = $row->cree;
			$rem->rmc_valor_total = $row->total;
			$rem->rmc_total_recaudo = $row->total_recaudo;
			$rem->rmc_creado_en = new DateTime();
			$rem->rmc_creado_por = Auth::user()->usr_name;
			$rem->save();

		}

		return $complete;
	}

    /**
     * M�todo encargado de realizar el almacenamiento en la BD los registros correspondientes al reporte JDE
     *
     * Se almacena la informaci�n correspondeiente a los registros los cuales permitir�n la creaci�n del reporte para JDE
     *
     * @param date $dateIni
     * @param date $dateFin
     * @return boolean $complete
     */

	function reportJde($dateIni, $dateFin){
		$complete = true;

        //dd($dateIni,$dateFin);
        //Se b�scan los registros correspondientes al rchivo cargado para el almacenamiento de los registros del reporte JDE
        $rows = \DB::select("SELECT * FROM fn_remuneraciones_reporte_jde('".$dateIni."','".$dateFin."')");
        //dd($rows);
		$count = \DB::select("SELECT tip_valor3, tip_valor2 FROM sw_detalle_tipos WHERE tip_nombre = 'ING'");   //Valor ingreso por veh�culos
        $cue = \DB::select("SELECT tip_valor2 FROM sw_detalle_tipos WHERE tip_nombre = 'COU'"); //C�digo para cuenta
		//dd($count[0], $cue, $rows);
		foreach($rows as $key => $row){ //Se recorren los registros para el almacenamiento en la tabla sw_remuneracion_reporte_jde
            $impKms = 0.0;
            $distKms = 0.0;
            if($row->kilometros_ruta != 0){ //Se valida la cantidad de los kil�metros
                $impKms = ($row->kilometros_bus + $row->diferencia_kilometros_ruta) * $row->ingreso_kilometros;
                $distKms = ($row->kilometros_bus + $row->diferencia_kilometros_ruta) / $row->kilometros_ruta;
            }
            $uniPj = $distKms * $row->pasajeros_ruta;
            $impPj = ($uniPj * $row->tip_valor)* $row->ingreso_pasajeros;
            $impVh =  $distKms * $row->remuneracion_calculada;
            $c = $cue[0]->tip_valor2.$row->veh_placa.'.'.$count[0]->tip_valor3;
            //dd($impKms, $distKms, $uniPj, $impPj, $impVh, $c);

            //Registro sw_remuneracion_reporte_jde de tipo Kil�metros.
            $reportKm = new sw_remuneracion_reporte_jde();
            $reportKm->rjd_car_id = $row->car_id;
            $reportKm->rjd_cuenta = $c.'.02';
            $reportKm->rjd_rut_nombre = $row->rut_nombre;
            $reportKm->rjd_zon_acronimo = $row->zon_acronimo;
            $reportKm->rjd_importe = $impKms;
            $reportKm->rjd_auxiliar = $count[0]->tip_valor2;
            $reportKm->rjd_linea = $row->ruta_unidad_negocio;
            $reportKm->rjd_cantidad = $row->kilometros_bus + $row->diferencia_kilometros_ruta;
            $reportKm->rjd_unidad_medida = 'KM';
            $reportKm->rjd_veh_movil = $row->veh_movil;
            $reportKm->rjd_fecha = $row->fecha;
            $reportKm->rjd_creado_en = new DateTime();
            $reportKm->rjd_creado_por = Auth::user()->usr_name;
            $reportKm->save();

            //Registro sw_remuneracion_reporte_jde de tipo Pasajeros.
            $reportPj = new sw_remuneracion_reporte_jde();
            $reportPj->rjd_car_id = $row->car_id;
            $reportPj->rjd_cuenta = $c.'.03';
            $reportPj->rjd_rut_nombre = $row->rut_nombre;
            $reportPj->rjd_zon_acronimo = $row->zon_acronimo;
            $reportPj->rjd_importe = $impPj;
            $reportPj->rjd_auxiliar = $count[0]->tip_valor2;
            $reportPj->rjd_linea = $row->ruta_unidad_negocio;
            $reportPj->rjd_cantidad = $uniPj;
            $reportPj->rjd_unidad_medida = 'PJ';
            $reportPj->rjd_veh_movil = $row->veh_movil;
            $reportPj->rjd_fecha = $row->fecha;
            $reportPj->rjd_creado_en = new DateTime();
            $reportPj->rjd_creado_por = Auth::user()->usr_name;
            $reportPj->save();

            //Registro sw_remuneracion_reporte_jde de tipo Veh�culos.
            $reportVh = new sw_remuneracion_reporte_jde();
            $reportVh->rjd_car_id = $row->car_id;
            $reportVh->rjd_cuenta = $c.'.01';
            $reportVh->rjd_rut_nombre = $row->rut_nombre;
            $reportVh->rjd_zon_acronimo = $row->zon_acronimo;
            $reportVh->rjd_importe = $impVh;
            $reportVh->rjd_auxiliar = $count[0]->tip_valor2;
            $reportVh->rjd_linea = $row->ruta_unidad_negocio;
            $reportVh->rjd_cantidad = 0.0;
            $reportVh->rjd_unidad_medida = 'VH';
            $reportVh->rjd_veh_movil = $row->veh_movil;
            $reportVh->rjd_fecha = $row->fecha;
            $reportVh->rjd_creado_en = new DateTime();
            $reportVh->rjd_creado_por = Auth::user()->usr_name;
            $reportVh->save();
            //dd('Quieto');
		}
        return $complete;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	/**
	 * M�todo encargado de descargar el formato para el cargue de Kil�metros
	 *
	 * Genera un archivo de tipo xlsx con la estrutura para el cargue del archivo.
	 *
	 */

	public  function descForKilometros(){


        Excel::create('Informe_Kilometros', function($excel) {

			$excel->sheet('Reporte', function($sheet)  {
				//Estilo de las celdas del primer registro
				$sheet->setBorder('A1:L1', 'thin');

				$sheet->cells('A1:L1', function($cells)
				{
					$cells->setBackground('#009688');
					$cells->setFontColor('#FFFFFF');
					$cells->setAlignment('center');
					$cells->setValignment('center');
				});
				$sheet->setAutoSize(true);

				$data=[];
				//Genera los nombres de las columnas
				array_push($data, array('RUTA', 'TIPO', 'VEHICULO', 'PLACA','DD-MM-YYYY', 'DD-MM-YYYY', 'DD-MM-YYYY', 'DD-MM-YYYY', 'DD-MM-YYYY', 'DD-MM-YYYY', 'DD-MM-YYYY', 'SEMANA##'));
				$sheet->fromArray($data, null, 'A1', false, false);

			});
		})->export('xlsx');
	}

	/**
	 * M�todo encargado de descargar el formato para el cargue de Remuneraciones
	 *
	 * Genera un archivo de tipo xlsx con la estrutura para el cargue del archivo de remuneraciones
	 *
	 */
	public  function descForRemuneracion(){

		Excel::create('Informe_Remuneraciones', function($excel) {

			$excel->sheet('Reporte', function($sheet)  {
				//Estilo de las celdas del primer registro
				$sheet->setBorder('A1:M1', 'thin');

				$sheet->cells('A1:M1', function($cells)
				{
					$cells->setBackground('#000000');
					$cells->setFontColor('#FFFFFF');
					$cells->setAlignment('center');
					$cells->setValignment('center');
				});
				$sheet->setAutoSize(true);

				$data=[];
				//Genera los campos del archivo
				array_push($data, array('INDICADOR', 'TIPO', 'SUBTIPO', 'ZONA', 'RUTA', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES','VIERNES','SABADO','DOMINGO','TOTAL'));
				$sheet->fromArray($data, null, 'A1', false, false);

				//Agrega los datos del segundo registro
				$sheet->row(2, array(
					'VAR','DIA','','', 'DD/MM/YYYY', 'DD/MM/YYYY','DD/MM/YYYY','DD/MM/YYYY','DD/MM/YYYY','DD/MM/YYYY','DD/MM/YYYY',	'DD/MM/YYYY'
				));

			});
		})->export('xlsx');
	}
}
