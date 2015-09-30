<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_estado_pqrs extends Model {

    protected $table = 'sw_estado_pqrs';

    protected $fillable = array('stp_nombre','stp_acronimo','stp_creado_en','stp_creado_por','stp_modificado_en','stp_modificado_por');

    protected $primaryKey = 'stp_id';

    public $timestamps = false;
}
