<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_registro_pqrs extends Model {

    protected $table = 'sw_registro_pqrs';

    protected $fillable = array('pqrs_num_requerimiento', 'pqrs_consecutivo_mc', 'pqrs_fecha_asignacion', 'pqrs_fecha_hora_suceso', 'pqrs_lugar', 'pqrs_descripcion',
      'pqrs_typ_id', 'pqrs_stp_id', 'pqrs_inc_id','pqrs_rut_id','pqrs_veh_id','pqrs_can_id','pqrs_pto_id','pqrs_desc_id','pqrs_emp_an8','pqrs_pri_id','pqrs_rta_id','pqrs_area_id',
        'pqrs_fecha_vencimiento','pqrs_afectado','pqrs_num_celuar_afectado',
        'pqrs_num_correo_afectado','pqrs_creado_en','pqrs_creado_por','pqrs_modificado_en','pqrs_modificado_por');


    protected $primaryKey = 'pqrs_id';

    public $timestamps = false;

}
