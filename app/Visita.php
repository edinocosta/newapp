<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
   public function propriedade(){
		return $this->belongsTo("App\Prorpriedade");
	}
	public function equipamentos_instalado(){
		return $this->belongsToMany("App\Equipamentos_instalado","visitas_equipamentos_instalados","id_visitas","id_equipamento")->withPivot("obs");;
	}
}
