<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_respuesta_pqrs extends Model {

    protected $table = 'sw_respuesta_pqrs';

    protected $fillable = array('rta_descripcion','rta_fecha_ingreso','rta_creado_en','rta_creado_por','rta_modificado_en','rta_modificado_por');

    protected $primaryKey = 'rta_id';

    public $timestamps = false;

}
