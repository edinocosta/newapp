<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lampada_Compartimento extends Model // Classe nao necessaria aqui
{
    public function compartimento(){
		return $this->hasMany("App\Compartimento");
	}
	public function lampada(){
		return $this->hasMany("App\Lampada");
	}
}
