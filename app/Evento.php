<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{	
	protected $table = "eventos";
	protected $primaryKey = "id";

	
  public function tipoevento(){
    	return $this->hasOne('App\TipoEvento',"id","idTipo");
		
	}
  public function user(){
    	return $this->hasOne('App\Users',"id","idUser");
		
	} 	
	
}
