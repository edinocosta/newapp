<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
	public $timestamps = false;
	protected $primaryKey  = "id";

    public function medicao(){
		return $this->belongsTo("App\Medicao");
	}
}
