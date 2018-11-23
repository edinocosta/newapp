@extends('layouts.app')
@section('content')
<!-- .container" -->
<!-- Content Header (Page header) -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Perfil do Utilizador
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-dashboard"></i> Principal </a></li>
      <li class="active">User profile</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle"  src="{{asset(Auth::user()->img_path)}}">
            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
            <p class="text-muted text-center">{{Auth::user()->tipouser->descricao}}</p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Email</b> <a class="pull-right">{{Auth::user()->email}}</a>
              </li>
              <li class="list-group-item">
                <b>Contacto</b> <a class="pull-right">.....</a>
              </li>
              <a href="#" class="btn btn-primary btn-block"><b>Editar Foto</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-sm-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="" data-target="#activity" data-toggle="tab">Configuração</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form method="post" action="/edtiuser" enctype="multipart/form-data" class="form-horizontal">
                  @csrf
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail"   class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                      <input type="number" hidden name="id" value="{{Auth::user()->id}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="inputEmail"   class="col-sm-2 control-label">Foto de Perfil</label>
                    <div class="col-sm-10"> 
                     <input type="file" class="form-control" placeholder="escolha a imagem" accept=".jpg" name="image">                 
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">GUARDAR</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  @endsection