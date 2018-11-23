@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
@if(Auth::user()->idTipo!=1)
<script>
window.location.href = '/home';
</script>
@endif
<section class="content-header">
  <h1>
  Gestão de Utilizadores
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol>
</section><br>
<br>
<div class="containerLocal">
  <div ng-controller='usermanage' class="box box-info" style="overflow: auto">
  <div class="nav-tabs-custom" style="min-height: 500px;overflow: auto ">
    <ul class="nav nav-tabs pull-right" >
      <li><a data-target="#tab_3-3" href="" data-toggle="tab">ADICIONAR</a></li>
      <li><a data-target="#tab_2-2" href="" data-toggle="tab">PERMISSÕES</a></li>
      <li class="active" ><a data-target="#tab_1-1" href="" data-toggle="tab">UTILIZADORES({{$users->count()}})</a></li>
      <li class="pull-left header"><i class="fa fa-th"></i> <b class="text-yellow">User Manage</b></li>
    </ul>
    <div class="tab-content">
      <br>
      @if (isset($newuser))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Secesso!</h4>
        Utilizador <b> {{$newuser}}</b> Inserido
      </div>
      {{-- expr --}}
      @endif
      <br>
      <div class="tab-pane active " id="tab_1-1">
        <div class="box-body">
          
          
          <table id="example1" class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Estado(Act/Desat)</th>
                <th>Login(Sim/Não)</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr >
                <td>
                  <img src="{{$user->img_path}}" class="img-circle" style="height: 30px;width: 30px;"  alt="">&nbsp;
                  {{$user->name}}
                </td>
                <td>{{$user->tipouser->descricao}}</td>
                <td>{{$user->email}}</td>                 
                  <td>

                    <input type="checkbox" onchange="setState(this.checked,this.value)" @if($user->estado == 1) checked @endif  value="{{$user->id}}" ></td>
                 <td>


                  <input type="checkbox" @if($user->canlog == 1) checked @endif onchange="setCanLog(this.checked,this.value)"  value="{{$user->id}}" > </td>               
              </tr>
              @endforeach
            </tbody>
            
          </table>
        </div>
      
      </div>

      <div class="tab-pane" id="tab_2-2">
        <p style="display: none" id="successM" class="text-success pull-right"><b>Alterações salvas!</b></p>
        <table id="example1" class="table table-hover table-bordered table-striped">
          <thead>
            <tr style="background-color: #3c8dbc; color: #fff">              
              <th>Permissão</th>
               @foreach (App\Tipouser::where('descricao','!=','Administrador')->get() as $tipo)
              <th>              
             {{$tipo->descricao}}
            </th>
            @endforeach
            {{--  
              <th>Técnico</th>
              <th>Gestor</th>
              <th>Estagiário</th>
             --}}
            </tr>
          </thead>
          <tbody>
            @foreach (App\Permission::all() as $permi)
            <tr >              
              <td>{{$permi->nomePermissao}}</td>
 

              @foreach (App\Tipouser::where('descricao','!=','Administrador')->get() as $tipo)
              <td>              
                <input type="checkbox" @if($permi->tipouser()->get()->contains("descricao",$tipo->descricao)) checked @endif class="Tec" onchange="changePermission(this.checked,{{$tipo->id}},{{$permi->id_permission}});" >
              </td>
              @endforeach   
             {{--
              <td><input type="checkbox" @if($permi->tipouser()->get()->contains("descricao","Tecnico")) checked @endif class="Tec" value="{{$permi->id_permission}}" ></td>
              <td><input type="checkbox" @if($permi->tipouser()->get()->contains("descricao","Gestor")) checked @endif class="Ges" value="{{$permi->id_permission}}" ></td>
              <td><input type="checkbox" value="{{$permi->id_permission}}" @if($permi->tipouser()->get()->contains("descricao","Estagiário")) checked @endif class="Est" ></td>
              --}}
            </tr>
            @endforeach
          </tbody>
          
        </table>
        
        <br><br>
        <div class="row col-sm-6">
          <div id="mv" class="box box-primary" >
            <div class="box-header with-border">
              <h4 class="box-title">Atribuição de Permissoes</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->


               <form  role="form"action="/setPermission"method="post" accept-charset="utf-8">
                 <div class="box-body">
          
          <div ng-cloak class="row">
            
          @csrf
                    
            <div class="form-group col-sm-6">
                <label>Tipo</label>
                <select required class="form-control select2" name="tipo" data-placeholder="Selecionar Tipo"
                        style="width: 100%;"> 
                         @foreach (App\TipoUser::where("descricao","!=","Administrador")->get() as $permi)
                       <option value="{{$permi->id}}" >{{$permi->descricao}}</option>
                  @endforeach

                </select>
              </div>
               <div class="form-group col-sm-6">
                <label>Permissões</label>
                <select class="form-control select2" name="permissoes[]" multiple="multiple" data-placeholder="Selecionar Permissões" style="width: 100%;"> 

                  @foreach (App\Permission::all() as $permi)
         
                     <option  value="{{$permi->id_permission}}">{{$permi->nomePermissao}}</option>
              
                  @endforeach

                </select>
              </div>              
        </div>
      
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">ATRIBUIR</button>
              </div>
          </form>
           
          </div>
        </div>
        
      
         
      </div>
      <div class="tab-pane" id="tab_3-3" style="overflow: auto;">
        <p style="font-size:0.9em; width: 100%; text-align: center;">
          <span > <b>Preenche os campos abaixo para criar um novo utilizador</b></span>
        </p>
        <form method="post" action="/adicionar_utilizaor">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="nome">Nome</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input name="nome" type="text" required class='form-control form-control-sm' id="nomes" placeholder='nome completo' > </div>
          </div>
          
          
          <div class="form-group" >
            <label for="email" >Email</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="email" name=email class="form-control" required  id="email" placeholder="user@exemplo.com" placeholder="Email">
            </div>
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" name="password" class="form-control" placeholder="palavra passe aqui" id="password" >
              
            </div>
            
          </div>
          <div class="form-group">
            <label for="password">Tipo de Utilizador</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-cog"></i></span>
              <select name="tipo" class="form-control">
                @foreach (App\TipoUser::where("descricao","!=","Administrador")->get() as $tipo)
                <option value="{{ $tipo->id}}">{{ $tipo->descricao}}</option>
                @endforeach
              </select>
            </div>
            
          </div>
          
          <div class="form-group" class="row">
            
              <md-checkbox  ng-model="c1" class="md-primary">
              <b>Activado</b>
              </md-checkbox>
           
              <md-checkbox   ng-model="c2"  class="md-primary">
              <b>Login</b>
              </md-checkbox>

              <input hidden="true" type="checkbox" name="activado" ng-model="c1">


              <input hidden="true" type="checkbox" name="login" ng-model="c2">
            
          </div>
          <div>
            <div class="form-group" >
              <label  for="password">Confirmar</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="re-introduza a palavra passe" oninput="check(this)" >
                <script language='javascript' type='text/javascript'>
                function check(input) {
                if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Palavra passes nao confirmado!!!');
                } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
                }
                }
                </script>
              </div>
              
            </div>


            
          </div>
          
          
          <md-button  style=" margin-left: 23px;background-color: orange;color: white" class="md-raised  mx-auto pull-right" type="submit">Guardar</md-button>
          <md-button  type="reset" style="background-color: #494850;color: white" class="md-raised  mx-auto pull-right">Limpar</md-button>
        </form>
        
      </div>
      
    </div>
    <!-- /.tab-content -->
    
    
  </div>
  <!-- nav-tabs-custom -->
</div>  
</div>

@endsection