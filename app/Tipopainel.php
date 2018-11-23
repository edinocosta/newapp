<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopainel extends Model
{
   
    public function einstal(){
		return $this->belongsTo("App\EInstalacao","id","idTipoP");
	}
}
