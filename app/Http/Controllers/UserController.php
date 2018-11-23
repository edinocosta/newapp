<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use PDF;
use App\Auditoria;
use App\Cliente;
use App\Registo;
use App\Tipouser;
use App\Fatura;
use Pusher\Pusher;
use App\Evento;
use App\Log;
use App\TipoEvento;
use App\EInstalacao;
use App\Propriedade;
use App\User_Permission;
use App\Permission;
use App\Lampada;
use App\TipoEI;
use DateTime;
use App\DateTimes;
use App\Medicao;
use App\Medida;
use App\Consumo;
use App\Compartimento;
use App\Equipamento;
class UserController extends Controller
{
	public function login1(Request $request){
		$credentials = $request->only('email', 'password');

if (Auth::attempt($credentials)) {
$request->session()->put('user_id',Auth::user()->id);
return Auth::user();
}
else return "";
	}
	public function doLogout(){
			Auth::logout();
			return Auth::user(); //tem q ser nulo
	}
public function usercreate(Request $request){
	//User::create(['name'=>'Zoe','email'=>'zoe@gmail.com','password'=>bcrypt($request->password),'idTiop'=>intval($request->tipoUser)]);
		$user = new User();

		$user->name = $request->nome;
		$user->email = $request->email;
		$user->idTipo= intval($request->tipo);
		$user->password = bcrypt($request->password);
		$user->img_path="img/alt_pic.jpg";
		if (isset($request->login)) {
			$user->canlog=1;

		}else{
          $user->canlog=0;
		}
		if (isset($request->activado)) {
			 $user->estado=1;
		}else{
            $user->estado=0;
		}
		$user->save();
        $this->fillLog('Inserir','Utilizador');
		return  redirect("/users_manage")->with(["users"=>User::where("id",">",1)->get(),"newuser"=>$user->name]);
	}
	public function getAllUsers(){
	
		return User::select("id","name","email")->with(["permission"=>function($q){
			$q->select("nomePermissao");
		}])->get();
	}
	public function getCliente(){
      
       
   /*
			Tipouser::find(3)->permission()->get()->map(function ($item, $key) {
            return $item->id_permission;
});*/
           return  Cliente::select("id","nome","nif","morada","email","telefone")->with(["propriedade"=>function($q){
			$q->select("id_cliente","id","local","geolocalizacao")->with(["compartimento"=>function($q2){
				$q2->select("id","id_propriedade","nome","piso")->with(["lampada"=>function($q3){
					$q3->select("id","tipo","potencia","quantidade");
				}]);
			}]);
		}])->where("estado",0)->get();
	}
	public function getTheCliente(Request $request){

	return Cliente::select("id","nome","nif","morada","email","telefone")->with(["propriedade"=>function($q){
			$q->select("id_cliente","id","local","geolocalizacao")->with(["compartimento"=>function($q2){
				$q2->select("id","id_propreidade","nome","piso")->with(["lampada"=>function($q3){
					$q3->select("id","tipo","potencia","quantidade");
				}]);
			}]);
		}])->where("id",intval($request->id))->get();
	}
	
	public function addCliente(Request $request){
		$val=0;
		$val = Cliente::select("id")->where("nif",intval($request->nif))->get();
		if(sizeof($val)!=0){
			return new Cliente();//Cliente Já Existe
		}
		
	$cli = new  Cliente();
	$cli->nome= $request->nome;
	$cli->telefone= $request->telefone;
	$cli->email= $request->email;
	$cli->nif= $request->nif;
	$cli->morada= $request->morada;
	$cli->estado= 0;
	$cli->save();
	$this->storeImageCli($request, $cli);
	$this->fillLog('Inserir','Cliente');
	return redirect("/clientes");
		
	}

	public function editCliente(Request $request){
	
	$cli = Cliente::findOrFail(intval($request->idCliente));
	$cli->nome= $request->nome;
	$cli->telefone= $request->telefone;
	$cli->email= $request->email;
	$cli->nif= $request->nif;
	$cli->morada= $request->morada;
	$cli->save();
	$this->fillLog('Atualizar','Cliente');
	//$this->storeImageCli($request, $cli);
	return redirect("/cliente/detalhes/".$request->idCliente);
		
	}

	public function addLampaCompart(Request $request){
		//Adicionando dado Numa Tabela Intermediaria: Relacionamento N po N
		$comp = Compartimento::findOrfail(intval($request->idCompart));
	    $comp->lampada()->attach(intval($request->idLampada), ['quantidade' => intval($request->quantidade)]);
		return $comp->lampada()->get();
	}
	public function getLampada(){
	return Lampada::all();
	}
	public function getUser(Request $request){
		return User::select("id","name","email","idTipo")->where("id",intval($request->session()->get("user_id")))->with(["permission"=>function($q){
		$q->select("id_permission","nomePermissao");
	}])->get()->first();
	/*return User::find(intval($request->session()->get("user_id")))->select("id","name","email","idTipo")->with(["permission"=>function($q){
		$q->select("id_permission","nomePermissao");
	}])->get();*/
	}
	public function apagarCliente(Request $request){
		Cliente::destroy(intval($request->id));
		$this->fillLog('Apagar','Cliente');
	}
	public function addPropriedade(Request $request){
		
		try {
			$cliente = Cliente::findOrfail(intval($request->cliente_id));
			$p = new Propriedade();
			$p->geolocalizacao=$request->geo;
			$p->local=$request->local;
			$p->descricao=$request->desc;
			$cliente->propriedade()->save($p);
			return $p;
		}
		//catch exception
		catch(Exception $e) {
		return -1;
		}
}
	public function addComp(Request $request){
		try {
			$p = Propriedade::findOrfail(intval($request->prop_id));
			$c = new Compartimento();
			$c->nome=$request->nome;
			$c->pe_direito=doubleval($request->pe_direito);
			$c->comprimento=doubleval($request->comprimento);
			$c->largura=doubleval($request->largura);
			$c->piso=intval($request->piso);
			$p->compartimento()->save($c);
			$this->fillLog('Inserir','Compartimento');
			return redirect('/edit_prop/'.$request->prop_id);
		}
		//catch exception
		catch(Exception $e) {
		return -1;
		}
	}
	public function saveUpload(Request $request){
	if($file = Input::file('imge')){
		
		$filename = "user_".request()->id.'.'.request()->imge->getClientOriginalExtension();
		request()->imge->move(public_path('img/perfil'), $filename);
$user = User::findOrfail(request()->id);
		$user->image=$filename;
		$user->save();
		return "OK";

	}
	return "Not OK";
}
public function getAudit(){
	
		return Auditoria::select("id","id_propreidade","descricao","id_estado")->with(["propriedade"=>function($p){

			$p->select("id","local","id_cliente" )->with(["cliente"=>function($c){
				$c->select("id","nome","morada","telefone","nif","email");
			},"compartimento"=>function($c1){
				$c1->select("id","nome","id_propreidade");
			}]);
		},"estado"=>function($es){
				$es->select("id","descricao");
			}])->orderBy('id_estado','asc')->get();
	}
	public function addAudit(Request $request){
	
			$existe = [];
			$existe = Auditoria::where("id_propriedade",intval($request->propriedade))->get();
			if (sizeof($existe)>0) {
				return 2;
			}
			$a = new Auditoria();
			$a->descricao=$request->descricao;
			$a->data_inicio=date('Y-m-d', strtotime($this->trasnformDateString($request->d_ini)));
			$a->data_fim=date('Y-m-d', strtotime($this->trasnformDateString($request->d_fim)));
			$a->id_propriedade=intval($request->propriedade);
			$a->c_inicio=0;
			$a->c_fim=0;
			$a->save();
			$a->estado()->attach(1,["obs"=>"Inicio da Auditoria"]);
			return $a;
		}
	public function getRegistos(Request $request){
		try {
			$a = Auditoria::findOrfail(intval($request->id_audit));
			return $a->registo()->with(["compartimento"=>function($c){
				$c->select("id","nome");
			}])->get();
		}
		//catch exception
		catch(Exception $e) {
		return -1;
		}
	}
	public function getProp(Request $request){
	
		try {
			$a = Propriedade::findOrfail(intval(intval($request->id_propreidade)));
			return $a->compartimento;
		}
		//catch exception
		catch(Exception $e) {
		return -1;
		}
	}
	public function addRegisto(Request $request){
            
		try {
			$a = Auditoria::findOrfail(intval($request->id_auditoria));
			$r = new Registo();
			$r->id_compartimento=intval($request->id_compartimento);
			$r->data_ini=date('Y-m-d', strtotime(str_replace('-', '/', $request->d_ini)));
			$r->data_fim=date('Y-m-d', strtotime(str_replace('-', '/', $request->d_ini)));
			$r->hora_ini=$request->h_ini;
			$r->hora_fim=$request->h_fim;
			$r->contador_ini=doubleval($request->c_ini);
			$r->contador_fim=doubleval($request->c_fim);
		    
			$r->save();
			$a->registo()->attach($r->id);
			return $r;
		}
		//catch exception
		catch(Exception $e) {
		return -1;
		}
	}
	public function audit_res(Request $request, $id){
        if (!Auth::user()) return redirect('login');
               
		return view('audit_res')->with(["auditoria"=>Auditoria::findOrfail($id)]);

	}
	public function addEquipLD(Request $request){
        
        $equip = new Equipamento(); 
        $equip->nome = $request->nome;
		$equip->marca = $request->marca;
		$equip->modelo = $request->modelo;	   
		$equip->alimentacao=$request->alimentacao;
		$equip->id_categoria  = intval($request->categoria);
		$equip->corrente   = doubleval($request->corrente);
		$equip->potencia   = doubleval($request->potencia);
		$equip->consumo  = doubleval($request->consumo);
		$equip->frequencia=doubleval($request->frequencia);
		$equip->tensao= doubleval($request->tensao);	    
		$equip->serie=doubleval($request->serie);
        $equip->save();
        $this->fillLog('Inserir','Equip.Eletrodomestico');
		return $equip;

	}
	public function addFEquipLD(Request $request){
        
        $equip = new Equipamento(); 
        $equip->nome = $request->nome;
		$equip->marca = $request->marca;
		$equip->modelo = $request->modelo;
		$equip->id_categoria  = intval($request->categoria);
		$equip->potencia   = doubleval($request->potencia);
		$equip->consumo  = doubleval($request->consumo);
		$equip->tensao= doubleval($request->tensao);	 
        $equip->save();
        $this->fillLog('Inserir','Equip.Eletrodomestico');
		return $equip;
		
	}

	public function edit_prop(Request $request, $id){
         if (!Auth::user()) return redirect('login');
		return view('edit_propriedade')->with(["propriedade"=>Propriedade::findOrFail($id)]);

	}

	public function consumos(Request $request, $idReg,$idCon){

		if (!Auth::user()) return redirect('login');
		 
		return view('consumos')->with(["auditoria"=>Auditoria::findOrfail($idReg),"consumo"=>Consumo::findOrfail($idCon)]);

	}
  public function getC(){
	
		return Consumo::find(1)->select("id","energia")->with(["equipamento"=>function($eq){

			$eq->select("id","nome");}])->get();
	}

		public function addConsumo(Request $request){
            
		try {

			$c = new Consumo();
			$c->id_compartimento=intval($request->comp_id);
			$c->id_auditoria=intval($request->audit_id);
			$c->save();
			$this->fillLog('Inserir','Consumo');
			return redirect("/consumos/".intval($request->audit_id)."/".$c->id);
		}







		//catch exception
		catch(Exception $e) {
		return -1;
		}
	}

		public function store(Request $request)
		{
		    // Define o valor default para a variável que contém o nome da imagem 
		    $nameFile = null;
		 
		    // Verifica se informou o arquivo e se é válido
		    if ($request->hasFile('image') && $request->file('image')->isValid()) {
		         
		        // Define um aleatório para o arquivo baseado no timestamps atual
		        $name = "audit_".$request->id;
		 
		        // Recupera a extensão do arquivo
		        $upload=false;
		        $extension = $request->image->getClientOriginalExtension();
		        if ($request->image->getClientOriginalExtension() == 'csv') {
		        	// Define finalmente o nome
		        $nameFile = "{$name}.{$extension}";
		 
		        // Faz o upload:
		        $upload = $request->image->storeAs('public/fich_Audit', $nameFile);

		        $a = Auditoria::find(intval($request->id));
		        $a->file_exel_path=$nameFile;
		        $a->save();
		        return "Caregado Com Sucesso";
		        }
		        

		       
		        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
		 
		        // Verifica se NÃO deu certo o upload (Redireciona de volta)
		        if ( !$upload )
		            return 1;
		    }
		    return -1;
		}

		public function storeImageCli(Request $request,Cliente $c)
		{
		    // Define o valor default para a variável que contém o nome da imagem 
		    $nameFile = null;
		 
		    // Verifica se informou o arquivo e se é válido
		    if ($request->hasFile('image') && $request->file('image')->isValid()) {
		         
		        // Define um aleatório para o arquivo baseado no timestamps atual
		        $name = "img_".$c->id;
		 
		        // Recupera a extensão do arquivo
		        $extension = $request->image->getClientOriginalExtension();
		 
		        // Define finalmente o nome
		        $nameFile = "{$name}.{$extension}";
		 
		        // Faz o upload:
		        $upload = $request->image->storeAs('public/cliente_pic', $nameFile);

		        
		        $c->img_path=$nameFile;
		        $c->save();
		    }
		}



		public function theFile(Request $request)

		{
			    //Retornado Dados Em String
				return response()->file(Storage::disk('local')->path('public\fich_Audit\audit_'.$request->id.'.csv'));
		}

		
		public function c_detalhes($id)

		{
				  if (!Auth::user()) return redirect('login');
			    //Retornado Dados Em String
				return  view('cliente_detalhes')->with(["cliente"=>Cliente::findOrfail($id)]);
		}

		

		public function desableCli($id)

		{
			   if (!Auth::user()) return redirect('login');
			  $cli = Cliente::find(intval($id));
			  $cli->estado=1;
			  $cli->save();
			  $this->fillLog('Atualizar','Cliente');
			  return  redirect('/clientes');
		}
			public function goHome()

		{	    if (!Auth::user()) return redirect('login');
		     
			  return  view('home')->with(["eventos"=>Evento::all()]);
		}

		

		public function goToUsers(){
			   if (!Auth::user()) return redirect('login');

			  return  view('user_manage')->with(["users"=>User::where("id",">",1)->get()]);

		}

		

		public function audit_cli($id){
			   if (!Auth::user()) return redirect('login');

			  return  view('create_audit')->with(["cliente"=>Cliente::findOrFail($id)]);

		}


		public function medicao($idAuditoria,$idMedicao){
			    if (!Auth::user()) return redirect('login');

			  return  view('medidas_detalhes')->with(["auditoria"=>Auditoria::findOrFail($idAuditoria),"medicao"=>Medicao::findOrFail($idMedicao),"consumo"=>Medicao::findOrFail($idMedicao)->consumo]);/*

			  return Auditoria::find(1)->consumo()->with(["medicao"=>function($m){
			  	
			  }])->get();*/

		}


  			public function addMedicao(Request $request){
			  
			  $con = Medicao::where("id_medidor","=",intval($request->medidor))->where("id_consumo","=",intval( $request->consumo))->get()->last();
			  $count=0;
			  if($con){
			    foreach ($request->equipamentos as $value) {

		 				if($con->equipamento->contains("id",intval($value))){
					 	  	$count+=1;
					   }
			       	  
			  }
			}

			  if ($count == sizeof($request->equipamentos)) {
			  	return "Erro: Existe Equipamentos que já formam medidos!";
			  }
			

			  $medicao = new Medicao();
			  $medicao->id_consumo = intval( $request->consumo);
			  $medicao->id_medidor = intval( $request->medidor);
			  $medicao->save();

			  foreach ($request->equipamentos as $value) {
 				$medicao->equipamento()->attach(intval($value));
			  }
  			  $this->fillLog('Inserir','Medidacao');
  			  return back();

			}

			public function addMedida(Request $request){

				$medida = new Medida();

				$audit = Auditoria::findOrfail(intval($request->idAudit));
				if ($audit->c_inicio==0) {
					
					$audit->c_inicio =intval($request->cini);
					
				}
				if (intval($request->cfim)>$audit->c_fim) {
					$audit->c_fim=intval($request->cfim);
				}

				


				//$medicao = Medicao::findOrfail(intval($request->id_medicao));

			    
			    $medida->data_ini=date('Y-m-d', strtotime($this->trasnformDateString($request->dini)));
				$medida->hora_fim=$request->hfim;
				$medida->data_fim=date('Y-m-d', strtotime($this->trasnformDateString($request->dfim)));
				$medida->hora_ini=$request->hini;
				$medida->contador_ini=intval($request->cini);
				$medida->contador_fim=intval($request->cfim);
				$medida->energia=doubleval($request->energia);
				$medida->pot_max=doubleval($request->pmax);
				$medida->pot_min=doubleval($request->pmin);
				$medida->tmp_ligado=$request->tligado;
				$medida->dia_ligado=intval($request->dligado);	
				$medida->idMedicao=	intval($request->id_medicao);		
                $medida->save();

                $medicao = $medida->medicao;
				$medicao->id_consumo =  $medicao->id_consumo;
				$medicao->save();
				 
                $audit->save();
                $this->fillLog('Inserir','Medida');

			}

			public function editMedida(Request $request){

                $medida =  Medida::find(intval($request->id));
                $medida->energia=doubleval($request->energia);
				$medida->pot_max=doubleval($request->pmax);
				$medida->pot_min=doubleval($request->pmin);
				$audit = Auditoria::findOrfail(intval($request->idAudit));
				if (intval($request->cfim)>0) {
					if (intval($request->cfim)>$audit->c_fim) {
					$audit->c_fim=intval($request->cfim);
					$audit->save();
				}
					
                    
				}
                
				$medida->save();
				$medicao = $medida->medicao;
				$medicao->id_consumo =  $medicao->id_consumo;
				$medicao->save();
				
			}	

			public function concluir(Request $request){

				$a=Auditoria::findOrFail(intval($request->audit_id));
				$a->estado()->attach(4,['obs' => $request->obs]);
				$this->fillLog('Alterar','Auditoria');
				return back();

			}

				public function retomar(Request $request){

				$a=Auditoria::findOrFail(intval($request->audit_id));
				$a->save();
				$a->estado()->attach(intval($request->action),['obs' => $request->obs]);
				$this->fillLog('Alterar','Auditoria');
                
				return back();

			}
			
			public function delAudit($id){

				Auditoria::destroy(intval($id));
				$this->fillLog('Apagar','Auditoria');
			    
				return redirect('/auditorias');

			}

			

			public function alterevent(Request $request){
			
				$e = Evento::findOrFail(intval($request->id));
				$e->inicio = date('Y-m-d H:i:s', strtotime($request->inicio));
				$e->fim =    date('Y-m-d H:i:s', strtotime($request->fim));
				$e->save();              
				return "Modificação Feita";
			}

			
			
			public function addEvent(Request $request){
				
				$e = new Evento();
				$e->inicio = date('Y-m-d H:i:s', strtotime($request->inicio));

				$e->descricao =$request->descricao;
				$e->bordercolor=$request->bordercolor;
				$e->backcolor=$request->backcolor;
				$e->pub_private=intval($request->ppv);
				$e->idUser=intval($request->user);
				//retriving Tipo;
				$tipo = TipoEvento::where("descricao",$request->textTipo)->get()->last();				
				$e->idTipo=$tipo->id;

				$e->save();
				if ($e->pub_private==0) {
					//$this->nofificarEvento($e,$request->socket_id);
				}
				

				return $e->id;
			}

			public function addTipoEvent(Request $request){
				//return $request->backcolor;
				$e = new TipoEvento();
				$e->descricao =$request->descricao;
				$e->bordercolor=$request->bordercolor;
				$e->backcolor=$request->backcolor;
				$e->cor=$request->color;
				$e->idUser=intval($request->user);				
				$e->save();
				return $e->id;
			}

			public function deleteEvent(Request $request){
				//return $request->backcolor;
				Evento::destroy(intval($request->id));
			}

			public function deleteTipoEvent(Request $request){
				//return $request->backcolor;
				TipoEvento::destroy(intval($request->id));

			}

			public function setPermission(Request $request){
			  
			  $tipo = Tipouser::find(intval($request->tipo));
			   foreach ($request->permissoes as $value) {

			   		if (!$tipo ->permission()->get()->contains("id_permission",$value)) {
			   			 $tipo->permission()->attach($value);
			   		}
			   		
			   }
 				 
			  
			 $this->fillLog('Insirerir','Permissão');
  			  
  			  return back();

			}

			private function nofificarEvento(Evento $envento, $secket_id){
			  

				   $options = array(
				    'cluster' => env("PUSHER_APP_CLUSTER"),
				    'useTLS' => true
				  );

				  $pusher = new Pusher(
				    env('PUSHER_APP_KEY'),
				    env('PUSHER_APP_SECRET'),
				    env('PUSHER_APP_ID'),
				    $options
				  );

				  $data['message'] = 'E ai parceiro tudo tá funcionando';
				  $pusher->trigger('my-channel', 'my-event', $envento,$secket_id);
			  

			}  

            public function editPermission(Request $request){
                    $dat = json_decode($request->permissions,true);
                    foreach ($dat as $key => $value) {
                    	$per = Tipouser::where("descricao",$key)->get()->last();
			  		    $dat = $per->permission()->get()->map(function ($item, $key) {
           				 return $item->id_permission;
        		});
			  		$per->permission()->detach($dat);
			  		$per->permission()->attach($value);
                    }

				$this->fillLog('Alterar','Permissão');
                                    
                 return 200;
			  	;
			}

			public function lg(Request $request){
                  

                  if(Auth::attempt(["email"=>$request->email,"password"=>$request->password,"estado"=>1,"canlog"=>1])){
                  	 $this->fillLog('Login','');
                  	 return redirect()->intended();
                  }
                   return redirect()->back()->withErrors(["email"=>"Credenciais não autorizado"]); 


			}
			  public function perfil(){

			  	if (!Auth::user()) return redirect('login');
              
                return view("perfil");

			  }

			  public function edtiuser(Request $request){
                $e = User::findOrfail(intval($request->id));
                
                if ($request->name != "") {
                	$e->name =  $request->name;
                }
                if ($request->email != "") {
                	$e->email = $request->email;
                }
                $nameFile = null;
		 
		    // Verifica se informou o arquivo e se é válido
		    if ($request->hasFile('image') && $request->file('image')->isValid()) {
		         
		        // Define um aleatório para o arquivo baseado no timestamps atual
		        $name = "img_".$e->id;
		 
		        // Recupera a extensão do arquivo
		        $extension = $request->image->getClientOriginalExtension();
		        if ($request->image->getClientOriginalExtension() == 'jpg' || $request->image->getClientOriginalExtension() == 'png') {
		        	// Define finalmente o nome
		        $nameFile = "{$name}.{$extension}";
		 
		        // Faz o upload:
		        $upload = $request->image->storeAs('public/user_pic', $nameFile);

		        $e->img_path="storage/user_pic/".$nameFile;
		        }
		        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
		 
		        // Verifica se NÃO deu certo o upload (Redireciona de volta)
		      
		      }
                
                $e->save();
                return redirect("/perfil");;

			  }

			  public function mpdf(Request $request){
			  	  if (!Auth::user()) return redirect('login');
			    /*PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isJavascriptEnabled'=> true]);
			    
			    $pdf = PDF::loadView('create_eq_ins');
			    return $pdf->download('invoice.pdf');
			    */	
			    $mpdf = new \Mpdf\Mpdf();
				$mpdf->showImageErrors = true;

				// Buffer the following html with PHP so we can store it to a variable later
				ob_start();

				// This is where your script would normally output the HTML using echo or print
				echo view('create_eq_ins')->with('user','Édino Costa');

				// Now collect the output buffer into a variable
				$html = ob_get_contents();
				ob_end_clean();

				// send the captured HTML from the output buffer to the mPDF class for processing
				$mpdf->WriteHTML($html);
				$mpdf->Output();					  	

			  }

			  

			  public function addEI(Request $request ){

                 $ei = new EInstalacao();

                $ei->marca=$request->marca;
                $ei->modelo=$request->modelo;
			  	$ei->potencia=doubleval($request->potencia);
				$ei->t_entrada=doubleval($request->t_entrada);
				$ei->t_saida=doubleval($request->t_saida);
				$ei->c_entrada=doubleval($request->c_entrada);
				$ei->c_saida=doubleval($request->c_saida);
				$ei->dimensao=doubleval($request->dimensao);
				$ei->p_entrada=doubleval($request->p_entrada);
				$ei->t_equalizacao=doubleval($request->t_equalizacao);
				$ei->boost=doubleval($request->boost);
				$ei->float=doubleval($request->float);
				$ei->capacidade=doubleval($request->capacidade);
				$ei->eficencia=doubleval($request->eficencia);
				$ei->celulas=intval($request->celulas);
				$ei->idTipo=intval(TipoEI::where('descricao',$request->tipo)->get()->first()->id);
                $ei->t_temperatura=doubleval($request->t_temperatura);
				if ($request->tipo =='Painel Solar') {
					$ei->idTipoP = intval($request->tipop);
				}
				if ($request->tipo =='Bateria') {
					$ei->idTipoB = intval($request->tipob);
				}

				$ei->save();
				$this->fillLog('Inserir','Equip. Instalação');
                
			  	return redirect("/equip_instalacao");

			  }

			   public function getEI(Request $request ){
                
                  $id = TipoEI::where('descricao',$request->name)->get()->first();

                  return $id->einstal()->with(['tipob','tipop'])->get();
			   }



			 private function trasnformDateString($date){

			  	//date from dd/mm/yyyy to yyy/mm/dd
                
                  $array = explode("/",$date);

                  return $array[2]."-".$array[1]."-".$array[0];
			   }


			  

			   public function  userChange(Request $request ){

			   	$user = User::findOrfail(intval($request->user));

			     if ($request->op  == 'estado') {

			     	 $user->estado = intval($request->bool);

			     }
			     else {
                       
                       $user->canlog = intval($request->bool);

					}   

				$user->save();	              
                  
			   }

			   public function  getTasks(Request $request ){

			   	$user = Evento::where('pub_private',0)->get();
                $users =  [];
			   	foreach ($user as $var ) {
                  

                  if ((new DateTime($var->inicio) >= (new DateTime()))) {

                  	$dias = DateTimes::diffday($var->inicio);

			   		if ($dias<=3) {
			   			$var->dias = $dias;
			   			$users[] = $var;
			   		}
               	
                }
			   		
			   	         	
			   	}

			   	return  $users;          
                  
			   }

			   

			    public function  tipouserChangePermission(Request $request ){

                $per = Tipouser::findOrfail(intval($request->user));
                if (intval($request->bool)==1) {
                	$per->permission()->attach(intval($request->idPermission));
                }else{
                	$per->permission()->detach(intval($request->idPermission));
                }      
                 return 1; 
			    }


			    private function  fillLog($d,$tabela){
			    	$log = new Log();
			    	$log->descricao = $d;
			    	$log->tabela = $tabela;
			    	$log->idUser = Auth::user()->id;
			    	$log->save();
			    }


			    public function  getDaysLogs(Request $request){
			    	if(!User::isAdmin(Auth::user()))return;
			     	$cont=0;
			     	$ant_dat;
			     	$vs = [];

			     	$len=Log::where('descricao','Login')->count();
			    	$logs = Log::where('descricao','Login')->get()->map(function ($item, $key) use (&$len,&$cont,&$ant_dat,&$vs) {
			    		/* $dados = [];
			    		 $dados[]=$item->created_at;
                        */
			    		 $dat = new DateTime(DateTimes::datel($item->created_at));
			    		  if ($key ==  0) {
                         	$ant_dat = $dat;
                         	$cont++;
                         }else{
                         	 
                            if ($dat>$ant_dat) {
                            	$drill = new \stdClass();
                                $drill->y = $ant_dat->format("d/m/Y");
                                $drill->item1 = $cont;
                                $cont = 0;
                                $vs[]=$drill;
                            	$ant_dat = $dat;

                            	
                            }
                            if ($key == $len-1) {
                         	    $drill = new \stdClass();
                                $drill->y = $dat->format("d/m/Y");
                                $drill->item1 = $cont+1;
                                $vs[]=$drill;
                              }
                            
                                $cont++;                            
                         }

                         
           				
        		});
			    	return $vs;
			    }


         	 public function  getFaturas(Request $request,$id){
                
                if (!Auth::user()) return redirect('login');
                $audit = Auditoria::findOrfail(intval($id))->fatura();

                $dados=[];
                $dados['max']= $audit->max('consumo');               
                $dados['min']= $audit->min('consumo');              
                $dados['avg']= $audit->avg('consumo');
                $dados['dados']  =  $audit->orderBy('data','asc')->get()->map(function ($item, $key) {
                   $dat= [];
                   $dat[]= (new DateTime($item->data))->format("d/M/Y");
                   $dat[]=$item->consumo;
                   return $dat;
              }); 

              return $dados;  

       		 }
       		 public function addFatura(Request $request){
       		 	$false=false;
                if (!Auth::user()) return redirect('login');
                $fat = Fatura::where('data',$this->trasnformDateString($request->data))->get()->last(); 
                if (isset($fat->id)) {

                	 $fat->consumo=doubleval($request->consumo);
                	 $fat->save();
                	if (doubleval($request->consumo)==0) {
                		    Fatura::destroy(intval($fat->id));                			             		
                	}
                	$false=true; 
                }
                if (!$false) {
                	 $fatura = new Fatura();
                $fatura->data=date('Y-m-d', strtotime($this->trasnformDateString($request->data)));
                $fatura->consumo=doubleval($request->consumo);
                $fatura->id_auditoria=intval($request->id);
                $fatura->save();
                }
               
       		 }
           


			 public function lnchange(Request $request){
			      Session::put('applocale',$request->locale);
			       return redirect()->back();
			 }

			public function editEquipLD(Request $request,$id){

				return view('editld')->with('equip',Equipamento::findOrfail(intval($id)));


			}

			public function editELD(Request $request){ 

              $equip=Equipamento::findOrfail(intval($request->idEquip));
              $equip->fill($request->all());
              $equip->save();
              return  redirect('equip_ld');

			}



			 public function edit_audit($id)
			{
				 if (!Auth::user()) return redirect('login');
               
				return view('edit_audit')->with(["auditoria"=>Auditoria::findOrfail($id)]);
			}
			public function edtiaudit(Request $request)
			{
				$a = Auditoria::findOrfail(intval($request->id));
				$a->descricao=$request->descricao;
				$data = explode(" - ", $request->date);
				$a->data_inicio=date('Y-m-d', strtotime($this->trasnformDateString($data[0])));
				$a->data_fim=date('Y-m-d', strtotime($this->trasnformDateString($data[1])));
				$a->save();
				return redirect('/audit_res/'.$request->id);
			}
              
  

  
}
?>