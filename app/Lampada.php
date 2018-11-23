<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lampada extends Model
{
   protected $hidden = ["pivot"];
	//*********!!!! Nao esquecer do atributo que está na tabela intermediaria  !!!!*******
	public function compartimento(){
		return $this->belongsToMany("App\Lampada","lampada_compartimentos","id_lampada","id_compartimento")->withPivot("quantidade");
	}
}
