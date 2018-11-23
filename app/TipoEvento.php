<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{	

	public $timestamps = false;
	protected $primaryKey = "id";
    protected $table = "tipoeventos";
	
   public function evento(){
    	return $this->belongsTo('App\Evento',"id","idTipo");
		
	}

	public function user(){
    	return $this->hasOne('App\User',"id","idUser");
        
    }
	
	
}
