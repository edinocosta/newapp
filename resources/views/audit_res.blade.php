@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<?php
 $status_str=null;
$estado = $auditoria->estado()->select("id","descricao","obs","created_at")->orderBy("created_at","asc")->get()->last();
?>
<section class="content-header">



  {{$auditoria->descricao}} &nbsp;&nbsp;
  @switch($estado->id)
 
                @case(1)
                <?php $status="label-primary";$status_str='audit_anda';?>
                @break
                @case(2)
                <?php $status="label-warning";$status_str='audit_resumo';?>
                @break
                @case(3)
                <?php $status="label-danger";$status_str='audit_canc';?>
                @break
                @case(4)
                <?php $status="label-success";$status_str='audit_conc';?>
                @break
                @endswitch
  <span class="label  {{$status}}">{{__('geral.'.$status_str)}}</span>

  <h1>
  <small><b>Propriedade:</b><a href="/edit_prop/{{$auditoria->propriedade->id}}">{{$auditoria->propriedade->local}}</a> &nbsp; &nbsp;  <b>Propretário : </b> <a href="/cliente/detalhes/{{$auditoria->propriedade->cliente->id}}" title=""> {{$auditoria->propriedade->cliente->nome}}</a></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a href="/auditorias">Auditorias</a></li>
    <li class="active"><a href=""><i >Detalhes</i></a></li>
  </ol>
</section><br>
<div class="row containerLocal" ng-controller="auditController">
  <div>
    <div class="box box-warning">
      <div class="nav-tabs-custom" style="min-height:360px; overflow: auto">
        <ul class="nav nav-tabs pull-right">
          @if(App\User::isAdmin(Auth::user()))
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              OPÇÔES <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li role="presentation" onclick="if(confirm('Voce quer realmente apagar esta auditoria')){
                window.location.href='/auditoria/apagar/{{$auditoria->id}}';
                }"><a role="menuitem" tabindex="-1" href="#">APAGAR</a></li>
               
                <li role="presentation"><a role="menuitem" tabindex="-1" onclick=" window.location.href='/audit/edit/{{$auditoria->id}}'">EDITAR</a></li>

              </ul>
            </li>
           @endif
            <li ><a href="" data-target="#tab_3-2" data-toggle="tab">HISTÓRICO</a></li>
            @can('create', App\Auditoria::class)
            <li><a href="" data-target="#tab_2-2" data-toggle="tab">AVANÇADOS</a></li>
            @endcan
            <li  class="active"><a href="" data-target="#tab_1-1" data-toggle="tab">INFORMAÇÔES</a></li>
            <li class="pull-left header"><i class="fa fa-th"></i>Auditoria</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1-1">
              <div  class="conteudo" style="margin:15px">
                @if(App\DateTimes::smallerThan($auditoria->data_fim))
                <span  class="text-danger">Essa auditoria já ultrapassou a data estipulada : <b>{{App\DateTimes::differTimeA($auditoria->data_fim)}} de atraso</b> </span>
                @else
                <p><b>Previsão de Término&nbsp;:&nbsp;</b> {{App\DateTimes::differTimeA($auditoria->data_fim)}} </p>
                @endif
                
                @if($auditoria->consumo()->count()!=0)
                <table class="table table-bordered table-striped table-hover">
                  <caption class="text-warning">Click nos intens abaixo para mais detalhes</caption>
                  <thead>
                    <tr>
                      <th>Compartimento</th>
                      <th>Piso</th>
                      <th>Opções</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($auditoria->consumo()->with(["compartimento"=>function($c){
                    $c->select("id","nome","piso");}])->get() as $regis)
                  <tr>
                    <td>{{$regis->compartimento->nome}}</td>
                    <td>{{$regis->compartimento->piso}}</td>
                    <td>
                      <div class="pull-right">
                        <a href =''><span class="  white_icon "><i class="fa fa-edit"></i></span></a>
                        <a href ='/consumos/{{$auditoria->id}}/{{$regis->id}}'><span class=" white_icon  "><i class="fa  fa-eye"></i></span></a>
                        <a href =''><span class="  white_icon "><i class="fa  fa-trash-o"></i></span></a></div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <p class="text-info pull-right"><b>Total</b> : {{$auditoria->consumo()->count()}}</p>
                
                @else
                <span  class="text-danger">Nenhum compartimento auditado ainda!!</span>
                @endif
                @can('create', App\Auditoria::class)
                @if($estado->id !=2 && $estado->id !=3)<p> Clique<a  href="" class="md-mini md-primary" data-toggle="modal" data-target="#addconsumo" md-ripple-size="auto">
                <b>aqui</b> </a> para auditar novo compartimento</p>
                @endif
                @endcan
              </div>
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2-2">
              
              <p>Configurações da Corrente Auditoria</p>
              <hr>
              
              <br>
              @if($auditoria->c_fim!=0)
              <p style="font-size:1em; width: 100%; text-align: center;margin-top: 10%">
                <span  class="text-success" style="margin-left: 6px"> <b>Esta auditoria já está em condições para ser concluida</b></span>
              </p>
              @else
              <p style="font-size:1em; width: 100%; text-align: center;margin-top: 10%">
                <span  class="text-danger" style="margin-left: 6px">Esta auditoria não pode ser concluida!!</span>
              </p>
              
              @endif
              @can('create', App\Auditoria::class)
              <div layout="row" layout-align="end start" style="margin-top: 15%" flex>
                @if($estado->id==1)
                <md-button id="susp"  data-toggle="modal" data-target="#suspender"  class="bg-blue"><b>Suspender</b></md-button>
                <md-button id="canc" data-toggle="modal" data-target="#cancelar" class="bg-yellow"><b>Cancelar</b></md-button>
                
                <md-button id="conc" class="bg-green" data-toggle="modal" data-target="#concluir"><b>Concluir</b></md-button>
                @endif
                @if($estado->id==4 | $estado->id==3 | $estado->id==2)
                <md-button id="reyomar" data-toggle="modal" data-target="#retomar" class="bg-blue"><b>Retomar</b></md-button>
                @endif
              </div>@endcan
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3-2">
              <!-- Info de Auditoria -->
              <table id="example1" class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Estado</th>
                    <th>Data</th>
                    <th>Observação</th>
                  </tr>
                </thead>
                <?php $status="";?>
                <tbody>
                  @foreach ($auditoria->estado()->select("id","descricao","obs","created_at")->orderBy("created_at","asc")->get() as $audit)
                  <tr>
                    @switch($audit->id)
                    @case(1)
                    <?php $status="label-primary";?>
                    @break
                    @case(2)
                    <?php $status="label-warning";?>
                    @break
                    @case(3)
                    <?php $status="label-danger";?>
                    @break
                    @case(4)
                    <?php $status="label-success";?>
                    @break
                    @endswitch
                    <td><span class="label  {{$status}}">{{$audit->descricao}}</span></td>
                    <td >{{App\DateTimes::date($audit->created_at,3)}}</td>
                    <td >{{$audit->obs}}</td>
                  </tr>
                  @endforeach
                </tbody>
                
              </table>
              
            </div>
            <!-- /.tab-content -->
            <b style="color: orange">Total Contador:&nbsp;</b>{{($auditoria->c_fim)-($auditoria->c_inicio)}}&nbsp;kWh
          </div>
        </div>
        
      </div>
      
      <div class="modal fade" id="addconsumo" tabindex="-1" role="dialog" ng-controller="auditRegController"  aria-hidden="true">
        <form method="post"  action="/addConsumo">
          @csrf
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Escolha O Compartimento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="ext-content">
                  
                  
                  <div class="form-group">
                    
                    @if($auditoria->propriedade->compartimento->count()!=0)
                    <label>Compartimento</label>
                    <select ng-model="compart" required name="comp_id" class="form-control pull-right" >
                      <option value="@{{props.id}}" ng-repeat="props in {{$auditoria->propriedade->compartimento}}">@{{props.nome}}</option>
                    </select>
                    <p class="text-success pull-right">Essa propriedade pussio <b>{{$auditoria->propriedade->compartimento->count()}} compartimentos</b> </p>
                    @else
                    <br>
                    <p class="text-warning"><b> *Nenhum compartimento encontrado. Não pode continuar!</b></p>
                    <p><b>&nbsp; Para adicionar uma, vá até ao <b>Propriedade:</b> click sobre o link, e personalize.</b> </p>
                    @endif
                  </div>
                  <input type="number" name="audit_id" hidden value="{{$auditoria->id}}" placeholder="">
                  
                </div>
                <br>
                
              </div>
              
              <div class="modal-footer" >
                <div class="pull-left">
                  <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
                  <md-button ng-disabled="!compart" type="submit" class="md-raised md-primary " >Guardar</md-button>
                </div>
                
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal fade"  id="concluir" tabindex="-1" role="dialog" ng-controller="auditRegController"  aria-hidden="true">
        <form method="post"  action="/concluir">
          <div class="modal-dialog box box-success" role="document">
            <div class="modal-content">
              
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Concluindo a Auditoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="ext-content">
                  
                  @csrf
                  <div class="form-group">
                    <label>Observação</label>
                    <input type="textarea" name="obs" class="form-control pull-right" >
                  </div>
                  <input type="number" name="audit_id" hidden value="{{$auditoria->id}}" placeholder="" />
                  
                </div>
                <br>
                
              </div>
            </div>
            <div class="modal-footer">
              <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
              <md-button type="submit" class="md-raised bg-green" >Guardar</md-button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal fade" id="retomar" ng-controller="auditRegController"  >
        <form method="post"  action="/retomar">
          <div class="modal-dialog box box-info"  role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Retomadon a Auditoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="ext-content">
                  
                  @csrf
                  <div class="form-group">
                    <label>Porquê Retomar?</label>
                    <input type="text" required name="obs" class="form-control pull-right" >
                  </div>
                  <input type="number" name="audit_id" hidden value="{{$auditoria->id}}" placeholder="" />
                  <input type="number" name="action" hidden value="1" placeholder="" />
                </div>
                <br>
              </div>
            </div>
            <div class="modal-footer">
              <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
              <md-button type="submit" class="md-raised bg-blue" >Alterar</md-button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal fade" id="cancelar" ng-controller="auditRegController"  >
        <form method="post"  action="/retomar">
          <div class="modal-dialog box box-warning"  role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancelando Auditoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="ext-content">
                  
                  @csrf
                  <div class="form-group">
                    <label>Porquê Cancelar?</label>
                    <input type="text" required name="obs" class="form-control pull-right" >
                  </div>
                  <input type="number" name="audit_id" hidden value="{{$auditoria->id}}" placeholder="" />
                  <input type="number" name="action" hidden value="3" placeholder="" />
                  
                </div>
                <br>
              </div>
            </div>
            <div class="modal-footer">
              <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
              <md-button type="submit" class="md-raised bg-yellow" >Alterar</md-button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal fade" id="suspender" tabindex="-1" role="dialog" ng-controller="auditRegController"  aria-hidden="true">
        <form method="post"  action="/retomar">
          <div class="modal-dialog box box-info"  role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sespendendo a Auditoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="ext-content">
                  
                  @csrf
                  <div class="form-group">
                    <label>Porquê Suspender?</label>
                    <input type="text" required name="obs" class="form-control pull-right" >
                  </div>
                  <input type="number" name="audit_id" hidden value="{{$auditoria->id}}" placeholder="" />
                  <input type="number" name="action" hidden value="2" placeholder="" />
                </div>
                <br>
              </div>
            </div>
            <div class="modal-footer">
              <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Cancelar</md-button>
              <md-button type="submit" class="md-raised bg-blue" >Alterar</md-button>
            </div>
          </div>
        </form>
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          <!-- Donut chart -->
          <div class="box box-primary" style="min-height: 428px">
            <div class="box-header with-border">
              <i class="fa fa-area-chart"></i>
              <h3 class="box-title"> Dados do Analizador</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              @if($auditoria->file_exel_path)
              
              <div class="form-row">
                <div class="col-sm-12 mb-3 row">
                  <div class=" col-sm-3">
                    <select  ng-disabled="!can"  ng-cloak ng-change="loadDatas1(file,dat)" ng-model="dat" class="form-control select2" style="width: 100%;" >
                      <option  ng-value="$index" ng-repeat="opt in options">@{{ opt }}</option>
                    </select>
                    
                  </div>
                  
                  <div  class=" col-sm-9 row">
                    {{--<md-datepicker  md-max-date="mdate"  md-min-date="midate" ng-model="date" style="width:100%"></md-datepicker>--}}
                    <div class="col-sm-10" >
                      <input ng-show="can" type="text" class="form-control" id="reservationtime">
                    </div>
                    <div class="col-sm-2" >
                      <button ng-cloak class="btn btn-primary"  ng-show="can" ng-click="loadDatas1(file,-1)">PLOTAR</button>
                    </div>
                    
                    
                  </div>
                  
                  
                  <div class="pull-right">
                    
                    <button type="button"  ng-show="!can"  class="btn btn-success md-raised pull-right" ng-click="getFile({{$auditoria->id}})"><i class="fa fa-file-text"></i>&nbsp;<i>ABRIR</i></button>
                  </div>
                  
                </div>
                <br>
                <br>
                
                
                
              </div>
              <div id="container1" style="height: 290px;"></div>
              <div ng-show="det" class="row">
                <div class="col-sm-4">
                  <center class="deText"><b>Média </b><span>@{{med}}</span></center>
                </div>
                <div class="col-sm-4">
                  <center  class="deText"><b>Máximo </b> <span>@{{max}}</span></center>
                </div>
                <div class="col-sm-4">
                  <center class="deText"><b>Mínimo </b><span>@{{min}}</span></center>
                </div>
              </div>
              <div >
                <div class="pull-right" style="margin-top: 2%; margin-right:10px">
                  <md-checkbox ng-show="done" ng-model="det" class="md-primary">
                  <b>Mostrar Detalhes</b>
                  </md-checkbox>
                  @can("create",App\Auditoria::class)
                  <md-checkbox onchange="resetForm()"  ng-model="advan" class="md-primary">
                  <b>Avançados</b>
                  </md-checkbox>
                  @endcan
                </div>
              </div>
              <div ng-show="advan" class="mbox" style="margin-top: 6%">
              <div class="box-header with-border bxheader">
                <h3 class="box-title bxtitle">*Upload de Ficheiro(*.csv)</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              
              <div id class="box-body" ng-controller="uploadfile">
                <b class="text-info">Se achares que esse nao é o ficheiro corespondente á esta auditoria, faça de novo o upload de um novo ficheiro</b> <br>
                <form   ng-show="advan" action="/saveFile" method="post" enctype="multipart/form-data" id="mf">
                  {{ csrf_field() }}
                  <input  type="file" class="form-control form-control-file" placeholder="Escolher Um Ficheiro.csv" required accept=".csv" name="image" id="mfile"><br><br>
                  <input hidden value="{{$auditoria->id}}" type="number" id="mid" name="id">
                  <button  class="btn btn-primary" type="submit"><i  style=" margin-right: 2px" class="fa  fa-save"></i>Guardar</button>
                </form>
                <div class="m_progressbar">
                  <span  class="percent pull-right" >0%</span>
                  <div class="progress active">
                    <div class="progress-bar progress-bar-success" id="mb" role="progressbar">
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
              </div>
              
            </div>
         

          @else
          <b class="text-danger">Dados Insuficiente para ver resultado do Analizador. Ficheiro necessário</b>
          @can("create",App\Auditoria::class)
          <br><br>
          <div ng-controller="uploadfile">
            <form    action="/saveFile" method="post" enctype="multipart/form-data" id="mf">
              {{ csrf_field() }}
              <input  type="file" class="form-control" placeholder="Escolher Um Ficheiro.csv" required accept=".csv" name="image" id="mfile"><br><br>
              <input hidden id="mid" value="{{$auditoria->id}}" type="number" name="id">
              <button  class="btn btn-primary" type="submit"><i  style=" margin-right: 2px" class="fa  fa-save"></i>Guardar</button>
            </form>
            <div class="m_progressbar">
              <span  class="percent pull-right" >0%</span>
              <div class="progress active">
                <div class="progress-bar progress-bar-success" id="mb" role="progressbar">
                  
                </div>
              </div>
            </div>
          
         </div>
          @endcan
          @endif
          </div>
        </div>
        <!-- /.box-body-->
      </div>

    <div class="col-sm-6">
      <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
          <li class="active" ><a href="#revenue-chart" data-toggle="tab">Equipamentos</a></li>
          <li ><a href="#sales-chart" data-toggle="tab">Faturas</a></li>
          <li class="pull-left header"><i class="fa fa-inbox"></i>Consumo de Energia</li>
        </ul>
        <div class="tab-content no-padding">
          <!-- Morris chart - Sales -->
          
          <div class="chart tab-pane active" id="revenue-chart" >
            <div class="box-body chart-responsive">
              <!-- Gráficos -->
              @if($auditoria->c_fim!=0)
              <?php
              $totalContador = ($auditoria->c_fim)-($auditoria->c_inicio);
              
              $dados = $auditoria->consumo()->with(['medicao'=>function($s){
              
              $s->with(['equipamento']);
              
              }])->get()->map(function ($item, $key) {
              $dados = new \stdClass();
              $dados->energia  = $item->medicao->media_energia;
              return $item->medicao()->with(['equipamento'])->get()->map(function ($item, $key) {
              $dados = new \stdClass();
              $dados->equipamento = implode(",",iterator_to_array($item->equipamento()->get()->map(function ($item, $key) {
              
              return $item->nome;
              })));
              $d = $item->medida()->get()->avg('energia');
              if ($d) {
              $dados->energia = $item->medida()->get()->avg('energia');
              }else{
              $dados->energia = 0;
              }
              
              return $dados;
              });
              
              });
              
              ?>
              @else
              <span  class="text-danger" style="margin-left: 6px">Detalhes de distribuição de consumo ainda não disponivel</span>
              @endif
              <div id="donut-chart" style="height: 300px;"></div>
              
            </div>
            
          </div>
          <div class="chart tab-pane " id="sales-chart">
            <div class="box-body chart-responsive">
              @if($auditoria->fatura()->count()==0)
              <span id="fat_men" class="text-danger" style="margin-left: 6px">Detalhes de consumo por faturas Indisponivel!! </span>
              <br>
              @endif
              <div id="container3" style="height: 300px"></div>
              <center>
              <div class="row" >
                <div class="col-sm-4">
                  <p id="max"></p>
                </div>
                <div class="col-sm-4">
                  <p id="min"></p>
                </div>
                <div class="col-sm-4">
                  <p id="avg"></p>
                </div>
              </div>
              </center>
              <a class="md-mini md-primary"  data-toggle="collapse" data-target="#multiCollapseExample1" role="button" aria-expanded="false"  aria-controls="multiCollapseExample1" md-ripple-size="auto"><b>Adicionar/Alterar</b> </a>
            </div>
            <div>
            </div>
            
            <div class="collapse multi-collapse"id="multiCollapseExample1" style="margin: 10px;" >
              <form action="/addFatura" method="post" id="fatura_forms" >
                <label>Data</label>
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input data-date-format="dd/mm/yyyy" required    data-date-type="text" class="form-control pull-right  datepicker" name="data">
                </div>
                <label>Consumo</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-bolt"></i>
                  </div>
                  <input class="form-control form-control-sm" required type="number" step="any" min="0" name="consumo">
                  <input hidden type="number" value="{{$auditoria->id}}" name="id">
                </div>
                <small class="text-success pull-right">Para remover, selecione a <b>data</b> e deixe o campo <b>consumo</b> com valor zero(0)</small>
                <br>
                
                <div class="pull-right">
                  <md-button type="submit" class="md-mini md-primary" md-ripple-size="auto"><b>SALVAR</b></md-button>
                </div>
              </form>
              
            </div>
            
          </div>
          
        </div>
        
      </div>
      <!-- /.box-body-->
    </div>
  </div>
  
</div>
</div>
<!-- /.container" -->
@endsection
@push('scripts')
<script>


function update (){

$.getJSON(
'/getFaturas/{{$auditoria->id}}',
function (data) {

Highcharts.chart('container3', {
chart: {
type: 'column',
options3d: {
enabled: true,
alpha: 10,
beta: 25,
depth: 70
}
},
title: {
text: 'Consumo de Energia'
},
subtitle: {
text: 'informações a partir das faturas do consumo da energia'
},
plotOptions: {
column: {
depth: 25
}
},
xAxis: {
type: 'category',
labels: {
skew3d: true,
style: {
fontSize: '16px'
}
}
},
yAxis: {
title: {
text: null
}
},
series: [{
name: 'Energia',
data:data.dados
}]
});
if (data.dados.length!=0) {
$('#max').html('Máximo:'+data.max);
$('#min').html('Mínimo:'+data.min);
$('#avg').html('Média :'+data.avg.toFixed(2));
$('#fat_men').hide();
}
}
);
}
update ();
@if($auditoria->c_fim!=0)
var sm = 0;
$dados = @json($dados);
$contador = {{$totalContador}};
var dats =[];
for (var i in $dados) {


for (var j in $dados[i]) {


dats.push({name:$dados[i][j].equipamento,y:parseFloat($dados[i][j].energia)});
sm+=parseFloat($dados[i][j].energia);
}

}
dats.push({name:"Outros(lampada,carregador...)",y:$contador-sm});
Highcharts.chart(document.getElementById("donut-chart"), {
chart: {
plotBackgroundColor: null,
plotBorderWidth: null,
plotShadow: false,
type: 'pie'
},
title: {
text: 'Distribuição do Consumo por Equipamentos'
},
tooltip: {
pointFormat: '{series.name}: <b>{point.y:.3f} kWh</b>'
},
plotOptions: {
pie: {
allowPointSelect: true,
cursor: 'pointer',
dataLabels: {
enabled: true,
format: '<b>{point.name}</b>: {point.percentage:.1f} %',
style: {
color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
}
}
}
},
series: [{
name: 'Consumo',
colorByPoint: true,
data: dats,

}]
});

@endif

$('#fatura_forms').ajaxForm({
forceSync:true,
success: function(data, statusText, xhr) {
update();
},
error: function(xhr, statusText, err) {
//alert("Erro");
alert("Erro: Contacte o Administrador de Sistema");
//$('#status').html(err || statusText);
}
});

</script>
@endpush