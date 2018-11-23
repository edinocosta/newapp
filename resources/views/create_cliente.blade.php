@extends('layouts.app')
@section('content')
<!-- .container" -->

<section class="content-header">
  <h1>@lang('c_cliente.addcli')
  <small>@lang('c_cliente.regisnew')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol>
</section><br>
<div class="containerLocal">
  <div class="box box-info box-warning" ng-controller="addCliente">
  <div class="box-header">
    <h3 class="box-title">@lang('c_cliente.info')</h3>
  </div>
  <div class="box-body ">
    <div  class="ext-content">
      <form method="post" action="/addCliente"  enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
          <label for="nome">@lang('c_cliente.name')</label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input name="nome"  required type="text" class='form-control form-control-sm' id="nomes" placeholder='@lang('c_cliente.f_name')' > </div>
           </div>
       
        <div class="form-group">
          <label for="morada" >@lang('c_cliente.mor')</label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
               <input name="morada" type=text class="form-control" form-control-sm id="morada" placeholder='@lang('c_cliente.ender')' > 
           </div>
          
        </div>
        <div class="form-group" >

          <label for="email" >Email</label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" name="email"  class="form-control"   id="email" placeholder="user@exemplo.com" placeholder="Email">
           </div>
        </div>
        <div class="form-group">
         <label for="telefone">@lang('c_cliente.telef')</label>
         <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" name="telefone" class="form-control"  id="telefone" data-inputmask='"mask": "9999999"' data-mask> 
           </div>
        
       </div>
        <div class="form-group">
          <label for="nif">NIF</label>
          <input type="text" name="nif"  class='form-control form-control-sm' ng-model="ni" id="nif" data-inputmask='"mask": "999999999"' data-mask>
        </div>

        <div class="form-group">
          <label for="nif">@lang('c_cliente.pic')</label>
          <input type="file" class="form-control" placeholder="escolha a imagem" accept=".jpg" name="image">
        </div>

           

        <md-button type="submit"  style="display: inline-block;float: right; margin-left: 23px;background-color: orange;color: white" class="md-raised  mx-auto" ">@lang('c_cliente.save')</md-button>
        <md-button  onclick="window.history.back();" style="display: inline-block;float: right; background-color: #494850;color: white" class="md-raised  mx-auto">@lang('c_cliente.cancel')</md-button>
      </form>
      
    </div>
  </div>
  <!-- /.box-body -->
  <!-- /.box -->
  <!-- /.container" -->
</div>  
</div>

@endsection