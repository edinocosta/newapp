@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
 @lang('auditoria.auditoria')
  <small>@lang('auditoria.audit_table')</small>
  </h1>
 <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li class="active"><a href=""><i >@lang('auditoria.auditoria')</i></a></li>
  </ol>
</section>
<br>
<div class="containerLocal">
<div class="row">
   <div class="col-sm-8" >
    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">@lang('auditoria.audit_table')</h3>
      </div>
      <!-- /.box-header -->
      @can("create","App\Auditoria")
        <md-button class="md-mini" style="color: green" ng-cloak href="/c_auditoria"  aria-label="ADD ONE"md-ripple-size="auto"><b>@lang('auditoria.new_audit')</b></md-button>
      @endcan
      <div class="box-body table-responsive">
        <table id="example1" class="table table-hover table-responsive table-bordered table-striped pointable">
          <thead>
            <tr>
              <th>@lang('auditoria.desc')</th>
              <th>@lang('auditoria.prop/proi')</th>
              <th>@lang('auditoria.during')</th>
              <th>@lang('auditoria.statu')</th>
            </tr>
          </thead>
          <tbody>
            @foreach (App\Auditoria::all() as $audit)
            <tr onclick="window.location.href='/audit_res/{{$audit->id}}'">
              <?php 
                $status=null;
                $status_str=null;
                $estado = $audit->estado()->select("id","descricao","obs")->get()->last();

              ?>
              <td>{{$audit->descricao}}</td>              
              <td><b>{{$audit->propriedade->cliente->nome}} </b>/{{$audit->propriedade->local}}</td>
              <td>{{App\DateTimes::differ2Time($audit->data_inicio,$audit->data_fim)}} 
               <center><small>{{App\DateTimes::date($audit->data_inicio,0).' - '.App\DateTimes::date($audit->data_fim,0)}}</small></center>
              </td> 

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
              <td><span class="label  {{$status}}">{{__('geral.'.$status_str)}}</span></td>
              
            </tr>
            @endforeach
          </tbody>
          
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-sm-4">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('auditoria.recent_audit')</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <ul class="products-list product-list-in-box">

                @foreach(App\Auditoria::orderBy('updated_at','desc')->take(3)->get() as $audit)
                  <li class="item pointable" onclick="window.location.href ='/audit_res/{{$audit->id}}';">                  
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{$audit->propriedade->cliente->nome}}
                      <span class="label label-warning pull-right"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{App\DateTimes::differTime($audit->updated_at)}}</span></a>
                    <span class="product-description">
                          {{$audit->propriedade->local}}
                        </span>
                  </div>
                </li>
                @endforeach
             
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase"></a>
            </div>
            <!-- /.box-footer -->
          </div>
  </div>
</div>  
 
  
  <!-- /.col -->
</div>
<!-- /.container" -->
@endsection