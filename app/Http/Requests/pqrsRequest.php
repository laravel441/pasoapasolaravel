<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class pqrsRequest extends Request {

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
	public function rules()
	{
		return [
        'canal_id' => 'required',
        'pqrs_num_requerimiento' => 'required',
        'fecha_asignacion' => 'required',
        'typo_id'=> 'required',
        'inciden_id'=> 'required',
        'hora_fecha'=> 'required',
        'lugar'=> 'required',
        'estap_id'=> 'required',
        'priorid_id'=> 'required',
        'afectado'=> 'required',
        'celuar_afectado'=> 'required|number|max:10|',
        'correo_afectado'=> 'required|email',
        'ruta_id'=> 'required',
        'vehic_id'=> 'required',
        'vehic_id'=> 'required',
        'patio_id'=> 'required',
        'area_id'=> 'required',
        'fecha_asignacion'=> 'required',
        'descrip'=> 'required|max:10000',
		];
	}

}
