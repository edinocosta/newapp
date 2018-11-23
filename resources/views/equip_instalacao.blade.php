@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
  Equipamentos de Istalação
  <small>Lista de equipamentos cadastrados</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a ><i >Equipamentos</i></a></li>
    <li class="active"><a><i >Istalação</i></a></li>
  </ol>
</section>
<br>
<div class="row containerLocal" >
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title">Lista de Equipamentos</h3>
      </div>
     
      <!-- /.box-header -->
      <div class="box-body">        
        <div class="box-body table-responsive">

          <div ng-controller="equip_eiController">
            
          

        	 <select ng-model="typ" ng-change="getEI(typ)" class="form-control form-control-sm col-sm-6">
               @foreach (App\TipoEI::all() as $categoria)
              <option value="{{$categoria->descricao}}">{{$categoria->descricao}}</option>
              @endforeach
            </select>
          <table  id="example3" class="table  table-hover table-bordered table-striped">
            
            <thead>
            	
              <tr>

                <th ng-repeat="eq in equips1">@{{eq.label}}</th>
              </tr>
            </thead>
            <tbody>
                         
            </tbody>
          </table>
          </div>
          @can('create',App\Equipamento::class)
          <md-button id="leftmd"  class="md-mini md-primary"  ng-cloak data-toggle="collapse" data-target="#multiCollapseExample1"  aria-expanded="false" aria-controls="multiCollapseExample1" ng-cloak ><b>Adicionar</b> </md-button>
          
          <br><br>
    <div class="collapse multi-collapse"id="multiCollapseExample1">
      <div class="card card-body">
        <div class="ext-content">
          <form action="/addEI" method="post">
          	@csrf
            <div ng-controller="equip_eiController2" class="form-group">
              
              <div class="row" >
              	<hr style="margin: 14px">
                <div class="col-sm-6">
                  <label for="nome">Marca</label>
                  <input required name="marca" type="text" class='form-control form-control-sm' >
                </div>
                <div class="col-sm-6">
                  <label for="nome">Modelo</label>
                  <input required name="modelo" type="text" class='form-control form-control-sm' >
                </div>
               

                {{--

                 <div class="col-sm-6">
                  <label for="morada" >Marca</label>
                  <input ng-model="marca" type=text class="form-control" form-control-sm >
                </div>
                 --}}
                
              </div>
              <label>Deseguinaçao do Equipamento</label>
               <select required  ng-model="categorias" class="form-control form-control-sm" name="tipo">
               @foreach (App\TipoEI::all() as $categoria)
              <option value="{{$categoria->descricao}}">{{$categoria->descricao}}</option>
              @endforeach
            </select>
              	<br>
              <div class="row" >
                <div class="col-sm-6" ng-repeat="eq in equip[categorias]">
                  <label for="nome">@{{eq.label}}</label>
                  <input required  name="@{{eq.name}}" step="any" type="number" class='form-control form-control-sm ' >
                </div>
                 <div  ng-show="categoria == 'Bateria'" class="col-sm-12" >
                  <label >Tipo De Bateria</label>
                  <select  required  class="form-control form-control-sm" name="tipob">
                  	 @foreach (App\Tipobateria::all() as $categoria)
		              <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
		             @endforeach
                  </select>
                </div>


                 <div  ng-show="categoria == 'Painel Solar'" class="col-sm-6" >
                  <label >Tipo de Painel</label>
                  <select  required  class="form-control form-control-sm"   name="tipop">
                  	 @foreach (App\Tipopainel::all() as $categoria)
		              <option value="{{$categoria->id}}">{{$categoria->descricao}}</option>
		             @endforeach
                  </select>
                </div>
                {{--
                  parsedouble
                 <div class="col-sm-6">
                  <label for="morada" >Marca</label>
                  <input ng-model="marca" type=text class="form-control" form-control-sm >
                </div>
                 --}}
                
              </div>
              <br>
              
       
            </div>
            <md-button type="submit"  id='rightmd'  class="md-raised md-primary mx-auto pull-right" >Guardar</md-button>
          </form>

        </div>
      </div>
      
    </div>
    @endcan
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  
</div>
<!-- /.container" -->
@endsection
