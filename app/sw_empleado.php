<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class sw_empleado extends Model {

    protected $table = 'sw_empleados';

    protected $fillable = array ('emp_id','emp_an8', 'emp_area_id','emp_cod_tm','emp_correo', 'emp_identificacion','emp_nombre',
        'emp_nombre2', 'emp_apellido','emp_apellido2','emp_direccion', 'emp_telefono','emp_celular',
        'emp_correo');

    protected $primaryKey = 'emp_id';
    public $timestamps = false;

}

