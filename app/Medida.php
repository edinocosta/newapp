<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
   public function medicao(){
		return $this->hasOne("App\Medicao","id","idMedicao");
	}
}
