<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

	public $timestamps = false;
	protected $primaryKey  = "id";
   
	public function equipamento(){
		return $this->belongsTo("App\Equipamento","id_categoria","id");
	}

}
