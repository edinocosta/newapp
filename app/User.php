<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

use App\Evento;
use App\DateTimes;
use  DateTime;
class User extends Authenticatable 
{
    use Notifiable;
    public $timestamps = true;

    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','idTipo'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //atributos para nao aparecer nos resultados dos qurys
    protected $hidden = [
        'password', 'remember_token',"pivot"
    ];
    
     public function tipouser(){
        return $this->hasOne("App\Tipouser","id","idTipo");
    }
    //Relacionamento Muitos Para Muitos
    public function permission(){
        return $this->belongsToMany("App\Permission","user_permissions","idUsers","idPermisson");
    }

    public static function isAdmin($user){
          if ($user == null) return false;
          return $user->tipouser->descricao === "Administrador" ?true:false;

    }

    public static function estado(User $user){

          return $user->estado==1?"Activado":"Desativado";

    }

    public static function canlogin(User $user){

          return $user->canlog==1?"Sim":"Não";

    }

    public function evento(){
        return $this->belongsTo('App\Evento',"id","idUser");
        
    }

    public function log(){
        return $this->belongsTo('App\Log',"id","idUser");        
    }

    public function tipoevento(){
        return $this->belongsTo('App\TipoEvento',"id","idUser");
        
    }


    public static function myTasks($user){

               if (!User::isAdmin(Auth::user())) {

                 $user = Evento::where('inicio','>',new DateTime())->orderBy('inicio','asc')->get()->map(function ($item, $key) {
                    if ($item->pub_private == 1 && Auth::user()->id == $item->idUser) {
                        return $item;
                    }else {

                        if ($item->pub_private == 0) {
                        return $item;
                    }
                    }
                });;
                  
                }else{

                    $user = Evento::where('inicio','>',new DateTime())->where('idUser',Auth::user()->id)->orderBy('inicio','asc')->get();
                   
                }


               
                $users =  [];
                foreach ($user as $var ) {
                  
                if ($var) {
                   
                    $dias = DateTimes::diffday($var->inicio);

                    if ($dias<=3) {
                        $var->dias = $dias;
                        $users[] = $var;
                    }
                
                 
                }
                    
                            
                }

                return  $users;
    }


               

    
}
