@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Medições Feitas
  <small> <b>Área: </b> {{$consumo->compartimento->nome}}  &nbsp;&nbsp; <b>Propriedade:</b><a href="/edit_prop/{{$auditoria->propriedade->id}}">{{$auditoria->propriedade->local}}</a> &nbsp; &nbsp;  <b>Propretário : </b> <a href="/cliente/detalhes/{{$auditoria->propriedade->cliente->id}}" title=""> {{$auditoria->propriedade->cliente->nome}}</a></small>
</h1>
  <ol class="breadcrumb">
      <li ><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
      <li ><a href="/auditorias">Auditorias</a></li>
      <li ><a href="/audit_res/{{$auditoria->id}}"><i >Detalhes</i></a></li> 
      <li ><a href="/consumos/{{$auditoria->id}}/{{$consumo->id}}"><i >Consumo_{{$consumo->id}}</i></a></li>
       <li ><a href=""><i >Medidas</i></a></li>
     </ol>
</section><br>
<br>
<div class="containerLocal">
  
<div class="box box-warning" ng-controller="consumoController">
  <div  class="conteudo"  style="margin:50px;padding-bottom: 12px;">
    <div class="box-body table-responsive">
      <table id="example1" class="table  table-hover table-bordered table-striped">
        
        <thead>
          <tr>
            <th>Data.Inicio</th>
            <th>Data.Fim</th>
            <th>Energia</th>
            <th>Pot.Máxima</th>
            <th>Pot.Mínima</th>
            <th>Cont.Inicio</th>
            <th>Cont.Fim</th>
            <th>Dia Ligado</th>
            <th>Tempo</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($medicao->medida()->get() as $m)
          <tr>
            <td>{{date("d/m/Y",strtotime($m->data_ini))}}</td>
            <td>{{date("d/m/Y",strtotime($m->data_fim))}}</td>
            <td>{{$m->energia}}</td>
            <td>{{$m->pot_max}}</td>
            <td>{{$m->pot_min}}</td>
            <td>{{$m->contador_ini}}</td>
            <td>{{$m->contador_fim}}</td>
            <td>{{$m->dia_ligado}}</td>
            <td>{{$m->tmp_ligado}}</td>
          </tr>
          @endforeach
        </tbody>
        
      </table>
      @if ($medicao->medida()->count()!=0)
         <md-select style="max-width:30%; min-width: 30%" ng-model="dat" ng-cloak ng-change="switch({{json_encode($medicao->medida()->get())}})"> 
          <md-select-label>Ver Por</md-select-label>
          <md-option ng-value="$index" ng-repeat="opt in options">@{{ opt }}</md-option>
        </md-select>
        @endif

          @if ($medicao->medida()->count()!=0)
           <div class="box box-primary" style="margin-top: 3%">
     <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 ng-cloak class="box-title">Distribuição do Comsumo(<b>@{{options[dat]}}</b>)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
      <div class="box-body">
        <div id="bar_char" style="height: 300px;"></div>
      </div>
      <!-- /.box-body-->
    </div>    
  @endif
    </div>

    
    <!-- Gráfico -->
 

        
    <!-- /Gráfico-->
 
      </div>

    
    </div>
</div>
    @endsection

      <script>
        
        $pode=true;

      </script>