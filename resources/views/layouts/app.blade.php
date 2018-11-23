
@if(!Auth::user())



 <script>
       window.location.href = '/login';
     </script>
@endif

@php
  $tasks = App\User::myTasks(Auth::user());
@endphp

 
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html ng-app="app" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>REPOWR PLAT</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href={{asset('admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}>

    <link rel="stylesheet" href={{asset("css/apps.css")}} >
     <link rel="stylesheet" href={{asset("admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}>
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("admin-lte/bower_components/font-awesome/css/font-awesome.min.css")}}>

   
    <link rel="stylesheet" href={{asset("angular-material/angular-material.min.css")}}>

     <!-- Theme style -->


    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter-->

    <link href={{asset("css/indigo-pink.css")}} >
    <!-- Ionicons -->
    <link rel="stylesheet" href={{asset("admin-lte/bower_components/Ionicons/css/ionicons.min.css")}}>

      <link rel="stylesheet" href={{asset("admin-lte/bower_components/morris.js/morris.css")}}>
    <!-- daterange picker -->
    <link rel="stylesheet" href={{asset("admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}>
   
    <!-- iCheck for checkboxes and radio inputs -->
   
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href={{asset("admin-lte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css")}}>
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href={{asset("admin-lte/plugins/timepicker/bootstrap-timepicker.min.css")}}>

    <link rel="stylesheet" href={{asset("admin-lte/plugins/pace/pace.min.css")}}>
    <!-- Select2 -->
    <link rel="stylesheet" href={{asset("admin-lte/bower_components/select2/dist/css/select2.min.css")}}>
     
     @yield('style')
    
    <link rel="stylesheet"href={{asset("admin-lte/bower_components/fullcalendar/dist/fullcalendar.min.css")}}>

    <link rel="stylesheet"href={{asset("admin-lte/bower_components/fullcalendar/dist/fullcalendar.print.min.css")}} media="print">
  <!-- Theme style -->

        <link rel="stylesheet" href={{asset("admin-lte/dist/css/AdminLTE.min.css")}}>

         <link rel="stylesheet"href={{asset("admin-lte/plugins/iCheck/all.css")}}>
          <!-- bootstrap datepicker -->
    <link rel="stylesheet" href={{asset("admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}>

    <link rel="stylesheet" href={{asset("admin-lte/dist/css/skins/_all-skins.min.css")}}>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
      href={{asset("css/googleItalic.css")}}>
        <style>
 
          
        </style>
      
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-collapse sidebar-mini" ng-controller="master" >

     
      <div class="wrapper">
        <!-- Main Header -->
        <header style="width: 100%"  class="main-header">
          <!-- Logo -->
          <a href="/home" class="logo" >
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>R</b>PLF</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>REPOWER</b>PLATFORM</span>
                      <audio hidden id="myAudio">
              <source src ="{{asset('notsounds/not-bad.ogg')}}" type="audio/ogg">
              <source src='{{asset("notsounds/not-bad.mp3")}}'  type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>
                
          </a>
          <!-- Header Navbar -->
          <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->

            <a href="#" name="top" id="top" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                  <!-- Menu toggle button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-warning" ></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have  messages</li>
                    <li>
                      <!-- inner menu: contains the messages -->
                      <ul class="menu">
                        <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src={{asset(Auth::user()->img_path)}} class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <!-- end message -->
                    </ul>
                    <!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- /.messages-menu -->
              <!-- Notifications Menu -->
              <li  id="nofication" class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o" ></i>
                  <span id="heartbit" class=""></span>
                  <span id="point" class=""></span>
                  <span hidden class="label label-warning" id="myNot"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Você tem @{{nots}} notificações</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                     
                     <li ng-repeat=" n in notsf"><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-calendar-check-o text-aqua"></i>@{{n.descricao}}
                        <span class="pull-right"><small>@{{n.inicio}}</small></span>
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">@lang('home.view_all')</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li id="tasks" class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                {{--
                 <span id="theartbit" class='@if(sizeof($tasks)!=0) heartbit @endif'></span>
                 <span id="tpoint" class="@if(sizeof($tasks)!=0) point @endif"></span>
                  --}}
                <span class="label label-warning">{{(sizeof($tasks)>0?sizeof($tasks):'')}}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">{{sizeof($tasks).(sizeof($tasks)==1?' tarefa':' tarefas')}}</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    @foreach($tasks as $task)
                          
                    <li style="border-color: {{$task->backcolor}}"><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                      <b style="color:{{$task->backcolor}}">{{$task->tipoevento->descricao}}</b> <br>
                        
                         <small class="pull-left">{{App\DateTimes::date($task->inicio,0)}}</small>
                         &nbsp;<i>{{$task->descricao}}</i>                    
                     
                      <small class="label label-primary pull-right"><i class="fa fa-clock-o"></i>&nbsp;<b>{{App\DateTimes::differTime($task->inicio)}}  </b></small>
                      </h3>
                      <!-- The progress bar -->
                      
                    </a>
                    </li>

                    @endforeach
                    
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">@lang('home.view_all')</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset(Auth::user()->img_path)}}"" class="user-image" >
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> {{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset(Auth::user()->img_path)}}"" class="img-circle">
                <p>
                  {{ Auth::user()->name }}
                  <small>{{ Auth::user()->tipouser->descricao}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
  
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/perfil"  class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>

           <li>
             <a href="/lnchange/pt"><img class="iconlan" src="{{asset('img/icon/pt.png')}}" alt="PT"></a>
          </li>
          <li><a href="/lnchange/en"><img  class="iconlan" src="{{asset('img/icon/us.png')}}" alt="EN"></a></li>
            
          <!-- Control Sidebar Toggle Button -->
          @if(App\User::isAdmin(Auth::user()))
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          @endif
          
        </ul>
      </div>
    </nav>
  </header>
  <div ></div>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src={{asset(Auth::user()->img_path)}} class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/home"><i class="fa fa-link"></i> <span>@lang('home.home_page')</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>@lang('home.auditoria')</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can("create","App\Auditoria")
          <li><a href="/c_auditoria">@lang('menu.nova_audit')</a></li>
          @endcan
          <li><a href="/auditorias">@LANG('menu.ir_audit')</a></li>
          
        </ul>
      </li>
      <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>@lang('menu.sistemas')</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
        @if(Auth::user()->idTipo == 1)
        <li><a href="#">@lang('menu.monotoriz')</a></li>
        @endif
        <li><a href="#">@lang('menu.desemp')</a></li>      
        <li><a href="#">@lang('menu.visit')</a></li>   
      </ul>
      </li>
     

  <li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>@lang('menu.equips')</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="/equip_ld">@lang('menu.eletro')</a></li>
    <li><a href="/equip_instalacao">@lang('menu.instal')</a></li>
    
  </ul>
</li>
 <li class="treeview">
        <a href="#"><i class="fa fa-wrench"></i> <span>@lang('menu.util')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
          <ul class="treeview-menu">
      @if(Auth::user()->idTipo == 1 || Auth::user()->idTipo == 2)
      <li><a href="/users_manage">@lang('menu.user_man')</a></li>  
      @endif
      <li ng-click="showCustomToast()"><a  href="#">@lang('menu.ajuda')</a></li>
    </ul>
   
    </li>

    <li class="treeview">
      <a href="#"><i class="ion ion-ios-people-outline"></i> <span>@lang('menu.clientes')</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @can('create', "App\Cliente")
      <li><a href="/c_cliente">@lang('menu.add')</a></li>
      @endcan
      <li><a href="/clientes">@lang('menu.list')</a></li>
    </ul>
  </li>
   <li class="treeview">
        <a href="#"><i class="fa fa-calendar-check-o"></i> <span>@lang('menu.agendamento')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->idTipo == 1)
        <li><a href="#">@lang('menu.create_ag')</a></li>
        @endif
        <li><a href="#">@lang('menu.see_ag')</a></li>
        
      </ul>
    </li>
    @if(App\User::isAdmin(Auth::user()))
    <li><a href="/log"><i class="fa fa-history"></i> <span>Log</span></a></li>
    @endif
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div st class="content-wrapper">
  
        <i id="mTop" class="fa fa-chevron-up"></i>
<!--------------------------
| Your Page Content Here |
-------------------------->
<main class="py-4">

<div class="container">

@yield('content')



              
</div>

</main>
<!-- /.content -->
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
<!-- To the right -->
<div class="pull-right hidden-xs">
Anything you want
</div>
<!-- Default to the left -->
<strong>Copyright &copy; 2018 <a href="#">REPOWER</a>.</strong>@lang('home.all_right_r').
</footer>
@if(Auth::user()->idTipo == 1)
<aside class="control-sidebar control-sidebar-dark">
<!-- Create the tabs -->
<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<!-- Home tab content -->
<div class="tab-pane active" id="control-sidebar-home-tab">
<h3 class="control-sidebar-heading">Recent Activity</h3>
<ul class="control-sidebar-menu">
  <li>
    <a href="javascript:;">
      <i class="menu-icon fa fa-birthday-cake bg-red"></i>
      <div class="menu-info">
        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
        <p>Will be 23 on April 24th</p>
      </div>
    </a>
  </li>
</ul>
<!-- /.control-sidebar-menu -->
<h3 class="control-sidebar-heading">Tasks Progress</h3>
<ul class="control-sidebar-menu">
  <li>
    <a href="javascript:;">
      <h4 class="control-sidebar-subheading">
      Custom Template Design
      <span class="pull-right-container">
        <span class="label label-danger pull-right">70%</span>
      </span>
      </h4>
      <div class="progress progress-xxs">
        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
      </div>
    </a>
  </li>
</ul>
<!-- /.control-sidebar-menu -->
</div>
<!-- /.tab-pane -->
<!-- Stats tab content -->
<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
<!-- /.tab-pane -->
<!-- Settings tab content -->
<div class="tab-pane" id="control-sidebar-settings-tab">
<form method="post">
  <h3 class="control-sidebar-heading">General Settings</h3>
  <div class="form-group">
    <label class="control-sidebar-subheading">
      Report panel usage
      <input type="checkbox" class="pull-right" checked>
    </label>
    <p>
      Some information about this general settings option
    </p>
  </div>
  <!-- /.form-group -->
</form>
</div>
<!-- /.tab-pane -->
</div>
</aside>
@endif
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script  src={{asset("admin-lte/bower_components/jquery/dist/jquery.min.js")}}></script>
<!-- Bootstrap 3.3.7 --> 


<script  src={{asset("js/jquery.form.js")}}></script>
<script  src={{asset("admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js")}}></script>
<!-- jQuery UI 1.11.4 -->
<script src ={{asset("admin-lte/bower_components/jquery-ui/jquery-ui.min.js")}}></script>

<!-- Select2 -->
<script  src={{asset("admin-lte/bower_components/select2/dist/js/select2.full.min.js")}}></script>

<script src={{asset("angular-1.7.2/angular.min.js")}}></script>

<script src={{asset("angular-1.7.2/angular-route.min.js")}}></script>
<!-- AngularJs Material -->

<script src={{asset("node_modules/angular-aria/angular-aria.js")}}></script>
<script src={{asset("node_modules/angular-animate/angular-animate.js")}}></script>
<script src={{asset("node_modules/angular-messages/angular-messages.js")}}></script>
<script src={{asset("node_modules/angular-material/angular-material.js")}}></script>

<script src ={{asset("admin-lte/bower_components/PACE/pace.min.js")}}></script>

<!-- InputMask -->
<script  src ={{asset("admin-lte/plugins/input-mask/jquery.inputmask.js")}}></script>
<script src ={{asset("admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js")}}></script>
<script   src ={{asset("admin-lte/plugins/input-mask/jquery.inputmask.extensions.js")}}></script>
<!-- date-range-picker -->
<script src ={{asset("admin-lte/bower_components/moment/min/moment.min.js")}}></script>
<script   src ={{asset("admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}></script>
<!-- bootstrap datepicker -->
<script  src ={{asset("admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}></script>
<!-- bootstrap color picker -->
<script  src ={{asset("admin-lte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js")}}></script>
<script  src ={{asset("admin-lte/plugins/timepicker/bootstrap-timepicker.min.js")}}></script>



<!-- -------------------Pusher--------------  AdminLTE App ------------>
 <script src="https://js.pusher.com/4.3/pusher.min.js"></script>  





<script src ={{asset("admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js")}}></script>
<script src ={{asset("admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}></script>
<script  src ={{asset("admin-lte/dist/js/adminlte.min.js")}}></script>

<script src ={{asset("admin-lte/plugins/iCheck/icheck.min.js")}}></script>
      <script src ={{asset("Highcharts-6.2.0/code/highcharts.js")}}></script>
      <script src ={{asset("Highcharts-6.2.0/code/highcharts-3d.js")}}></script>
      <script src ={{asset("Highcharts-6.2.0/code/modules/exporting.js")}}></script>
      <script src ={{asset("Highcharts-6.2.0/code/modules/export-data.js")}}></script>
      {{--<script src ={{asset("highcharts/js/highcharts.js")}}></script>
      <script src={{asset("highcharts/HihgChardrilldown.js")}}></script>
      <script src ={{asset("highcharts/HIGcHARTexporting.js")}}></script>
      <script src ={{asset("highcharts/modules/export-data.js")}}></script>

--}}
<script src ={{asset("admin-lte/bower_components/raphael/raphael.min.js")}}></script>
<script src ={{asset("admin-lte/bower_components/morris.js/morris.min.js")}}></script>    


<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJdokxMSbD-SzdxcfHTbN1HZk-T8h4Sqs"/>



<script src ={{asset("admin-lte/plugins/iCheck/icheck.min.js")}}></script>

<script type="text/javascript" src={{asset("js/apps.js")}}></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
Both of these plugins are recommended to enhance the
user experience. -->
 @stack('scripts')
 <script>

  // Enable pusher logging - don't include this in production


  @if(isset($eventos))
  $(function () {



    //$.event.addProp('dataTransfer');
   
    var evs = {!!$eventos!!};
    var vetEvents=[];
    /*$("#desc").droppable({
      drop: function( ev, ui ) {
        //$(this).css('background-color',"green")
        ev.preventDefault();
        alert(ui.draggable[0].data.descricao);
      }

    });*/
    for(var i in evs){
      if (evs[i].pub_private==0 || evs[i].idUser == {!! Auth::user()->id!!} ) {
          vetEvents.push({title:evs[i].descricao,start:new Date(evs[i].inicio),end:new Date(evs[i].fim),allDay : false,backgroundColor:evs[i].backcolor,borderColor    : evs[i].bordercolor,id:evs[i].id, editable  : false
    ,idUser:parseInt(evs[i].idUser),pv:parseInt(evs[i].pub_private)});
      }
    
    }
     function allowDrop(ev) {
      ev.preventDefault();
    }

      function drag(ev, data) {
          ev.data['tipo']=data;
      }

      function drop(ev) {
          ev.preventDefault();
      }
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }
        var a =$(this);
        $(this).find(".closeon").click(function() {
              if(!confirm("Ao ser apagado, todos os eventos deste tipo serão apagados.\nProsseguir apagar "+a.text().replace("X",""))) return false;
                   $("#"+a.attr("id")).remove();
                  
                   ajaxPost("/deleteTipoEvent", {id:a.attr("id")});
                   return false
            });

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 10  //  original position after the drag
        })

      });
    }
  

    init_events($('#external-events div.external-event'))

    



    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
       dayClick: function(date, jsEvent, view) {
      //alert('Dia Clikado'+ date.format());
     }, eventClick: function(calEvent, jsEvent, view) {

    alert('Evento: ' + calEvent.title+" "+calEvent.id);
  },
   eventDrop: function(event, delta, revertFunc) {

    if(event.idUser != parseInt({!! Auth::user()->id!!})){
      revertFunc();
      return false;
     }

    if (!confirm("Você quer realmente manter essa alterção?")) {
      revertFunc();
    }
    else {
     var d = new Date(event.start);
    var response = ajaxPost("/alterevent",{id:event.id, inicio:d.toUTCString().replace(' GMT',''),fim:new Date(event.end).toUTCString().replace(' GMT','')});
    if (response == -1) {
      alert("Erro de Comunicação com Servidor");
      revertFunc();
    }
    
  }
},
      locale:  '{{App::getLocale()}}',
      header    : {
        left  : 'prev,next,today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay,list'
      },
      //Random default events
    @can('create', App\Evento::class)
     eventResize: function(event, delta, revertFunc) {
     
        if (!confirm("\nManter?")) {
        revertFunc();
      }else {
         var d = new Date(event.start);
        var d2 = new Date(event.end);            
      var response = ajaxPost("/alterevent" ,{id:event.id,inicio:d.toUTCString().replace(' GMT',''),fim:d2.toUTCString().replace(' GMT','')});
       if (response == -1) {
      alert("Erro de Comunicação com Servidor");
      revertFunc();

    }        

      }

      },@endcan
      events    : vetEvents,    
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay,revertFunc) { // this function is called when something is dropped
        var dados = $('#descricao').val()
        if (dados.length == 0) {
          alert("Por favor, prienche o campo de descrição")
          return;
        }
        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        var last = copiedEventObject.title; 
        copiedEventObject.title           = dados
        copiedEventObject.start           = date
        copiedEventObject.idUser = {!! Auth::user()->id!!}
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color');
            var d = new Date(date);
             var s = 1;
              @if(App\User::isAdmin(Auth::user()))

              if (document.getElementById('pub').checked) {

                if (!confirm('Atenção!\nEsse envento será visivel a todos utilizadore\nQuer continuar?')) {
                    revertFunc();
                    return false;
                }
                

                s = 0;
              }

              @endif;
            $.ajax({
            url: "/addEvent",
            method: "POST",
            data: {/*socket_id:pusher.connection.socket_id,*/inicio: d.toUTCString().replace(' GMT',''),textTipo:last.replace("X",""),descricao:dados,backcolor:$(this).css('background-color'),bordercolor:$(this).css('border-color'),ppv:s,  user:{!! Auth::user()->id!!} }
            }).done(function(response) {
               copiedEventObject.id=parseInt(response);
               $('#descricao').val('');

               if (s == 0) {
                   var q = parseInt($("#meus").text())+1;
                   $("#meus").empty();
                   document.getElementById("meus").append(q);

                   q = parseInt($("#geral").text())+1;
                   $("#geral").empty();
                   document.getElementById("geral").append(q);
               }
               else {
                 var q = parseInt($("#meus").text())+1;
                   $("#meus").empty();
                   document.getElementById("meus").append(q);
               }
               $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)
             }).fail(function (error) {
               //$(this).remove();
               alert("Erro de Comunicação com Servidor");
             
              });

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        
        
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      },
      eventStartEditable:true,
      eventDurationEditable:true,
       eventRender: function(event, element) {

        if(event.idUser == parseInt({!! Auth::user()->id!!})){
            element.append( "<span class='closeon pull-riht'>X</span>" );
            element.find(".closeon").click(function() {
              if(!confirm("Prosseguir apagar este evento"))return false;
                              
                  $.ajax({
            url: "/deleteEvent",
            method: "POST",
            data: {id:event.id}
            }).done(function(response) {
                $('#calendar').fullCalendar('removeEvents',event.id);
                if (event.pv == 0) {
                  var q = parseInt($("#meus").text())-1;
                   $("#meus").empty();
                   document.getElementById("meus").append(q);

                   var q = parseInt($("#geral").text())-1;
                   $("#geral").empty();
                   document.getElementById("geral").append(q);
               }
               else {
                var q = parseInt($("#meus").text())-1;
                   $("#meus").empty();
                   document.getElementById("meus").append(q);
               }
                return false;
             }).fail(function (error) {
               //$(this).remove();
               alert("Erro de Comunicação com Servidor");
               return false
             
              });
              
             return false
            });
        }}
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val);
      $('#new-event').val('');
      $('#new-event').prop("disabled",true);
          $.ajax({
            url: "/addTipoEvent",
            method: "POST",
            data: {descricao:val,backcolor:currColor,bordercolor:currColor,color:"#fff", user:{!! Auth::user()->id!!}}
            }).done(function(response) {
              event.attr("id",response);
              event.prepend($('<span style="float: right"class="closeon pull-riht">X</span>'));      
              $('#external-events').prepend(event);
              $('#new-event').prop("disabled",false);
      //Add draggable funtionality
      init_events(event)
             }).fail(function (error) {
               //$(this).remove();
               alert("Erro de Comunicação com Servidor");
             
              });
       

      //Remove event from text input
      
    });
  })
@endif
</script>
 <script  >
  if (typeof $pode !== 'undefined') {
      if($pode){
        @if (isset($medicao))
           generate ({!!json_encode($medicao->medida()->get())!!}, -1 );
        @endif
       
    }
}

    </script>
</body>
</html>
