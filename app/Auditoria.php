<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
	 protected $hidden = ["pivot"];
	protected $table = "auditorias";
	public $timestamps = true;
	protected $primaryKey  = "id";

    public function propriedade(){
		return $this->hasOne('App\Propriedade',"id","id_propriedade");
	}
	
	public function consumo(){
		return $this->belongsTo("App\Consumo","id" ,"id_auditoria");
	}

	public function fatura(){
		return $this->belongsTo("App\Fatura","id" ,"id_auditoria");
	}

	public function estado(){
		return $this->belongsToMany("App\EstadoAuditoria","auditoria_estado","idAuditoria" ,"idEstado")->withPivot(["obs","created_at","updated_at"]);
	}

}
