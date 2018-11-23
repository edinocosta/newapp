<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EInstalacao extends Model
{
	protected $table = "equipamentos_instalcao";
    public function visita(){
		return $this->belongsToMany("App\Visita","visitas_equipamentos_instalados","id_equipamento","id_visitas")->withPivot("obs");;
	}
	 public function tipo(){
		return $this->hasOne("App\TipoEI","id","idTipo");
	}

	 public function tipob(){
		return $this->hasOne("App\Tipobateria","id","idTipoB");
	}
	public function tipop(){
		return $this->hasOne("App\Tipopainel","id","idTipoP");
	}
}
