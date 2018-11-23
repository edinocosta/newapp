<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoAuditoria extends Model
{
	protected $table = "estadoauditorias";
	public $timestamps = false;
	protected $primaryKey = "id";

    public function audtoria(){
		return $this->belongsToMany("App\Auditoria","auditoria_estado","idEstado","idAuditoria")->withPivot(["obs","created_at","updated_at"]);
	}


}
