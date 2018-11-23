@extends('layouts.app')
@section('content')
<!-- .container" -->

<section class="content-header">
  <h1>
  Novo Equipamento
  <small>Registro de um novo equipamento eletrodoméstico</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a >Equipamentos</a></li>
    <li > <a href="/equip_ld"> <i >Istalação</i> </a> </li>
    <li class="active" ><a><i >Criar</i></a></li>
  </ol>
</section><br>
<div class="containerLocal">
  <div class="box box-info" ng-controller="addEquipLd">
  <div class="box-header">
    <h3 class="box-title">Informações</h3>
  </div>
  <div class="box-body">
    <!-- Date and time range -->
    <form>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nome">Nome*</label>
                  <input ng-model="nome"  type="text" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label for="morada" >Marca*</label>
                  <input ng-model="marca" type=text class="form-control form-control-sm deletale "  >
                </div>
                
              </div><br>
              
              <div class="row">
                <div class="col-sm-6">
                  <label >Modelo</label>
                  <input    ng-model="modelo" type="text" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label  >Tensão</label>
                  <input min="0"    ng-model="tensao" type="number" class="form-control form-control-sm deletale ">
                </div>
                
              </div><br/>
              <p style="position: absolute;" class="text-muted">Extra</p>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <label >Consumo</label>
                  <input min="0"   ng-model="consumo"  type="number" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label  >Potências</label>
                  <input min="0"    ng-model="potencia" type="number" class="form-control form-control-sm deletale ">
                  
                </div>
              </div>
                     <hr/>
              <div class="row">
                <div class="col-sm-6">
                  <label >Frequência</label>
                  <input min="0"   ng-model="frequencia" type="number" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label  >Corrente</label>
                  <input min="0"   ng-model="corrente" type="number" class="form-control form-control-sm deletale ">
                  
                </div>
              </div>
               <br/>
              <label>Série</label>
              <input min="0"   ng-model="serie"  type="number" class="form-control form-control-sm deletale ">           
            
              <br/>
              <label>Categoria</label>
               <select   ng-model="categoria" class="form-control form-control-sm deletale " name="tipo">
               @foreach (App\Categoria::all() as $categoria)
              <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
              @endforeach
            </select>
            <br/>
              <label>Alimentação</label>
               <select ng-model="alimentacao" class="form-control form-control-sm deletale " name="tipo">               
               <option value="Mono-Fásico">Mono-Fásico</option>  
               <option value="Tri-Fásico">Tri-Fásico</option>            
            </select>              
              
              
              
            </div>
             <label for="drop-remove">
                <input type="checkbox" id="drop-remove">
                Inserir e Continuar a Inserir
              </label>
              <md-button ng-disabled="!nome || !marca || !corrente || !tensao "  type="button" ng-click="addEquip()" style="background-color: #3c8dbc; color: white; width: 100%;left: -8px; " class="md-raised mx-auto">Guardar</md-button>
          </form>

    </div>
    
    <!-- <md-button class="md-raised md-primary mx-auto" ng-cloak>Primary</md-button> -->
    <!-- /.input group -->
  </div>
  <!-- /.box-body -->
  <!-- /.box -->
  <!-- /.container" -->
  <!-- Modals -->
 
</div>


@endsection


















