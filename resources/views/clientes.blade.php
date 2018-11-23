@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
  Clientes
  <small>Lista de Clientes activos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i>Principal</a></li>
    <li class="active"><a href="/clientes"><i >Clientes</i></a></li>
  </ol>
</section>
<br>
<div class="row containerLocal" >
 <div class="box" >
      <div class="box-header">
        <h3 class="box-title">Tabela de Clientes</h3>
      </div>
      <!-- /.box-header -->
      @can('create',App\Cliente::class)
       <md-button class="md-mini md-warn" ng-cloak href="/c_cliente"  aria-label="ADD ONE"md-ripple-size="auto"><b>Adicionar</b></md-button>
       @endcan
      <div class="box-body table-responsive pointable">
        <table id="example1" class="table  table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Morada</th>
            </tr>
          </thead>
          <tbody>
            @foreach (App\Cliente::where("estado",0)->get() as $user)
            <tr onclick="window.location.href='cliente/detalhes/{{$user->id}}';">
              <td>

                 @if (App\DateTimes::diffday($user->created_at) <= 2 )
                  <span style="background-color: orange;" class="badge badge-secondary">novo</span>
                @endif 

                {{$user->nome}}</td>
              <td>{{$user->morada}}</td>
            </tr>

            @endforeach
          </tbody>
          
        </table>
      </div>
      <!-- /.box-body -->
    </div>
   <!-- /.col -->
</div>
<!-- /.container" -->

@endsection

