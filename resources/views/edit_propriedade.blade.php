@extends('layouts.app')
@section('content')
<!-- .container" -->
<section class="content-header">
  <h1>
  Gestão de Propriedade
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a href="/clientes">Clientes</a></li>
    <li ><a href="/cliente/detalhes/{{$propriedade->cliente->id}}">Detalhes</a></li>
    <li class="active"><a href=""><i >Propriedade</i></a></li>
  </ol>
</section>
<br>
<div class="box  box-warning" ng-controller="edit_PropController">
   <div class="box-body">
    <div class="nav-tabs-custom" style="min-height:360px; overflow: auto">
      <ul class="nav nav-tabs pull-right">
        <li><a href="" data-target="#tab_2-2" data-toggle="tab">INFO</a></li>
        <li class="active"><a href="" data-target="#tab_1-1" data-toggle="tab">Compartimentos({{$propriedade->compartimento->count()}})</a></li>
        <li class="pull-left header"><i class="fa fa-th"></i> Proprietario(a) <b class="text-green"><small>{{$propriedade->cliente->nome}}</small></b></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" style="min-height:360px;" id="tab_1-1">
           @if($propriedade->compartimento->count()!=0)
          <table class="table table-hover">
            <caption style="margin-left: 8px">Lista de Compartimentos</caption>
            <thead>
              <tr>
                <th>Descrição</th>
                <th>Piso</th>
                <th>Comprimento(m)</th>
                <th>Largura(m)</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($propriedade->compartimento as $compart)
              <tr>
                <td>{{$compart->nome}}</td>
                <td>{{$compart->piso}}</td>
                <td>{{$compart->comprimento}}</td>
                <td>{{$compart->largura}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <!--  Descrição -->
          @else
          
          <span  class="text-danger">Esta propriedade ainda não não possui nenhum Compartimento!!</span>
          @endif
          <br>
          <md-button style="margin-left: -5px" class="md-mini md-primary"  ng-cloak data-toggle="collapse"data-target="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" ng-cloak md-ripple-size="auto"><b>Adicionr Compartimento</b></md-button>

          <md-button style="margin-left: -5px" class="md-mini md-primary"  ng-cloak  role="button" aria-expanded="false"  ng-cloak md-ripple-size="auto"><b>Instalar Sistema Fotovoltaico</b></md-button>

          <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
              <div class="ext-content">
                <form method="post" action="/addCompart">
                   {{ csrf_field() }}
                  <div class="form-group">
                    <label for="desc">Descrição</label>
                    <input type="text" required class="form-control form-control-sm" name="nome" placeholder='nome / descricão' >
                  </div>
                  <div class="form-group">
                    <label for="piso" >Piso</label>
                    <input type="number" required class="form-control form-control-sm"    name='piso' placeholder='piso'  >
                    
                  </div>
                  <div class="form-group">
                    <label for="larg" >Comprimento</label>
                    <input type="number" step="any" required class="form-control form-control-sm" name='comprimento'  step="any" placeholder='metro'  >
                    
                  </div>
                  <div class="form-group">
                    <label for="larg" >Largura</label>
                    <input type="number" step="any" required class="form-control form-control-sm" step="any"  name='largura' placeholder='metro'  >
                    
                  </div>
                   <input hidden  name="prop_id" value="{{$propriedade->id}}">
                  <div class="form-group">
                    <label for="alt" >Altura</label>
                    <input type="number" step="any"  required class="form-control form-control-sm" step="any"  name='pe_direito'  placeholder='altura/pé-direito'   >
                  </div>
               <md-button type="submit"   class="md-raised md-primary mx-auto pull-right" >Guardar</md-button>
              
                </form>
                
              </div>
            </div>
          
          </div>
          
        </div>
    
        <!-- /.tab-pane -->
        <div class="tab-pane" style="min-height:360px;" id="tab_2-2">
            <div ng-click="smap('{!!$propriedade->geolocalizacao!!}')" class="card card-body" style="background-color: rgb(128,128,128,80)">
            <div style="width: 100%; height: 300px;" id="map"></div>
            
            
          </div>
         </div> 
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3-2">
          
        </div>
        <!-- /.tab-pane -->
      </div>

        </div>
      <!-- /.tab-content -->
    </div>
    
    
  </div>
<!-- /.box-body -->
<!-- /.box -->
<!-- /.container" -->
<!-- Modals -->
@endsection
