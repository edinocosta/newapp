<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
	 protected $hidden = ["pivot"];
	 protected $fillable = ['nome','marca','modelo','tensao','consumo','potencia','frequencia','corrente','serie','alimentacao','id_categoria'];
   public $timestamps = false;
	protected $primaryKey  = "id";
   public function compartimento(){
		return $this->hasMany("App\Compartimento");
	}
	public function medicao(){
		return $this->belongsToMany("App\Medicao","medicao_equipamento","idEquipamento","idMedicao" );
	}

	public function categoria(){
		return $this->hasOne("App\Categoria","id","id_categoria");
	}
}
