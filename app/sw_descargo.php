<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_descargo extends Model {

    protected $table = 'sw_descargo';

    protected $fillable = array('desc_descargo','desc_fecha_ingreso','desc_creado_en','desc_creado_por','desc_modificado_en','desc_modificado_por');

    protected $primaryKey = 'desc_id';

    public $timestamps = false;
}
