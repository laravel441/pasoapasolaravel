<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_canal_pqrs extends Model {

    protected $table = 'sw_canal_pqrs';

    protected $fillable = array('can_nombre','can_acronimo','can_creado_en','can_creado_por','can_modificado_en','can_modificado_por');


    protected $primaryKey = 'can_id';

    public $timestamps = false;

}
