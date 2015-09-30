<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_incidencia_pqrs extends Model {

    protected $table = 'sw_incidencia_pqrs';

    protected $fillable = array('inc_nombre','inc_creado_en','inc_creado_por','inc_modificado_en','inc_modificado_por');


    protected $primaryKey = 'inc_id';

    public $timestamps = false;

}
