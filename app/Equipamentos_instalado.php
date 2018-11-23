<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamentos_instalado extends Model
{
    public function visita(){
		return $this->belongsToMany("App\Visita","visitas_equipamentos_instalados","id_equipamento","id_visitas")->withPivot("obs");;
	}
}
