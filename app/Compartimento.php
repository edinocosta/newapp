<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compartimento extends Model
{    protected $hidden = ["pivot"];
    protected $foreignKey="id_propreidade";
     public $timestamps = false;
    public function consumo(){
		return $this->belongsTo("App\Consumo");
	}
	public function lampada(){
		return $this->belongsToMany("App\Lampada","lampada_compartimentos","id_compartimento","id_lampada")->withPivot("quantidade");;
	}
	 

}
