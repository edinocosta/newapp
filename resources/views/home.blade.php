@extends('layouts.app')
@section('content')

<!-- .container" -->
<!-- Content Header (Page header) -->

<section  class="content-header">
  <h1 id="pg">
  @lang('home.home_page')  
  <small></small>
  </h1>
 
</section>
<br>


<div style="margin-left: 0px" class="row">
  <div onclick="window.location.href = '/auditorias'" class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box fastmenu">

      <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">@lang('home.auditoria')</span>
        <span class="info-box-number">{{App\Auditoria::count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12 ">
    <div class="info-box fastmenu">
      <span class="info-box-icon bg-orange"><i class="fa fa-tasks"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">@lang('home.envento')</span>               
        <span  class="info-box-text">@lang('home.evn_m') :  <span id="meus">{{sizeof(Auth::user()->evento()->where('pub_private',1)->get())}}</span></span>
        <span class="info-box-text">@lang('home.evn_g'): <span id="geral">{{App\Evento::where('pub_private',0)->count()}}</span></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div onclick="window.location.href = '/clientes'" class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box fastmenu">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">@lang('home.clientes')</span>
        <span class="info-box-number">{{App\Cliente::where("estado",0)->get()->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  @if(App\User::isAdmin(Auth::user()))
  <div  onclick="window.location.href = '/users_manage'" class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box fastmenu">
      <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">@lang('home.users')</span>
        <span class="info-box-number">{{App\User::count()}}</span>
      </div>
      <div class="info-box-content">
       
      </div>
      
    </div>
    <!-- /.info-box -->
  </div>
  @endif
</div>


<!-- Main content -->
<section  style="margin-left: 1.28%" >
  <div class="row">
    <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 draggable="true" class="box-title">@lang('home.event_arast')</h4>
        </div>
        <div class="box-body">
          <!-- the events -->
          <div id="external-events">
             @foreach (Auth::user()->tipoevento()->get() as $tipo)
                 <div  draggable="true"  id="{{$tipo->id}}" class="external-event" style="background-color: {{$tipo->backcolor}};border-color: {$tipo->bordercolor}};color: #FFF">{{$tipo->descricao}}<span style="float: right"class='closeon pull-riht'>X</span></div>
             @endforeach
            <div class="checkbox">
              <label for="drop-remove">
                <input type="checkbox" id="drop-remove">
                Eliminar ao soltar
              </label>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      
      <!-- /. box -->
      
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('home.create_event')</h3>
        </div>
        <div class="box-body">
          <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
            <ul class="fc-color-picker" id="color-chooser">
              <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
            </ul>
          </div>
          <!-- /btn-group -->
          <div class="input-group">
            <input id="new-event" type="text" class="form-control" placeholder="@lang('home.evn_title')">
            <div class="input-group-btn">
              <button  id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
            </div>
            <!-- /btn-group -->
          </div>
          <!-- /input-group -->
        </div>
      </div>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('home.event_desc')</h3>
        </div>
        <div class="box-body">
         
          <!-- /btn-group -->
         
         
            <textarea  style="max-width: 100%" id="descricao" class="form-control" placeholder="@lang('home.des_event')"></textarea>
          @if(App\User::isAdmin(Auth::user()))

            <div class="mradio">
                <label>
                  @lang('home.pub')
                  <input type="radio" id="pub" name="r1" class="minimal-red">
                </label>
                <label>
                  @lang('home.pvt')
                  <input type="radio" id="priv" name="r1" class="minimal-red" checked>
                </label>
            </div>

             @endif


            <!-- /btn-group -->
          
          <!-- /input-group -->
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9" >
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div   id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.container" -->

@endsection

@push('scripts')
   <script src ={{asset("admin-lte/bower_components/moment/moment.js")}}></script>

<script src ={{asset("admin-lte/bower_components/fullcalendar/dist/fullcalendar.min.js")}}></script>

<script  src ={{asset("admin-lte/bower_components/locale-all.js")}}></script>
<script>
$(document).ready(function(){
    
   //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
});

</script>
@endpush

