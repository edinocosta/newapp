<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    public function auditoria(){
		return $this->hasOne("App\Auditoria","id","id_auditoria");
	}
}
