<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	 protected $hidden = ['pivot'];
     protected $fillable = ['nomePermissao'];
	 protected $primaryKey = "id_permission";
    public function user()
    {
        return $this->belongsToMany('App\User',"user_permissions","idPermisson","idUsers");
    }
    public function tipouser()
    {
        return $this->belongsToMany('App\Tipouser',"tipouser_permissions","idPermission","idTipoUsers");

    }
}
