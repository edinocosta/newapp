<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contadore extends Model
{
	public $timestamps = false;

	protected $primaryKey = "id";
	protected $fillable = ['cil', 'numero'];
    protected $table= 'contadores';
   public function registo(){
		return $this->belongsTo("App\Registo");
	}
}
