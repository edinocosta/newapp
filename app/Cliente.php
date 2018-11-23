<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{	protected $fillable = ['nome', 'email','telefone','morada'];
	protected $table = "clientes";
	public $timestamps = true;
	protected $primaryKey = "id";
    public function propriedade(){
		return $this->hasMany('App\Propriedade',"id_cliente","id");
	}
	
	
	
}
