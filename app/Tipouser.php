<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipouser extends Model
{
   
     public function user(){
        return $this->belongsTo("App\User");
    }
     public function permission()
    {
        return $this->belongsToMany('App\Permission',"tipouser_permissions","idTipoUsers","idPermission");

    }
}
