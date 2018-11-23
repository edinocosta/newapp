<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propriedade extends Model
{   public $timestamps = false;

	protected $primaryKey = "id";

    public function cliente(){
		return $this->hasOne("App\Cliente","id","id_cliente");
	}

	public function visita(){
		return $this->hasMany("App\Visita");
	}
	public function compartimento(){
		return $this->hasMany("App\Compartimento","id_propriedade","id");
	}
	public function auditoria(){
		return $this->belongsTo("App\Auditoria","id","id_propriedade");
	}
}
