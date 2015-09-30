<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class IngresoPqrsRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	protected function getValidatorInstance() {
		$validator = parent::getValidatorInstance();

		$validator->after(function() use ($validator) {
			$validator->sometimes('validacion', 'required', function($input) use($validator) {


			}); 
		});


		return $validator;

	}
	public function rules()
	{

		return [
		'canal_id' 						=> 		'required|exists:sw_canal_pqrs,can_id',
		'pqrs_num_requerimiento'		=>		'required',
		'typo_id'						=>		'required|exists:sw_tipo_pqrs,typ_id',
		'inciden_id'					=>		'required|exists:sw_incidencia_pqrs,inc_id',
		'lugar'							=>		'required|max:50',
		'estap_id'						=>		'required|exists:sw_estado_pqrs,stp_id',
		'priorid_id'					=>		'required|exists:sw_prioridad_pqrs,pri_id',
		'afectado'						=>		'required|max:100',
		'celuar_afectado'				=>		'required|numeric',
		'correo_afectado'				=>		'required|email',
		'ruta_id'						=>		'required|exists:sw_rutas,rut_id',
		'vehic_id'						=>		'required|exists:sw_vehiculo,veh_id',
		'sitp_id'						=>		'required|exists:sw_vehiculo,veh_id',
		'patio_id'						=>		'required|exists:sw_patio,pto_id',
		'area_id'						=>		'required|exists:sw_areas,area_id',
		'descrip'					=>		'required|max:10000',

		];
	}

}