<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_modulo_x_rol extends Model {

    protected $table = 'sw_modulo_x_roles';

    public $timestamps = false;

    protected $fillable = array ( 'mxr_mod_id',
                                  'mxr_rol_id',
                                  'mxr_flag_crear',
                                  'mxr_flag_consultar',
                                  'mxr_flag_modificar',
                                  'mxr_flag_eliminar');

    protected $primaryKey = 'mxr_id';

}
