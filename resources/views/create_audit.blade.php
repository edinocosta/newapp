@extends('layouts.app')
@section('content')
<!-- .container" -->
<section class="content-header">
  <h1>
 @lang('c_auditoria.new_audit')
  <small>@lang('c_auditoria.camporeq')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li ><a href="/auditorias">Auditorias</a></li>
    <li class="active"><a href=""><i >@lang('c_auditoria.create')</i></a></li>
  </ol>
</section>
<br>
<div class="containerLocal">
  <div class="box box-info" ng-controller="master">
    <div class="box-header">
      <h3 class="box-title">@lang('c_auditoria.info')</h3>
    </div>
    <div class="box-body">
      <!-- Date and time range -->
      <div class="form-group">
        <label>@lang('c_auditoria.data')</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
          <input type="text" class="form-control pull-right" id="reservationtime">
        </div>
      </div>
      <div class="form-group">
        <label>@lang('c_auditoria.desc')</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-comment-o"></i>
          </div>
          <input type="text"  class="form-control pull-right" id="desc" placeholder="@lang('c_auditoria.desc_h')">
        </div>
      </div>
      
      <div class="form-group" >
        @if (isset($cliente))
        
        <label>@lang('c_auditoria.propr')</label>
        @else
        <label>@lang('c_auditoria.select_propt')</label>
        @endif
        <div class="input-group" ng-cloak>
          <div class="input-group-addon"  >
            <i class="fa fa-user"></i>
          </div>
          @if (isset($cliente))
          
          <input  type="text"  ng-disabled="true" class="form-control" value="{{$cliente->nome}}">
          @else
          <select ng-model="client" class="form-control select2" style="width: 100%;" >
            <option value="@{{$index}}" ng-repeat="cliente in clientes"><b>@{{cliente.nome}}</b>&nbsp;/&nbsp; @{{cliente.morada}}</option>
          </select>
          @endif
        </div>
        
        <a href="#" ng-show="client"  data-toggle="modal" data-target="#deTalhes" ng-cloak  >@lang('c_auditoria.detail')</a><br/>
        <span ng-show="clientes.length==0"  ng-cloak class="text-danger">@lang('c_auditoria.nocliente')</span>
      </div>
      <div class="form-group">
        
        <label>@lang('c_auditoria.select_prop')</label>
        <div id="propSelector" class="input-group" ng-cloak>
          <div class="input-group-addon">
            <i class="fa fa-map-marker"></i>
          </div>
          <select ng-model="props"  class="form-control select2" style="width: 100%;" >
            @if (isset($cliente))
            <option  value="@{{prop.id}}" ng-repeat="prop in {{$cliente->propriedade()->get()}}">@{{prop.local}}</option>
            @else
            
            <option  value="@{{prop.id}}" ng-repeat="prop in clientes[client].propriedade">@{{prop.local}}</option>
            @endif
          </select>
        </div>
        <span id="help-block">@lang('c_auditoria.propdone')!</span>
        @if (isset($cliente))
        <a data-toggle="modal" data-target="#addProp" ng-cloak href="#" >@lang('c_auditoria.add')</a>
        @endif
        <a ng-show="client"  data-toggle="modal" data-target="#addProp" ng-cloak href="#" >@lang('c_auditoria.add')</a>
      </div>
      
      
      @if (isset($cliente))
      <button ng-disabled="!props" type="button" ng-click="addAudit(props)" class="btn btn-block btn-success btn-flat">@lang('c_auditoria.save')</button>
      @else
      <button ng-disabled="!client || !props" type="button" ng-click="addAudit(props)" class="btn btn-block btn-success btn-flat">@lang('c_auditoria.save')</button>
      @endif
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
                <p><b>@lang('c_auditoria.address')</b><br>@{{clientes[client].morada}}</p>
                <p><b>NIF</b><br>@{{clientes[client].nif}}</p>
                
              </div>
              
            </div>
          </div>
          <div class="modal-footer">
            <md-button type="button"  style="background-color: #494850;color: white" class="md-raised " data-dismiss="modal">@lang('c_auditoria.back')</md-button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="addProp" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
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
                  <label for="loc" >@lang('c_auditoria.geoloc')</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-map"></i>
                    </div>
                    <input type="text" class="form-control form-control-sm" ng-model="geo" id='loc' placeholder='latitude, longitude' >
                  </div>
                  
                </div>
                <div class="form-group">
                  <label for="loc" >@lang('c_auditoria.desc')</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-align-center"></i>
                    </div>
                    <input type="text" class="form-control form-control-sm" ng-model="desc" id='desc' >
                  </div>
                  
                </div>
                <br><md-button md-no-ink class="md-primary mx-auto" onclick="getCurrentLocation()"><b>@lang('c_auditoria.usecl')</b></md-button>
              </form><br>
              
            </div>
          </div>
          <div class="modal-footer">
            <md-button type="button"  style="background-color: #494850;color: white" class="md-raised leftmd " data-dismiss="modal">@lang('c_auditoria.cancel')</md-button>
            @if(isset($cliente))
            <md-button type="button"  ng-click="addProp({{$cliente->id}},-1)" class="md-raised md-primary rightmd " >@lang('c_auditoria.save')</md-button>
            @else
            <md-button type="button"  ng-click="addProp(clientes[client].id,client)" class="md-raised md-primary rightmd" >@lang('c_auditoria.save')</md-button>
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection