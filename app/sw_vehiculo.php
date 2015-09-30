<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_vehiculo extends Model {

    protected $table = 'sw_vehiculo';

    protected $fillable = array('veh_tip_id','veh_placa','veh_movil','veh_marca','veh_modelo','veh_creado_en','veh_creado_por','veh_modificado_en','veh_modificado_por','veh_unidad_negocio');

    protected $primaryKey = 'veh_id';

    public $timestamps = false;
}
