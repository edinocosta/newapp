@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Medições Feitas
  <small><b>Área: </b> {{$consumo->compartimento->nome}}  &nbsp;&nbsp; <b>Propriedade:</b><a href="/edit_prop/{{$auditoria->propriedade->id}}">{{$auditoria->propriedade->local}}</a> &nbsp; &nbsp;  <b>Propretário : </b> <a href="/cliente/detalhes/{{$auditoria->propriedade->cliente->id}}"> {{$auditoria->propriedade->cliente->nome}}</a></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
      <li ><a href="/auditorias">Auditorias</a></li>
      <li ><a href="/audit_res/{{$auditoria->id}}"><i >Detalhes</i></a></li> 
      <li class="active"><a href=""><i >Consumo_{{$consumo->id}}</i></a></li>
     </ol>
</section>
<br>
<div class="containerLocal">
  
<div class="box box-warning" ng-controller="consumoController">

  <div  class="conteudo"  style="margin:40px;padding-bottom: 12px; overflow-x: auto; ">

    @php 
      $conter =$consumo->medicao()->count()
    @endphp
    @can('create', App\Auditoria::class)
    <div>
      Click <a class="md-mini md-primary"  data-toggle="collapse" data-target="#multiCollapseExample1" role="button" aria-expanded="false"  aria-controls="multiCollapseExample1" md-ripple-size="auto"><b>aqui</b> </a>para medir novos equipamentos
    </div>
    <br><br>
    <div class="collapse multi-collapse"id="multiCollapseExample1">
      <div class="card card-body">
        <div class="ext-content"  style="overflow: auto" >
          <form method="post" action="/addMedicao">
            @csrf
            
            <div class="form-group">
                <label>Equipamentos</label>
                <select required class="form-control select2" name="equipamentos[]" multiple="multiple" data-placeholder="Selecionar Equipamentos"
                        style="width: 100%;"> <option value="@{{medidor.id}}" ng-repeat=" medidor in {{$allEq=App\Equipamento::all()}} ">@{{medidor.nome}}</option>
                </select>
                 @if(sizeof($allEq)==0)
                 <p class="text-warning pull-right">
                  <b> *Nenhum equipamento encontrado.</b>
                </p>
                <br>
                 <p>
                 <a href="/c_eq_ld">Adicionar</a>
                </p>
                @endif
               
              </div>
             

            <div class="form-group" >
              <label>Selecionar o Medidor</label>
              <div class="input-group" ng-cloak>
                <div class="input-group-addon"  >
                  <i class="fa fa-gear"></i>
                </div>
                <select required ng-model="client" name="medidor" class="form-control select2" style="width: 100%;" >
                  @foreach ($allEm=App\Medidor::all() as $element)
                    <option value="{{$element->id}}">{{$element->descricao}}</option>
                  @endforeach
                  
                </select>
                
              </div>
                @if(sizeof($allEm)==0)
                 <p class="text-warning pull-right" style="po"><b> *Medidores não encontrados.</b></p>
                @endif
            </div>
            <br>
            <md-button type="submit"   class="md-raised md-primary mx-auto pull-right" >Guardar</md-button>
            <input hidden type="number" name="consumo" value="{{$consumo->id}}" placeholder="">
          </form>
          
        </div>
      </div>
      
    </div>
    @endcan
    <!-- Registos -->
    @if($conter!=0)
    <table class="table table-hover pointable">
      <caption style="margin-left: 6px">Medições feitas no compartimento <b class="text-yellow">{{$consumo->compartimento->nome}}</b></caption>
      <thead>
        <tr >
          <th>Designação</th>
          <th>Equipamentos</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($consumo->medicao()->with(["equipamento"=>function($e){
        $e->select("id","nome");
        }])->get() as $medicao)
        <tr onclick="window.location.href ='/medicao/{{$auditoria->id}}/{{$medicao->id}}'"> 
        <?php $cont=1 ?>
          <td>{{$medicao->medidor->descricao}}</td>
          <td>
            
            @foreach ($eq= $medicao->equipamento as $equip)
            {{$equip->nome}}
            @if($cont < sizeof($eq))
            ,
            @endif
            <p hidden> {{$cont=$cont+1}}</p>
            @endforeach
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
    <!-- Gráficos -->
  
   @php  
      if ($conter!=0 ){
      if (($consumo->medicao()->get()->first()->medida()->count()) != 0) {
         $data=$consumo->medicao()->orderBy('updated_at','asc')->get()->last()->medida()->get()->last();
         $can=$data->get()->contains("data_fim",App\DateTimes::todayLarFormat());//Já Fli Inserido Hoje
        }else{
        $data=[];
        $can=false;
      }
        
        
      }
      else{
        $data=[];
        $can=false;
      }
      
       
      @endphp 
    @if($conter!=0 )
    @can('create', App\Auditoria::class)
    <div style="margin-top: 12px">
        Clique   <a    class="md-mini md-primary" data-toggle="collapse"data-target="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"  md-ripple-size="auto"> <b>aqui</b> </a>para
    @if($can)<b>atualizar</b> dados previamentes salvados hoje
    @else
    <b>registar</b> nova medida
    @endif
       
    </div>    
    <br>

    @endcan
    @endif
        
     <div class="collapse multi-collapse" id="multiCollapseExample2">
      

@if(!$can)
     @if(!isset($data->data_fim))
       <div class="row">
                    <div class="col-sm-6">
                      <label>Data Inicio</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input data-date-format="dd/mm/yyyy" required    data-date-type="text" class="form-control pull-right  datepicker" id="dini">
                      </div>
                      <label>Hora Inicio</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input id="hini"   required  type="text" class="form-control timepicker" >
                        
                      </div>
                    </div>
               <div class="col-sm-6">
                      <label>Data Fim</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="dfim" value="{{App\DateTimes::date(App\DateTimes::now(),0)}}"  disabled required   class="form-control pull-right" id="datepicker">
                      </div>
                      <label>Hora Fim</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input id="hfim" type="text" value="{{App\DateTimes::time(App\DateTimes::now())}}"  disabled required  class="form-control">
                        
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Contador Inicio</label>
                     
                      <input id="cini" required  type="number" min="0" class="form-control" >
                    </div>
                    <div class="col-sm-6">
                      <label>Contador Fim</label>
                      <input id="cfim" required type="number" min="0" class="form-control" >
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label >Tempo Ligado</label>
                       <input id="tligado" required type="text" class="form-control">
                    </div>
                    <div class="col-sm-6">
                      <label  >Dias Ligado</label>
                      <input id="dligado" required min="0"  type="number" class="form-control form-control-sm">
                    </div>
                    
                  </div>

           @else
                    <div class="row">
                      <div class="col-sm-6">
                      <label>Data Inicio</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="dini"  required  disabled value="{{App\DateTimes::date($data->data_fim,0)}}"   type="text" class="form-control pull-right" id="datepicker">
                      </div>
                      <label>Hora Inicio</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input id="hini" disabled  required value="{{$data->hora_fim}}"  type="text" class="form-control timepicker">
                        
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Data Fim</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="dfim" value="{{App\DateTimes::date(App\DateTimes::now(),0)}}"  disabled required   class="form-control pull-right" id="datepicker">
                      </div>
                      <label>Hora Fim</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input id="hfim" type="text" value="{{App\DateTimes::time(App\DateTimes::now())}}"  disabled required  class="form-control timepicker">
                        
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Contador Inicio</label>
                      <input id="cini" required value="{{$data->contador_fim}}"  disabled type="number" min="0" class="form-control" >
                    </div>
                    <div class="col-sm-6">
                      <label>Contador Fim</label>
                      <input id="cfim" required type="number" min="{{$data->contador_fim}}" class="form-control" >
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label >Tempo Ligado</label>
                       <input id="tligado" disabled value="{{App\DateTimes::time(App\DateTimes::now())}}" required type="text" class="form-control">
                    </div>
                    <div class="col-sm-6">
                      <label  >Dias Ligado</label>
                      <input id="dligado" disabled value="{{App\DateTimes:: diffDate($data->data_fim)->days}}" required min="0"  type="text" class="form-control form-control-sm">
                    </div>
                    
                  </div>

                
       @endif
       
                 
      @foreach ( $consumo->medicao()->with(["equipamento"=>function($e){
        $e->select("id","nome");
        }])->get() as $medicao)
         <br>
     <div class="ext-content"  style="overflow: auto" >

          <form class="form_consumo" method="post" action="/addMedida">
            

            <input hidden type="number" name="idAudit" value="{{$auditoria->id}}">

            @csrf
                    
            <div>
              <?php $cont=1 ?>

            <b>Medidor : </b>{{$medicao->medidor->descricao}}&nbsp;<b>Equipamentos : </b>           
            @foreach ($eq= $medicao->equipamento as $equip)
            {{$equip->nome}}
            @if($cont < sizeof($eq))
            ,
            @endif
            <p ng-hide="true"> {{$cont=$cont+1}}</p>
            @endforeach
          
            </div>

            <div class="modal-body">
                <div class="form-group">
                 
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="nome">Energia</label>
                      <input name="energia" required step="any"  min="0" type="number" class='form-control form-control-sm' >
                    </div>
                    
                  </div><br>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <label >Potencia Máxima</label>
                      <input name="pmax" required  step="any" type="number" class='form-control form-control-sm' >
                    </div>
                    <div class="col-sm-6">
                      <label  >Potencia Mínima</label>
                      <input name="pmin" required min="0" step="any"  type="number" class="form-control form-control-sm">
                    </div>
                    
                  </div>
                  
                  <input type="number" hidden name="id_medicao" value="{{$medicao->id}}" placeholder="">
                </div>
               
               
              </form>
              
            </div>
           @endforeach

       @else
        <div >
                      <label>Contador Fim</label>
                      <input type="number" placeholder="{{$auditoria->c_fim}}" ng-model="fs" class="form-control" >
       </div>
       <br>    
       @foreach ($consumo->medicao()->with(["equipamento"=>function($e){
        $e->select("id","nome");
        },"medida"])->get() as $medicao)

        @if(sizeof($medicao->medida()->get())!=0)

      <div class="card card-body">
        <div class="ext-content"  style="overflow: auto" >
          <form class="form_consumo" method="post" action="/editMedida">

            @csrf

              <?php $cont=1 ?>
            <b>Medidor : </b>{{$medicao->medidor->descricao}}&nbsp;<b>Equipamentos : </b>           
            @foreach ($eq= $medicao->equipamento as $equip)
            {{$equip->nome}}
            @if($cont < sizeof($eq))
            ,
            @endif
            <p ng-hide="true"> {{$cont=$cont+1}}</p>
            @endforeach


                <div class="form-group">
                 
                 
                  <input hidden type="number" name="idAudit" value="{{$auditoria->id}}">

                  <input hidden type="number" name="cfim" ng-model="fs">

                  <div class="row">
                    <div class="col-sm-12">
                      <label for="nome">Energia</label>
                      <input name="energia" required step="any"  value="{{$medicao->medida->energia}}"  min="0" type="number" class='form-control form-control-sm' >
                    </div>
                    
                  </div><br>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <label >Potencia Máxima</label>
                      <input name="pmax" required value="{{$medicao->medida->pot_max}}" step="any" type="number" class='form-control form-control-sm' >
                    </div>
                    <div class="col-sm-6">
                      <label  >Potencia Mínima</label>
                      <input name="pmin" required min="0" step="any" value="{{$medicao->medida->pot_min}}"  type="number" class="form-control form-control-sm">
                    </div>
                    
                  </div>
                  
                  <input  hidden name="id" value="{{$medicao->medida->id}}" placeholder="">
                </div>
               
                
              </form>
              
            </div>
          </div>
          @endif 
           @endforeach
       

      
  @endif 
     
          <md-button id="submitMedidas" onclick="submitForms({{$auditoria->id}},{{$consumo->id}},@if($can) false @else true @endif,{{$auditoria->c_inicio}})" class="md-raised md-primary mx-auto pull-right" >@if($can)Alterar
    @else
    Guardar
    @endif</md-button>     


                </div>    

        </div>
    
    
  </div>
</div>
@endsection

@push('scripts')
      <script>
//Garantindo datas maipres que o Inicio da Auditoria
        $('#datepicker').datepicker({
autoclose: true,
endDate:new Date(),
startDate:new Date('{!! $auditoria->data_inicio !!}')
});

$('.datepicker').datepicker({
autoclose: true,
endDate:new Date(),
startDate:new Date('{!! $auditoria->data_inicio !!}')
});

      </script>

    @endpush