<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipobateria extends Model
{
   
    public function einstal(){
		return $this->belongsTo("App\EInstalacao","id","idTipoB");
	}
}
