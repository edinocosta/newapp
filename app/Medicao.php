<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicao extends Model
{
	protected $appends = ['media_energia'];
	protected $hidden = ["pivot"];
    public function medidor(){
		return $this->hasOne("App\Medidor","id","id_medidor");
	}
	 public function equipamento(){
		return $this->belongsToMany("App\Equipamento","medicao_equipamento","idMedicao","idEquipamento");
	}
	public function medida(){
		return $this->belongsTo("App\Medida","id","idMedicao");
	}
	public function consumo(){
		return $this->hasOne("App\Consumo","id","id_consumo");
	}

	public function getMediaEnergiaAttribute(){
			return $this->medida()->avg("energia");
	}
	
}
