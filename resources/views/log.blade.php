@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Log
  <small>Iformações do Sistema</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a ><i >Log</i></a></li>
  </ol>
</section>
<div  class="row containerLocal">
  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right">
      <li class="active" ><a href="#revenue-chart" data-toggle="tab">Gráfico Login</a></li>
      <li ><a href="#sales-chart" data-toggle="tab">Log Info</a></li>
      <li class="pull-left header"><i class="fa fa-inbox"></i>System Log Info</li>
    </ul>
    <div class="tab-content no-padding">
      <!-- Morris chart - Sales -->
      
      <div class="chart tab-pane active" id="revenue-chart" >
        <div class="box-body chart-responsive">
          <div class="chart" id="line-chart"  style="position: relative; height: 300px;"></div>
        </div>
        
      </div>

        <div class="chart tab-pane " id="sales-chart">
        <div class="box-body chart-responsive">
          
          <div class="box-body table-responsive pointable">
            <table id="example1" class="table  table-hover table-bordered table-striped">
              <thead>
                <tr>
                  <th>Data</th>
                  <th>Descricao</th>
                  <th>Tabela</th>
                  <th>Utilizador</th>
                </tr>
              </thead>
              <tbody>
                @foreach (App\Log::all() as $log)
                <tr>
                  <td>{{App\DateTimes::date($log->created_at,1)}}</td>
                  <td>{{$log->descricao}}</td>
                  <td>{{$log->tabela}}</td>
                  <td>{{$log->user->name}}</td>
                </tr>
                @endforeach
              </tbody>
              
            </table>
          </div>
        </div>
      </div>
    
    </div>
    <p style="margin: 10px;margin-bottom: 10px;">Sistema Inicilizado em: {{App\DateTimes::date(App\Log::first()->created_at,1)}}</p>
  </div>
  
  
</div>
<!-- /.container" -->
@endsection
<script  src={{asset("admin-lte/bower_components/jquery/dist/jquery.min.js")}}></script>
<script>
$(document).ready(function(){
$("select").val(""); 
$.getJSON(
'/getLogs',
function (data) {
var line = new Morris.Line({
element: 'line-chart',
resize: true,
data:data,
xkey: 'y',
parseTime:false,
ykeys: ['item1'],
labels: ['Login'],
lineColors: ['#3c8dbc'],
pointStrokeColors: ['#efefef'],
gridLineColor    : '#efefef',
gridTextFamily   : 'Open Sans',
hideHover: 'auto'
});
});
});
</script>