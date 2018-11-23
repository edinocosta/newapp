@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Detalehes do Cliente
  <small>..</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a href="/clientes">Clientes</a></li>
    <li class="active"><a href=""><i >Detalhes</i></a></li>
  </ol>
</section>
<br>
<div class="row containerLocal" ng-controller="clienteAreaController">
    <div class="box box-warning">
      <div class="box-header">
      </div>
      <div class="box-body">
        <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom" style="min-height: 500px">
            <ul class="nav nav-tabs pull-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Actividades <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="/c_auditoria/{{$cliente->id}}">Cria Auditoria</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Agendar Visita</a></li>
                </ul>
              </li>
              <li><a data-target="#tab_2-2" href="" data-toggle="tab">Propriedades({{$cliente->propriedade->count()}})</a></li>
              <li class="active" ><a data-target="#tab_1-1" href="" data-toggle="tab">Informações</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> <b class="text-aqua">Detalhes</b></li>
            </ul>
            <div class="tab-content">
              <br><br>
              <div class="tab-pane active" id="tab_1-1">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    @if(strlen($cliente->img_path)!=0)
                    <img class="profile-user-img img-responsive img-circle" src={{asset("storage/cliente_pic/".$cliente->img_path)}} alt="{{$cliente->img_path}}">
                    @else
                    <img class="profile-user-img img-responsive img-circle" src={{asset("img/alt_pic.jpg")}} alt="{{$cliente->img_path}}">
                    @endif
                    <h3 class="profile-username text-center">{{$cliente->nome}}</h3>
                    <p class="text-muted text-center">...</p>
                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item row">
                        <div class="col-sm-6">
                          <b>Telefone</b>
                        </div>                        
                         <div class="col-sm-6">
                          <a class="pull-right" >{{$cliente->telefone}}</a>
                        </div>
                         
                      </li>

                      <li class="list-group-item row ">
                        <div class="col-sm-6">
                         <b>Email</b>
                        </div>

                        <div class="col-sm-6">
                         <a class="pull-right">{{$cliente->email}}</a>
                        </div>
                         
                      </li>
                      <li class="list-group-item row ">
                        <div class="col-sm-6">
                         <b>Morada</b>
                        </div>
                        <div class="col-sm-6">
                         <a class="pull-right">{{$cliente->morada}}</a>
                        </div>
                         
                      </li>
                      <li class="list-group-item row ">
                        <div class="col-sm-6">
                         <b>Nif</b>
                        </div>
                        <div class="col-sm-6">
                         <a class="pull-right">{{$cliente->nif}}</a>
                        </div>
                         
                      </li>
                    </ul>
                    <a href="mailto:{{$cliente->email}}?subject=feedback" "email me" class="btn btn-primary btn-block" target="_top"><b>ENVIAR MENSAGEM</b></a>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!--Informações sobre O cliente -->
                <span class="text-blue"><h5><b><i>Criado á {{App\DateTimes::differTime($cliente->created_at)}}</i></b></h5></span>
                @if(App\User::isAdmin(Auth::user()))
                @php
                    $user=App\Log::where('created_at',$cliente->created_at)->get();                    
                @endphp
                
                 <p>Criado por : @if(sizeof($user)>0) {{$user->last()->user->name}}@else Indisponível @endif  </p>
                @endif                
                 
                <br>
                
                <div class="collapse multi-collapse"id="multiCollapseExample1">
                  <div class="card card-body">
                    <div class="ext-content"  style="overflow: auto" >
                      <form method="post" action="/editCliente">
                        @csrf
                        
                        <div class="form-group">
                          <label for="nome">Nome</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input name="nome" value="{{$cliente->nome}}"  required type="text" class='form-control form-control-sm' id="nomes" placeholder='nome completo' > </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="morada" >Morada</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input name="morada" type=text value="{{$cliente->morada}}" class="form-control" form-control-sm id="morada" placeholder='Localidade, Cidade, Ilha' >
                          </div>
                          
                        </div>
                        <div class="form-group" >
                          <label for="email" >Email</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="email" value="{{$cliente->email}}"  class="form-control"   id="email" placeholder="user@exemplo.com" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="telefone">Telefone</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" name="telefone" value="{{$cliente->telefone}}"  class="form-control"  id="telefone" data-inputmask='"mask": "9999999"' data-mask>
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="nif">NIF</label>
                          <input type="text" name="nif" value="{{$cliente->nif}}" class='form-control form-control-sm' id="nif" data-inputmask='"mask": "999999999"' data-mask>
                        </div>
                        <input type="number" hidden name="idCliente" value="{{$cliente->id}}" placeholder="">
                        <div layout="row" layout-align="end end" flex>
                          <md-button type="submit" class="md-mini md-primary" md-ripple-size="auto"><b>SALVAR</b></md-button>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                  
                </div>
                <div style="margin-top: 5%;float: right">
               
                @if(App\User::isAdmin(Auth::user()))
                    <button type="button" class="btn btn-warning" onclick="if(confirm('Voece quer realmente Apagar/Desativar {{$cliente->nome}}?')) window.location.href ='/delete/cliente/{{$cliente->id}}';" >APAGAR</button>
                  <button type="button" data-toggle="collapse"data-target="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-primary">EDITAR</button>
                @endif   
                
                </div>
              </div>
              
              <div class="tab-pane" id="tab_2-2">
                 @if ($cliente->propriedade->count()!=0)
                        <table class="table  table-striped table-bordered pointable">
                          <tr>
                            <th>Local</th>
                            <th>Descrição</th>
                            <th>Compartimentos</th>
                            <th>Auditorias</th>
                          </tr>
                          
                          @foreach ($cliente->propriedade()->get() as $propriedade)
                          <tr onclick="window.location.href='/edit_prop/{{$propriedade->id}}';">
                            <td ><a href="https://www.google.com/search?&q={{$propriedade->geolocalizacao}}">{{$propriedade->local}} &nbsp;&nbsp; *Google Map</a></td>
                            <td>{{$propriedade->descricao}}</td>
                            <td><center><span class="badge bg-orange mx-auto">{{$propriedade->compartimento->count()}}</span></center></td>
                            <td><center><span class="badge bg-green mx-auto">{{sizeof($propriedade->auditoria()->get())}}</span></center></td>
                          </tr>
                          @endforeach
                        </table>
                        <md-button class="md-mini md-primary pull-right" data-toggle="modal" data-target="#addProp" md-ripple-size="auto">ADICIONAR</md-button>
                        
                        @else
                        <span    class="text-danger">!!Nemhuma propriedade encontrada!!</span>
                        <span    class="text-info"><a   data-toggle="modal" data-target="#addProp"  href="#" >ADICIONAR</a></span>
                        @endif
                        
              </div>
              
            </div>
            <!-- /.tab-content -->
            
            
          </div>
          <!-- nav-tabs-custom -->
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="modal fade" id="addProp" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog box box-warning" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nova Propridade</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="ext-content">
            <form>
              <div class="form-group">
                <label for="formGroupExampleInput">Local</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <input type="text" class="form-control form-control-sm" id='local' placeholder='Localidade, Cidade, Ilha' >
                </div>
                
              </div>
              <div class="form-group">
                <label for="loc" >Geolocalização</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map"></i>
                  </div>
                  <input type="text" class="form-control form-control-sm" ng-model="geo" id='loc' placeholder='latitude, longitude' >
                </div>
                
              </div>
              <div class="form-group">
                <label for="loc" >Descrição</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-align-center"></i>
                  </div>
                  <input type="text" class="form-control form-control-sm" ng-model="desc" id='desc' >
                </div>
                
              </div>
              <br><md-button md-no-ink class="md-primary mx-auto" onclick="getCurrentLocation()"><b>Usar Atual Localização</b></md-button>
            </form><br>
            
          </div>
        </div>
        <div class="modal-footer">
          <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
          <md-button type="button"  ng-click="addProp({{$cliente->id}})" class="md-raised md-primary " >Guardar</md-button>
        </div>
      </div>
  </div>
</div>
<!-- /.container" -->
@endsection