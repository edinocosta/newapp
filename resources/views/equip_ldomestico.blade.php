@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
  Equipamentos Eletrodoméstico
  <small>Lista de equipamentos cadastrados</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a ><i >Equipamentos</i></a></li>
    <li class="active"><a ><i >Eletrodoméstico</i></a></li>
  </ol>
</section>
<br>
<div class="row containerLocal" ng-controller="equip_ldController">
  
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title">Lista de Equipamentos</h3>
      </div>
     
      <!-- /.box-header -->
      <div class="box-body">
        @can('create',App\Equipamento::class)
          <md-button class="md-mini md-warn" ng-cloak href="/c_eq_ld"  aria-label="ADD ONE"md-ripple-size="auto"><b>Adicionar</b></md-button>

        <md-button class="md-mini" style="color:#3c8dbc"  ng-cloak data-toggle="modal" data-target="#addEq"   aria-label="ADD ONE"md-ripple-size="auto"><b>Adicionar Rápido</b></md-button>
        @endcan
        <div class="box-body table-responsive">
          <table id="example1" class="table  table-hover table-bordered table-striped">
            
            <thead>
              <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Potências(watt)</th>
                <th>Tensão(volt)</th>
                <th>Consumo( kwh/ano)</th>
                <th>Opções</th>
               
              </tr>
            </thead>
            <tbody>
              @foreach (App\Equipamento::with(["categoria"=>function($c){
               $c->select("id","descricao");
              }])->get() as $equip_ld)
              <tr>
                <td>{{$equip_ld->nome}}</td>
                <td>{{$equip_ld->marca}}</td>
                <td>{{$equip_ld->modelo}}</td>
                <td>{{$equip_ld->potencia}}</td>
                <td>{{$equip_ld->tensao}}</td>
                <td>{{$equip_ld->consumo}}</td>
                <td>
                  <div class="pull-right">

                  <a data-toggle="modal" data-target="#deTalhes" href="#" ng-click="switch({{$equip_ld}})"><i class="fa  fa-eye"></i></a>
                  &nbsp; &nbsp; @if(App\User::isAdmin(Auth::user()))<a href="/editld/{{$equip_ld->id}}" ><i class="fa fa-edit"></i></a>  &nbsp;&nbsp;@if(Auth::user()->idTipo == 1)
                  <a  href="#" ><i class="fa  fa-trash-o"></i></a>
                  </div>
                  @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
            
          </table>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  
  <!-- /.col -->
  <div class="modal fade" id="addEq" tabindex="-1" role="dialog" ng-controller="addFEquipLd"  aria-hidden="true">
  <div class="modal-dialog box box-warning"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Equipamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="ext-content">
          <form>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nome">Nome</label>
                  <input ng-model="nome"  type="text" class='form-control form-control-sm' >
                </div>
                <div class="col-sm-6">
                  <label for="morada" >Marca</label>
                  <input ng-model="marca" type=text class="form-control" form-control-sm >
                </div>
                
              </div><br>
              
              <div class="row">
                <div class="col-sm-6">
                  <label >Modelo</label>
                  <input  ng-model="modelo" type="text" class='form-control form-control-sm' >
                </div>
                <div class="col-sm-6">
                  <label  >Tensão</label>
                  <input min="0"  ng-model="tensao" type="number" class="form-control form-control-sm">
                </div>
                
              </div><br>
              <p style="position: absolute;" class="text-muted">Extra</p>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <label >Consumo</label>
                  <input min="0"  ng-model="consumo" type="number" class='form-control form-control-sm' >
                </div>
                <div class="col-sm-6">
                  <label  >Potências</label>
                  <input min="0"  ng-model="potencia" type="number" class="form-control form-control-sm">
                  
                </div>

                
              </div>
              <br>
              <label>Categoria</label>
               <select ng-model="categoria" class="form-control form-control-sm" name="tipo">
               @foreach (App\Categoria::all() as $categoria)
              <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
              @endforeach
            </select>
              
              
              
              
            </div>
            
          </form><br>
          
        </div>
      </div>
      <div class="modal-footer">
        <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
        <md-button type="button"  ng-click="addEquip()" class="md-raised md-primary " >Guardar</md-button>
      </div>
    </div>
  </div>
</div>

  <!-- Modals -->
  <div class="modal fade" id="deTalhes" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog box box-warning"  role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">@{{equip.nome}}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="ext-content">
            <div class="card card-body">



              <div class="row">
                <div class=" col-sm-6">
                  <p><b>Categoria</b>&nbsp;@{{equip.categoria.descricao}}</p>
                </div>
                
                <div class=" col-sm-6">
                   <p><b>Alimentacao</b>&nbsp; @{{equip.alimentacao}} </p>
                </div>
                </div>
                
              
                 <div class="row">
                <div class=" col-sm-6">
                   <p><b>Frequência</b>&nbsp;@{{equip.frequencia}}</p>
                </div>
                <div class=" col-sm-6">
                   <p><b>Corrente</b>&nbsp;@{{equip.corrente}}</p>
                </div>
                
                </div>
              
              

              <div class="row">
                <div class=" col-sm-6">
                   <p><b>Série</b> &nbsp;@{{equip.frequencia}}</p>
                </div>
                <div class=" col-sm-6">
                   <p><b>Tensão</b>&nbsp;@{{equip.tensao}}</p>
                </div>
                
              </div>
             

            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Voltar</md-button>
        </div>
      </div>
    </div>
  
</div>
</div>
<!-- /.container" -->
@endsection
