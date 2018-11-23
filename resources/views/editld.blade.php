@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
 Alteração de Equipamento
  <small>{{$equip->nome}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a ><i >Equipamentos</i></a></li>
    <li><a  href="/equip_ld" ><i >Eletrodoméstico</i></a></li>
    <li class="active"><a ><i >Editar</i></a></li>
  </ol>
</section>
<br>
<div class="row containerLocal" ng-controller="equip_ldController">
  
    <div class="box box-info">
      <div class="box-header">
        
      </div>
     
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="/editELD">
          @csrf
            <div class="form-group">
              <input type="number" name="idEquip" hidden value="{{$equip->id}}" placeholder="">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nome">Nome*</label>
                  <input value="{{$equip->nome}}" name="nome" required type="text" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label for="morada" >Marca*</label>
                  <input value="{{$equip->marca}}" required type=text name="marca" class="form-control form-control-sm deletale "  >
                </div>
                
              </div><br>
              
              <div class="row">
                <div class="col-sm-6">
                  <label >Modelo</label>
                  <input   value="{{$equip->modelo}}" type="text" required  name="modelo" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label  >Tensão</label>
                  <input min="0"    value="{{$equip->tensao}}" name="tensao" required step="any" type="number" class="form-control form-control-sm deletale ">
                </div>
                
              </div><br/>
              <p style="position: absolute;" class="text-muted">Extra</p>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <label >Consumo</label>
                  <input min="0"  value="{{$equip->consumo}}" name="consumo" required step="any"  type="number" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label  >Potências</label>
                  <input min="0"    value="{{$equip->potencia}}" name="potencia" required step="any" type="number" class="form-control form-control-sm deletale ">
                  
                </div>
              </div>
                     <hr/>
              <div class="row">
                <div class="col-sm-6">
                  <label >Frequência</label>
                  <input min="0"   value="{{$equip->frequencia}}" name="frequencia" required step="any" type="number" class='form-control form-control-sm deletale ' >
                </div>
                <div class="col-sm-6">
                  <label  >Corrente</label>
                  <input min="0"   value="{{$equip->corrente}}" name="corrente" required step="any" type="number" class="form-control form-control-sm deletale ">
                  
                </div>
              </div>
               <br/>
              <label>Série</label>
              <input min="0"   value="{{$equip->serie}}" name="serie" required step="any" type="number" class="form-control form-control-sm deletale ">           
            
              <br/>
              <label>Categoria</label>
               <select    class="form-control form-control-sm deletale " name="id_categoria">
               @foreach (App\Categoria::all() as $categoria)
              <option @if($equip->id_categoria === $categoria->id) selected @endif value="{{$categoria->id}}">{{$categoria->descricao}}</option>
              @endforeach
            </select>
            <br/>
              <label>Alimentação</label>
               <select value="{{$equip->alimentacao}}" class="form-control form-control-sm deletale " name="alimentacao">               
               <option  @if($equip->alimentacao === "Mono-Fásico") selected @endif value="Mono-Fásico">Mono-Fásico</option>  
               <option  @if($equip->alimentacao === "Tri-Fásico") selected @endif value="Tri-Fásico">Tri-Fásico</option>            
            </select>              
              
              
              
            </div>
              <md-button  type='submit' style="background-color: #3c8dbc; color: white; width: 100%;left: -8px; " class="md-raised mx-auto">Guardar</md-button>
          </form>
      </div>
      <!-- /.box-body -->
    </div>
  
</div>
<!-- /.container" -->
@endsection
