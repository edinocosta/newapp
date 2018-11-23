<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registo extends Model
{

	protected $hidden = ["pivot"];
	
	 public $timestamps = false;
    public function contador(){
		return $this->hasMany("App\Contador");
	}
	public function consumo(){
		return $this->belongsTo("App\Consumo","id","id_registo");
	}

	public function compartimento(){
		return $this->hasOne("App\Compartimento","id","id_compartimento");
	}
	
	public function auditoria(){
		return $this->belongsToMany("App\Auditoria","auditoria_registos","idRegisto","idAuditoria");
	}
}
