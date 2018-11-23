<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEI extends Model
{
    protected $hidden = ["pivot"];
	protected $table = "tipoei";

	 public function einstal(){
		return $this->belongsTo("App\EInstalacao","id","idTipo");
	}
}
