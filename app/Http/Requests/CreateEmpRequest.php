<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use DateTime;

class CreateEmpRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//PErmite manejar la logica adicional de usar Request o no
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return array(


        'emp_an8' => 'required|max:255|unique:sw_empleados,emp_an8',
        'emp_area_id'=>'',
        'emp_cod_tm'=>'required|max:255|unique:sw_empleados,emp_cod_tm',
        'emp_identificacion'=>'required|max:255|unique:sw_empleados,emp_identificacion',
        'emp_nombre'=>'required|max:255',
        'emp_nombre2'=>'max:255',
        'emp_apellido'=>'required|max:255',
        'emp_apellido2'=>'max:255',
        'emp_direccion'=>'max:255',
        'emp_telefono'=>'max:255|max:10',
        'emp_celular'=>'max:255|max:10',
        'emp_correo'=>'required|email|max:255|unique:sw_empleados,emp_correo',
        'emp_fecha_nacimiento'=>new DateTime,
        'emp_unidad_negocio'=>'max:255',
        'emp_fecha_ingreso'=>new DateTime,
        'emp_fecha_salida'=>'',
            'emp_creado_en' => new DateTime,
            'emp_creado_por' => 'Swcapital',
            'emp_modificado_en' => new DateTime,
            'emp_modificado_por' => 'Swcapital'


        );
    }

}
