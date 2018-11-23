@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Editar Auditoria
  <small><b>Propriedade:</b><a href="/edit_prop/{{$auditoria->propriedade->id}}">{{$auditoria->propriedade->local}}</a> &nbsp; &nbsp;  <b>Propretário : </b> <a href="/cliente/detalhes/{{$auditoria->propriedade->cliente->id}}"> {{$auditoria->propriedade->cliente->nome}}</a></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
      <li ><a href="/auditorias">Auditorias</a></li>
      <li ><a href="/audit_res/{{$auditoria->id}}"><i >Detalhes</i></a></li> 
      <li class="active"><a href=""><i >Editar</i></a></li>
     </ol>
</section>
<br>
<div class="containerLocal">
  <div class="box box-info" ng-controller="master">
    <div class="box-header">
      <h3 class="box-title">Novas Informações</h3>
    </div>
    <div class="box-body">
      <!-- Date and time range -->
      <form method="post" action="/audit/update">
        @csrf
        <div class="form-group">
        <label>Data de Inicio - Fim:</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
          <input type="text" name="date"  value="{{App\DateTimes::date($auditoria->d_inicio,0)}}" class="form-control pull-right" id="reservationtime">
        </div>
      </div>
      <div class="form-group">
        <label>Descricao</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-comment-o"></i>
          </div>
          <input type="text" value="{{$auditoria->descricao}}" name="descricao" class="form-control pull-right" id="desc">
          <input type="number" hidden name="id" value="{{$auditoria->id}}">
        </div>
      </div>

      <button type="submit"  class="btn btn-block btn-success btn-flat">Guardar</button>
      </form>
      
    </div>
    
    <!-- <md-button class="md-raised md-primary mx-auto" ng-cloak>Primary</md-button> -->
    <!-- /.input group -->
    
    <!-- /.box-body -->
    <!-- /.box -->
    <!-- /.container" -->
    <!-- Modals -->
    <div class="modal fade" id="deTalhes" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog  box-warning"  role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">@{{clientes[client].nome}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="ext-content">
              <div class="card card-body">
                <p><b>Telf</b><br>@{{clientes[client].telefone}}</p>
                <p><b>Email</b><br>@{{clientes[client].email}} <br></p>
                <p><b>Morada</b><br>@{{clientes[client].morada}}</p>
                <p><b>NIF</b><br>@{{clientes[client].nif}}</p>
                
              </div>
              
            </div>
          </div>
          <div class="modal-footer">
            <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">Voltar</md-button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="addProp" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog " role="document">
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
            <md-button type="button"  style="background-color: #494850;color: white" class="md-raised leftmd " data-dismiss="modal">Cancelar</md-button>
            @if(isset($cliente))
            <md-button type="button"  ng-click="addProp({{$cliente->id}},-1)" class="md-raised md-primary rightmd " >Guardar</md-button>
            @else
            <md-button type="button"  ng-click="addProp(clientes[client].id,client)" class="md-raised md-primary rightmd" >Guardar</md-button>
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
      <script>

      </script>

    @endpush