<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
	    protected $hidden = ["pivot"];
	    protected $table = "consumos";
	    public $timestamps = true;

	public function compartimento(){
		return $this->hasOne("App\Compartimento","id","id_compartimento");
	}

	public function auditoria(){
		return $this->hasOne("App\Auditoria","id");
	}

	public function medicao(){
		return $this->belongsTo("App\Medicao","id","id_consumo");
	}

	

}
