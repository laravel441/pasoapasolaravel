<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarRespuestaRequest extends Request {

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
			'rta_descripcion'	=>	'required|max:10000',
			'nombre'			=>	'exists:sw_empleados,emp_an8',
			'emp_identificacion'=>	'exists:sw_empleados,emp_an8',
			'emp_an8'			=>	'exists:sw_empleados,emp_an8',
			'emp_cod_tm'		=>	'exists:sw_empleados,emp_an8',
			'escondido'			=>	'exists:sw_registro_pqrs,pqrs_id',


		];
	}

}
