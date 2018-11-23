$crf={'X-CSRFToken': '{{ csrf_token }}'};
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



//Scroll Handling

  $('#mTop').on('click', function(){
    $('html, body').animate({scrollTop:$('#top').offset().top},500);
    return false;
  });
   
      window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            document.getElementById("mTop").style.display = "block";
        } else {
            document.getElementById("mTop").style.display = "none";
        }
    } 






   

$mindate=null;
$maxdate=null;

 
 $(document).ajaxStart(function () {
    Pace.restart()
  });
   /*     ____________________PUSHER HERE_____________________________
      var isDlgOpen = false;
       var pusher = new Pusher('36bda56147546be7c027', {
      cluster: 'us2',
      forceTLS: true
    });*/
    
    

$("#nofication").click(function(){
    $("#heartbit").removeClass("heartbit");
    $("#point").removeClass("point");
});

$("#tasks").click(function(){
    $("#theartbit").removeClass("heartbit");
    $("#tpoint").removeClass("point");
});
  //var dataTransfer = new DataTransfer();
  
 /* function drag(event,data) {
        event['dataTransfer']=dataTransfer;
        event.dataTransfer.dropEffect='copy';
        event.dataTransfer.setData("text/html",null);
        //event.dataTransfer.dropEffect='copy';
        event.target['data']=data;// Passar dados para o objecto para pegar onde for soltado
       console.log(event.dataTransfer);
  }

  function dragover(event){
    event.preventDefault();
     event.stopPropagation();
     
    $('#desc').addClass("d_over");
    $('#desc').removeClass("d_end");
    //return true;
  }
   function stop(event){
    
    $('#desc').removeClass("d_over");
    $('#desc').addClass("d_end");

    //return false;
  }
*/
function _(el) {
  return document.getElementById(el);
}



$("#pg").draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 10  //  original position after the drag
        });


Highcharts.setOptions({
    lang: {
        months: [
            'Janeiro', 'Fevereiro', 'Março', 'Abril',
            'Maio', 'Junho', 'Julho', 'Agosto',
            'Setembro', 'Outubro', 'Novembro', 'Dzembro'
        ],
        weekdays: [
            'Domingo', 'Segunda', 'Terça', 'Quarta',
            'Quinta', 'Sexta', 'Sabado'
        ],
         drillUpText: '<b>Voltar</b>'
    }
});


 var datas=[];
      dateRange="";
      var tab = document.getElementById('data');
      var worker = new Worker('../../js/worker.js');
      mydata = {};
      timeInis ={};
      timeFim={};
      var timeIni;
      var dataIni;

  
            
            
    



function generate ($dados,$contador,$where) {


switch ($where) {
  case 1:
      /*
     * DONUT CHART
     * -----------
     */

   
    
    break;
  default:
  var dats =[];
  var ener = readyData(0);
 //alert(ener); return;
 for (var i in $dados) {
        //var vet = [equips,parseFloat($dados[i][ener])];
        dats.push({name:"<b>"+$dados[i].data_ini+" - "+$dados[i].data_fim+"</b>",y:parseFloat($dados[i][ener])});
  }




Highcharts.chart(document.getElementById('bar_char'), {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Consumo de Equipamentos'
    },
    subtitle: {
        text: 'Mais Informação Por Vir'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Consumo em kWh'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y} kWh'
            }
        }
    },

    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> kWh <br/>'
    },

    series: [{
      name: 'Consumo de Equipamentos',
      colorByPoint: true,
      data: dats}
     ],
    });
    break;
}

 

}


app = new angular.module('app',['ngRoute','ngMaterial', 'ngMessages','ngAnimate']).constant("CSRF_TOKEN", '{{ csrf_token() }}');;

$(function () {

$('#example1').DataTable({
"language": {
            "lengthMenu": "<b >_MENU_ Dados por página</b>",
            "zeroRecords": "<b class ='text-danger'>Nanhum resultado encontrado<b/>",
            "info": "<b>Mostrando página _PAGE_ de _PAGES_ </b>",
            "infoEmpty": "<b>Dados Indisponiveis</b>",
            "infoFiltered": "(filtrado de _MAX_ dados total)",
            "paginate": {
               "previous": "Anterior",
                "next": "Próximo"
            },
            "search":"<button class='msbt'><i class='fa  fa-search' ></i></button>"

        },
        buttons: [
        'csvHtml5'
    ]
});


});
$(function () {
//Initialize Select2 Elements
$('.select2').select2()
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Money Euro
$('[data-mask]').inputmask()
//Date range picker
$('#reservation').daterangepicker()
//Date range picker with time picker
$('#reservationtime').daterangepicker(
{ 
  
  autoApply:true,
  timePickerIncrement:30,
  autoApply:true, 
  locale: {
    format: 'DD/M/YYYY'//,
   },
  minDate: new Date()
  });
$('#reservationtime').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
//Date range as a button
/*
$('#daterange-btn').daterangepicker(
{
ranges   : {
'Hoje'       : [moment(), moment()],
'Ontem'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month'  : [moment().startOf('month'), moment().endOf('month')],
'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
},
startDate: moment().subtract(29, 'days'),
endDate  : moment()
},
function (start, end) {
$('#daterange-btn span').html(start.format('MMMM D, YYYY h:mm A') + ' - ' + end.format('MMMM D, YYYY h:mm A'))
}
)*/
//Date picker
$('#datepicker').datepicker({
autoclose: true,
endDate:new Date()
});

$('.datepicker').datepicker({
autoclose: true,
endDate:new Date()
});
/*iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
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
//Colorpicker
$('.my-colorpicker1').colorpicker()
//color picker with addon
$('.my-colorpicker2').colorpicker()
*/
//Timepicker
$('.timepicker').timepicker({
showInputs: false,
showMeridian:false,
snapToStep : false
})
})

app.controller('master', function($mdToast,$scope,$mdDialog,$rootScope,$http) { 
  

    $scope.tasks=[];
    $scope.notsf=[];
    $scope.nots=0;
    $scope.c1=true;
    $scope.c2=true;
    $scope.mdate;
    $scope.midate;



     worker.onmessage = function(e) {
                
                //alert($("#interval").val());
            
            var per= (e.data.allData.length)*1;
            //tab.innerHTML= e.data.allData.substring(0,per);
            datas=e.data.allData;
            dateRange=e.data.dataRange;
            timeIni=e.data.timeIni;
            dataIni=e.data.dataIni;
            $("#dataLimite").html("<b> Data Limite</b>: "+dateRange);
            $("#timeIni").html("<b>Iniciado em</b>: "+timeIni);
            $("#consumo").html("<b>Toatl Consumo</b>: "+e.data.consumo);
            var d = dateRange.split("-");
            var d1= d[1].split(" ")[0].split("/");
            $scope.mdate= new Date(d1[2]+"-"+d1[1]+"-"+d1[0]+" "+d[1].split(" ")[1]);          
            d1= d[0].split(" ")[0].split("/");
            $scope.midate= new Date(d1[2]+"-"+d1[1]+"-"+d1[0]+" "+d[0].split(" ")[1]);
            $('#reservationtime').daterangepicker(
            { 
              timePicker:true,
              timePickerIncrement:1,
              timePicker24Hour:true,
              autoApply:true,
              startDate:$scope.midate,
              endDate: $scope.mdate,

               locale: {
                format: 'DD/MM/YYYY HH:mm'//hh:mm A,
              },             
              minDate: $scope.midate,
              maxDate: $scope.mdate                
             });
            };
   worker.onerror = function(e) {
            alert("Erro");
            };    

    
    /*var channel = pusher.subscribe('my-channel');

    channel.bind('pusher:subscription_succeeded', function() {
      //alert("Conexão Real Time sucessedida");
    });

    channel.bind('pusher:subscription_error', function() {
      alert("Erro na Conexão Real Time\n Atualize A página de novo!!\n Se erro não aparecer é porque sucessedeu a conexao");
    });

    channel.bind('my-event', function(data) {
          //var q = parseInt($("#myNot").text())?parseInt($("#myNot").text())+1:1;
          //$("#myNot").empty();
          //document.getElementById("myNot").append(q);
          $scope.showCustomToast();
          $scope.notsf.push(data);
          $scope.nots +=1;
          document.getElementById("myAudio").play();
          $("#heartbit").addClass("heartbit");
          $("#point").addClass("point");
    });   */
    
       $scope.showCustomToast = function() {
        $mdToast.show({
          hideDelay   : 9000,
          position    : 'bottom right',
          controller  : 'ToastCtrl',
          template : '<md-toast class="mtoast" ><span class="md-toast-text" flex>Novo envento Adicionado!</span><md-button class="md-highlight" ng-click="openMoreInfo($event)">  Detalhes  </md-button> <md-button ng-click="closeToast()"> Fechar </md-button></md-toast>'
        });
      };

      $scope.smap = function ($strGeo){
          var data =$strGeo;
          
          var map;
         
          var myCenter = new google.maps.LatLng(parseFloat(data[0]),parseFloat(data[1]));
          var mapCanvas = document.getElementById("map");
          var mapOptions = {center: myCenter, zoom: 15};
          var map = new google.maps.Map(mapCanvas, mapOptions);
          var marker = new google.maps.Marker({position:myCenter});
          marker.setMap(map);

         /* google.maps.event.addListener(map, 'click',function(event){

            geocoder.geocode({'latLng':event.latLng}, function(results,status){
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                  alert(results[0].formatted_address);
                }
              }
            });
          });*/

          
         
    }
    
     $http.get("/getCliente").then(function(response){
        //Login realizado,
        // redirecionar para pagina de posts
        $scope.clientes = response.data;
        
        },function(response){ 
          alert("Verifique A conexao");
          return;
        });

     $scope.addAudit=function($idPropriedade){
     $dat=$("#reservationtime").val().split(" - ");   
      $data_i = $dat[0].trim(); 
      $data_f = $dat[1].trim();
      if($scope.c_ini<0){
        confirm("Dados de Contador Invalido!")
        return;
      } 
     if (!confirm("Confirmar a  Operação?"))return;
     $http.post("/addAudit",{"propriedade":$idPropriedade,"c_ini":$scope.c_ini,"descricao": $("#desc").val(),'d_ini' : $data_i,'d_fim' :$data_f}, {'_token': 'CSRF_TOKEN'}).then(function(response){

          $data = response.data;
         //console.log($data);
         switch ($data) {
           case '-1':
             alert("Auditoria não adicionada");
             break;
           case '2':
             $('#propSelector').addClass('inputError');
             alert("Aviso!!\nEssa proriedade já foi Auditada");
              document.getElementById("help-block").style.display = "block";
             break;  
           default:
              
             alert("Auditoria Criada");
            window.location.href ="/auditorias";
             $('#propSelector').removeClass('inputError');
              $('#propSelector').addClass('inputSucsess');
             document.getElementById("help-block").style.display = "none"; 

             break;
         }
        },function(response){ 
          alert("Verifique A conexao");

        });

     



  }

     $scope.addProp= function($cliente_id,$index) {


      //alert($cliente_id); return;
         if (!confirm("Confirmar a  Operação?"))return;
         $http.post("/addProp",{"cliente_id":$cliente_id,"local":$("#local").val(),"geo":$("#loc").val(),"desc":$('#desc').val()}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         $data = response.data;
         //console.log($data);
         switch ($data) {
           case '-1':
             alert("Propriedade Não Criada");
             break;
           default:
               $("#addProp").modal('hide');
             alert("Nova Propriedade Inserida");
             if($index==-1) window.location.href="/c_auditoria/"+$cliente_id
             $scope.clientes[parseInt($index)].propriedade.push($data);
             break;
         }
        },function(response){ 
          alert("Não foi possivel Criar, verifique aconexao");

        });
    }



}); 

app.controller('clienteAreaController', function($scope,$mdDialog,$rootScope,$http) {
    
    
     $scope.addProp= function($cliente_id) {

      //alert($cliente_id); return;
         if (!confirm("Confirmar a  Operação?"))return;
         $http.post("/addProp",{"cliente_id":$cliente_id,"local":$("#local").val(),"geo":$("#loc").val(),"desc":$('#desc').val()}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         $data = response.data;
         //console.log($data);
         switch ($data) {
           case '-1':
             alert("Propriedade Não Criada");
             break;
           default:
               $("#addProp").modal('hide');
             alert("Nova Propriedade Inserida");
             window.location.href ='/cliente/detalhes/'+$cliente_id;
             break;
         }
        },function(response){ 
          alert("Não foi possivel Criar, verifique aconexao");

        });
    }
});   


app.controller('addCliente', function($scope,$mdDialog,$rootScope,$http) {
    $scope.addCliente=function(){

    if (!confirm("Confirmar a  Operação?"))return;
     $http.post("/addCliente",{'nome' :$("#nomes").val(),'telefone' : $("#telefone").val(),'morada' : $("#morada").val(),'nif' :$("#nif").val(),'email' : $("#email").val()}, {'_token': 'CSRF_TOKEN'}).then(function(response){
        //Login realizado,
        // redirecionar para pagina de posts
       
        $scope.cliente = response.data;
        if($scope.cliente.length!=0){
            alert("Cliente Inserido Co Sucesso"); 
          //$scope.showCustomToast();
           window.location.href = '/clientes';
         //upDateClientes($id,$http,$scope,$location);
        }
        else{
          alert("Cliente Já Existe, Verifique o NIF");
        }
        },function(response){ 
          alert("Verifique A conexao");


        })};
}); 

app.controller('addEquipLd', function($scope,$mdDialog,$mdToast,$rootScope,$http) {
   
    $scope.addEquip=function(){
    
    if (!confirm("Confirmar a  Operação?"))return;
     $http.post("/addEquipLD",{'nome':$scope.nome,'marca':($scope.marca),'modelo':$scope.modelo.toUpperCase(),'corrente':$scope.corrente,
      'potencia':$scope.potencia,'consumo':$scope.consumo,'frequencia':$scope.frequencia,'tensao':$scope.tensao,
      'categoria':$scope.categoria,'alimentacao':$scope.alimentacao,'serie':$scope.serie}, {'_token': 'CSRF_TOKEN'}).then(function(response){
        //Login realizado,
        // redirecionar para pagina de posts
       
        
        
        if (document.getElementById("drop-remove").checked) {
          $(".deletale").val('');
          $mdToast.show({
          hideDelay   : 10000,
          position    : 'bottom right',
          controller  : 'ToastCtrl',
          template : '<md-toast class="mtoast" ><span class="md-toast-text" flex>Inserido com Sucesso</span><md-button class="md-highlight" ng-click="closeToast()"> Fechar </md-button></md-toast>'
        });
            return;         
        }
        alert("Adicionado Com Sucesso");
        window.location.href = '/equip_ld';
        },function(response){ 
          alert("Verifique A conexao");


        })};
});

app.controller('addFEquipLd', function($scope,$mdDialog,$rootScope,$http) {
   
    $scope.addEquip=function(){
      
     if (!confirm("Confirmar a  Operação?"))return; 
     $http.post("/addFEquipLD",{'nome':$scope.nome,'marca':($scope.marca),'modelo':$scope.modelo.toUpperCase(),
      'potencia':$scope.potencia,'consumo':$scope.consumo,'categoria':$scope.categoria,"tensao":$scope.tensao}, {'_token': 'CSRF_TOKEN'}).then(function(response){
        //Login realizado,
        // redirecionar para pagina de posts
       
        $("#addEq").modal('hide');
        alert("Adicionado Com Sucesso");
        window.location.href = '/equip_ld';
        },function(response){ 
          alert("Verifique A conexao");


        })};

});
var t = $('#example3').DataTable();










app.controller('equip_eiController', function($scope,$mdDialog,$rootScope,$http) {
    
    $scope.equip = [];
    $scope.equips = [];
    $scope.equips1 = [];
    $scope.equips2 = [];
    var a  = 0;
    var b  = 0;
   $scope.equip["Inversor"]=[{name:"potencia",label:"Potencia"},{name:"t_entrada",label:"Ten. Entrada"},{name:"t_saida",label:"Ten. Saida"},{name:"c_entrada",label:"Corrente Entrada"},
      {name:"c_saida",label:"Corrente Saída"},{name:"dimensao",label:"Dimensão"}];
   $scope.equip["Controlador"]=[{name:"p_entrada",label:"Potencia Entrada"},{name:"t_entrada",label:"Ten. Entrada"}, {name:"c_saida",label:"Corrente Saída"},{name:"dimensao",label:"Dimensão"}
      ,{name:"t_temperatura",label:"Temperatura do Trabalho"}];  
   $scope.equip["Bateria"]=[{name:"t_equalizacao",label:"Tempo de Equailização"},{name:"boost",label:"Boost"},{name:"float",label:"Float"},{name:"capacidade",label:"Capacidade"}];       
   $scope.equip["Painel Solar"]=[{name:"dimensao",label:"Dimensão"},{name:"eficencia",label:"Eficência"},{name:"celulas",label:"N° de Celulas"}];
   $scope.equips2 = $scope.equip;
   
    $scope.equip["Inversor"].push({name:"marca",label:"Marca"},{name:"modelo",label:"Modelo"});
   $scope.equip["Controlador"].push({name:"marca",label:"Marca"},{name:"modelo",label:"Modelo"});
   $scope.equip["Bateria"].push({name:"marca",label:"Marca"},{name:"modelo",label:"Modelo"});
   $scope.equip["Painel Solar"].push({name:"marca",label:"Marca"},{name:"modelo",label:"Modelo"}); 
   

      $scope.getEI=function($equipamento){

        $scope.equips=[];
        $scope.equips1=$scope.equip[$equipamento]

        var vs=[];
         t.clear().draw();
         //$('#example3').empty();
         $http.post("/getEI",{'name':$equipamento}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         
         $scope.equips=response.data;

         if ($equipamento == 'Bateria' && a == 0  ) {          
             $scope.equips1.push({name:'tipob',label:'Tipo'});
             a =  1;           
           } 
           if ($equipamento == 'Painel Solar' && b == 0){
              $scope.equips1.push({name:'tipop',label:'Tipo'}); 
             a = 1;
           }     
         for (prop in $scope.equips) {

          if ($equipamento == 'Bateria') {             
             $scope.equips[prop].tipob=$scope.equips[prop]['tipob'].descricao; 
           } 
           if ($equipamento == 'Painel Solar'){
             $scope.equips[prop].tipop=$scope.equips[prop]['tipop'].descricao;
           }  
            var v=[];             
           for (prop1 in $scope.equip[$equipamento]) {

             v.push($scope.equips[prop][$scope.equip[$equipamento][prop1].name]);              
           }
            
             
           console.log(v) 
           t.row.add(v).draw();

         }

          //$('#example3').DataTable();       
        },function(response){ 
          alert("Não Foi Carregar.\n Verifique aconexao");

        });         
   }
});


app.controller('equip_eiController2', function($scope,$mdDialog,$rootScope,$http) {
    
    $scope.equip = [];
 
   $scope.equip["Inversor"]=[{name:"potencia",label:"Potencia"},{name:"t_entrada",label:"Ten. Entrada"},{name:"t_saida",label:"Ten. Saida"},{name:"c_entrada",label:"Corrente Entrada"},
      {name:"c_saida",label:"Corrente Saída"},{name:"dimensao",label:"Dimensão"}];
   $scope.equip["Controlador"]=[{name:"p_entrada",label:"Potencia Entrada"},{name:"t_entrada",label:"Ten. Entrada"}, {name:"c_saida",label:"Corrente Saída"},{name:"dimensao",label:"Dimensão"}
      ,{name:"t_temperatura",label:"Temperatura do Trabalho"}];  
   $scope.equip["Bateria"]=[{name:"t_equalizacao",label:"Tempo de Equailização"},{name:"boost",label:"Boost"},{name:"float",label:"Float"},{name:"capacidade",label:"Capacidade"}];       
   $scope.equip["Painel Solar"]=[{name:"dimensao",label:"Dimensão"},{name:"eficencia",label:"Eficência"},{name:"celulas",label:"N° de Celulas"}];
  

});










app.controller('equip_ldController', function($scope,$mdDialog,$rootScope,$http) {
   
    $scope.switch=function($equipamento){
      $scope.equip=$equipamento;
   };
});



app.controller('auditRegController', function($scope,$mdDialog,$rootScope,$http) {

    $scope.save=function($idAudit){

      if (!confirm("Confirmar a  Operação?"))return;
     $http.post("/addRegisto",{"id_auditoria":$idAudit,"id_compartimento":$scope.compart,"d_ini":$scope.d_ini,"d_fim":$scope.d_fim,"c_ini":$scope.c_ini,"c_fim":$scope.c_fim,
          "h_ini":$scope.h_ini,"h_fim":$scope.h_fim}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         $data = response.data;
       
         switch ($data) {
           case '-1':
             alert("Registo não adicionada");
             break;
           default:
              
             alert("Novo Registo inserido");
             //$scope.registos.push($data);
           window.location.href ="/audit_res/"+parseInt($idAudit);
             break;
         }
        },function(response){ 
          alert("Não foi possivel criar.\n Verifique aconexao");

        });
   };
});

app.controller('edit_PropController', function($scope,$mdDialog,$rootScope,$http) {

  $scope.addCompart=function($idCompart){ 

        if (!confirm("Confirmar a  Operação?"))return;
        $http.post("/addCompart",{"prop_id":$idCompart,"nome":$("#nome").val(),"pedir":$("#alt").val(),"compr":$("#compr").val(),"largura":$("#larg").val(),"piso":$("#piso").val()}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         $data = response.data;
         //console.log($data);
         switch ($data) {
           case '-1':
             alert("Compartimento não adicionada");
             break;
             default:
             alert("Novo compartimento inserido");
             window.location.href ="/edit_prop/"+$idCompart;
             break;
         }
        },function(response){ 
          alert("Não foi possivel criar.\n Verifique aconexao");

        });
                 
  
        }
         


});

app.controller('addCController', function($scope,$mdDialog,$rootScope,$http) {



  $scope.addC=function($idRegisto,$audit){ 

       if (!confirm("Confirmar a  Operação?"))return;
        $http.post("/addConsumo",{"registo_id":$idRegisto,"energia":$scope.energ,"pmin":$scope.wmin,"pmax":$scope.wmax,"dia":$scope.dia,"hora":$scope.tempo,"equip":$scope.equip}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         $data = response.data;
         console.log($data);
         switch ($data) {
           case '-1':
             alert("Consumo não adicionada");
             break;
             default:
             alert("Novo Consumo inserido");
             window.location.href ="/audit_res/"+$audit;
             break;
         }
        },function(response){ 
          alert("Não foi possivel criar\nTente de Novo");

        });
                 
  
        }
         

});

app.controller('auditController', function($scope,$mdDialog,$rootScope,$http) {

   $rootScope.can = false;
   $rootScope.done = false;
             var mono = ['P1','P1-','P1+','Q1','Q1-','Q1+','S1','PF1-','PF1+','Cos f1-','Cos f1+','Tan F-','Tan F+'];
   
             var trif  = ["P1","P2","P3","PT","P1-","P2-","P3-","PT-","P1+","P2+","P3+","PT+","Q1","Q2","Q3","QT","Q1-","Q2-","Q3-","QT-","Q1+","Q2+","Q3+","QT+","S1","S2","S3","ST",
             'PF1-' , 'PF2-' , 'PF3-' , 'PFT-' , 'PF1+' , 'PF2+' , 'PF3+' , 'PFT+',  'Cos f1-' ,'Cos f2-' ,'Cos f3-' ,'Cos fT-' ,'Cos f1+' ,'Cos f2+' ,'Cos f3+' ,'Cos fT+'];
                
    
  $scope.dat=0;
   var typeSystem=''; 
  $scope.file = null;
  $scope.getFile=function($audit){ 
       if (!confirm("Confirmar a  Operação?"))return;
        $http.post("/getFile",{'id':$audit}, {'_token': 'CSRF_TOKEN'}).then(function(response){
         $data = response.data;
         $scope.file = $data;
          worker.postMessage(new Blob([$data],{type : "text/plain"}));//Mandando Dados Para Worker
         switch ($data) {
           case '-1':
             alert("Erro na  Leitura do ficheiro");
             break;
             default:
              $rootScope.can = true;
               

                //console.log($ficheiro);
             var dats = $data.split('\n')[6].split(',').length;

             if (dats==34) {
               typeSystem='Monofasico';
               $scope.options = mono;
             }else {

              typeSystem='Trifasico';
              $scope.options  = trif;

              }
             alert("Ficheiro carregado com Sucesso!");
            // window.location.href ="/audit_res/"+$audit;
             break;
         }
        },function(response){ 
          alert("Não foi possivel a Operação\nComunique ao Administrador");

        });
                 
  
        }
     $scope.loadDatas1= function  ($ficheiro,$campo) { 

var max=0;
var min=0;
var somas=0.0;
var dataMax="";
var dataMin="";
      //console.log($ficheiro);
   var dats = datas[6].split(',').length;

   if (dats==34) {
     if($campo == -1) {$campo=19}
   else {
      $campo = withColumnM($campo);
    }
   }else {
        if($campo == -1) {$campo=63}
   else {
      $campo = withColumn($campo);
      
    }
    }

      
    
    var asr = [];
   
     mydata.interval={};
     mydata.interval_end={};
            var e = $ficheiro;//document.getElementById('fileinput').files[0];
            
            mydata.dados = e;
            //mydata.interval=inver($("#interval_ini").val());
            //mydata.interval_end=inver($("#interval_end").val());
             /*if(document.getElementById('fileinput').files.length==0) {
                document.getElementById("container1").innerHTML="Nenhum Ficheiro Selecionado";
                return;
             }*/
                var ini="";
                var fim="";

                  var sep;
                  var sepTime = (timeIni).split(":") ;
                  timeInis.hora=parseInt(sepTime[0]);
                  timeInis.minuto=parseInt(sepTime[1]);
                  var timesIni = dataIni.split("/");
                   mydata.interval.dia= parseInt(timesIni[0]);
                   mydata.interval.mes= parseInt(timesIni[1]);
                   mydata.interval.ano= parseInt(timesIni[2]);

                  
                 
            if($("#reservationtime").val().length != 0){
                 var  seps = $("#reservationtime").val().split(" - ");

                 ini = seps[0];

                 fim = seps[1];
                      
             }

                /*if(parseInt(k[0])<=9){
                    mydata.interval = mydata.interval.substring(1, mydata.interval.length-1);
                }* */
              var allData=datas;
              var a="";
              
           for (var line in allData) {

             if(line>2 && line<allData.length-1){
             var lines = allData[line].split(",");


            var time = lines[1].split(":");
            
                    
            if ( toDateT(lines[0]+' '+lines[1]) >= toDateT(ini)){
                 var m = [];
                 var val = parseFloat(lines[$campo].trim());
                 if (somas==0) min = val;//Primeira Volta
                 
                 if (val>max)
                  { 
                    max=val;
                    dataMax=lines[0]+" "+lines[1];

                  }

                 else{
                  if (val <= min) {
                         min = val;
                         dataMin=lines[0]+" "+lines[1];
                  }
                 }
                if (val) {
                  somas = somas+val;
                 }                            
                 m.push(Date.UTC(getDayMonthYear(lines[0],3),getDayMonthYear(lines[0],2)-1,getDayMonthYear(lines[0],1),parseInt(time[0]),parseInt(time[1])));
                 m.push(val);
                 asr.push(m);
            }

             if (toDateT(lines[0]+' '+lines[1]) >= toDateT(fim)) break;

          }  
           
        }


        



Highcharts.chart(document.getElementById("container1"), {
            chart: {
                zoomType: 'x',
                type: 'area'
            },
            title: {
                text: 'Dados de Analizador('+typeSystem+')'
            },
            subtitle: {//Segunda Opção Quando For Num Tablete
                text: document.ontouchstart === undefined ?
                        'Clique e arraste na área de plotagem para aumentar o zoom ':' Aperte o gráfico para aumentar o zoom'
            },
            xAxis: {
                   type: 'datetime',
                   dateTimeLabelFormats: {
                   day: '%e de %b'
               }
            },
            yAxis: {
                title: {
                    text: 'Consumo'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

             series: [{
         type: 'area',      
        name:"Consumo",      
        data: asr,
       /* pointStart: Date.UTC(mydata.interval.ano,mydata.interval.mes-1,mydata.interval.dia,timeInis.hora,timeInis.minuto),
        pointInterval:60*1000 // secondli*/
    }]
        });
      // alert(asr.length);
        //alert("Media: "+($somas/(asr.length-1))+"\n"+"Min: "+$min+"\n"+"Max: "+$max+"\nDmax: "+$dataMax+"\nDmin: "+$dataMin);
         $scope.med=(somas/asr.length).toFixed(3);
         $scope.max=max;
         $scope.dmax=dataMax;
         $scope.min=min;
         $scope.dmin=dataMin;
         $rootScope.done = true;
        }

         

});

app.controller('consumoController', function($scope,$mdDialog,$rootScope,$http) {
  $scope.medidor=[];
  $scope.options=["Energia","Pôtencia Máxima","Pôtencia Mínima"];
  $scope.unity=["kWh","Wat","Wat"];
  
   $scope.dat=0;
  
       $scope.saveMedidor=function(){ 
     

        }
         
   $scope.switch=function($dados){ 


 var dats =[];
  var ener = readyData($scope.dat);
 //alert(ener); return;
 for (var i in $dados) {
        //var vet = [equips,parseFloat($dados[i][ener])];
        dats.push({name:"<b>"+$dados[i].data_ini+"-"+$dados[i].data_fim+"</b>",y:parseFloat($dados[i][ener])});
  }




Highcharts.chart(document.getElementById('bar_char'), {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Consumo de Equipamentos'
    },
    subtitle: {
        text: 'Mais Informação Por Vir'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Consumo em '+$scope.unity[$scope.dat]
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y} '+$scope.unity[$scope.dat]
            }
        }
    },

    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> '+$scope.unity[$scope.dat]+'<br/>'
    },

    series: [{
      name: 'Consumo de Equipamentos',
      colorByPoint: true,
      data: dats}
     ],
    });





    /*var bar_data = {
      label:["Dados"],
      data : dats,
      color: "#"+Math.floor(Math.random()*16777215).toString(16),
      clickable: true,
      hoverable: true
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      },
      legend: {
        show: true,
        labelFormatter: function(label, series) {
      // series is the series object for the label
      return '<a href="#' + label + '">' + label + '</a>';
    }       
}
    })
    /* END BAR CHART */


  }
               

});




function readyData($index,$scope){
  switch ($index) {
     case 0:
      return "energia";
      break;
    
    case 1:
      return "pot_max";
      break;
    
    case 2:
      return "pot_min";
      break;
    default:
      // statements_def
      break;
  }
       
      }

      function withColumn($index){
        return $index + 63;
      }

      function withColumnM($index){
        return $index + 19;
      }




  

// Try HTML5 geolocation.
function getCurrentLocation(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
             alert("Localização Encontrada");
             $("#loc").val(pos.lat+","+pos.lng);
          });

        }
        else {
          alert("Browser Incapacitado a encotrar Geolocalização");
        }
      }

function getDayMonthYear(stringData,pos){
    var ret = stringData.split("/");
    switch (pos)
     {
        case 1:
            return parseInt(ret[0]);
            break;
        case 2:
            return parseInt(ret[1]);
            break;
        case 3:
            return parseInt(ret[2]);
            break;        
        default:
            return -1;
            break;
    }
    
}

function type(obj) {
    return Object.prototype.toString.call(obj).replace(/^\[object (.+)\]$/,"$1").toLowerCase()
}

   

 app.controller('usermanage', function($scope, $rootScope ,$mdToast, $mdDialog) {

   $scope.showCustomToast = function() {
        $mdToast.show({
          hideDelay   : 9000,
          position    : 'bottom right',
          controller  : 'ToastCtrl',
          template : '<md-toast class="mtoast" ><span class="md-toast-text" flex>Alteracão Sussedida</span><md-button ng-click="closeToast()"> Fechar </md-button></md-toast>'
        });
      };

 $scope.setState = function($estate,$userId){

      ajaxPost('/userChange',{user:$userId,bool:$estate?1:0,op:'estado'}); 

 }
 $scope.setCanLog = function($canLog,$userId){

   ajaxPost('/userChange',{user:$userId,bool:$canLog?1:0,op:'canLog'});

  }

 });














    app.controller('uploadfile', function($scope, $rootScope ) {


 
var percent = $('.percent');
$scope.pers=10;   
$('#mf').ajaxForm({
    
    forceSync:true,
    beforeSend: function() {
        var percentVal = '0%';
        $("#mb").css({"width":percentVal});
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        $("#mb").css({"width":percentVal});
        percent.html(percentVal);
    },
    success: function(data, statusText, xhr) {
        var percentVal = '100%';
         $rootScope.can=false;
         percent.css("color","#FFF");
         
         var validator = parseInt(xhr.responseText);
         if (validator==1) {
           alert('Erro no Upload, contacte o Administrador');
         } 
         else {
          if (validator==-1) {
             alert('Erro no Upload, Ficheiro não Suportado');
          } else {
             alert(xhr.responseText);
            window.location.href =/audit_res/+$('#mid').val();
          }
         }

         return false;
                  //alert($rootScope.can);
        
        
        //$rootScope.can=false;
        
    },
    error: function(xhr, statusText, err) {
        //$('#status').html(err || statusText);
    }
}); 
     
    });
    var isDlgOpen = false;
    app.controller('ToastCtrl', function($scope, $mdToast, $mdDialog) {

      $scope.closeToast = function() {
        if (isDlgOpen) return;

        $mdToast
          .hide()
          .then(function() {
            isDlgOpen = false;
          });
      };

      $scope.openMoreInfo = function(e) {
        if ( isDlgOpen ) return;
        isDlgOpen = true;

        $mdDialog
          .show($mdDialog
            .alert()
            .title('More info goes here.')
            .textContent('Something witty.')
            .ariaLabel('More info')
            .ok('Got it')
            .targetEvent(e)
          )
          .then(function() {
            isDlgOpen = false;
          });
      };
    });

    function ajaxPost($location, $data){
         $('#successM').removeClass('succsessAlert');        
                  $.ajax({
            url: $location,
            method: "POST",
            data: $data
            }).done(function(response) {
                  document.getElementById("successM").style.display = "block";
                 $('#successM').addClass('succsessAlert');
                 return response;
             }).fail(function (error) {
               //$(this).remove();
               alert("Erro de Comunicação com Servidor");
               return -1;
             
              });
    }
    function ajaxGet($location, $data){        
                  $.ajax({
            url: $location,
            method: "GET",
            data: $data
            }).done(function(response) {
                 return response;
             }).fail(function (error) {
               //$(this).remove();
               alert("Erro de Comunicação com Servidor");
               return -1;
             
              });
    }
    
    


   function resetForm(){
       $("#mfile").val('');
       $('.percent').html("0%");
       $("#mb").css({"width":"0%"});
       $("#mb").css({"color":"black"});     


     }


     function submitForms($idAudit,$medicao,$addOrAlter,$cini){
      

      
       var $data = document.getElementsByClassName("form_consumo");
       if (parseInt($("#cfim").val())<parseInt($cini)) {
          alert('Valor de fim de Contador Inválido');
          return;
      }
       if($addOrAlter){
        ajaxPostForm($idAudit,$medicao,$data,{
              dini:$("#dini").val(),
              hini:$("#hini").val(),
              dfim:$("#dfim").val(),
              hfim:$("#hfim").val(),
              cini:$("#cini").val(),
              cfim:$("#cfim").val(),
              tligado:$("#tligado").val(),
              dligado:$("#dligado").val()
            },"Guardado");      
       }
else {

        ajaxPostForm($idAudit,$medicao,$data,{},"Atualizado");
         
      }
     }

     

     function ajaxPostForm($idAudit,$medicao,$data,$dados,$msm){
           var c=0;          
           for (var i = 0; i < $data.length; i++) { 
          $($data[i]).ajaxSubmit({
            data:$dados,
            forceSync:true,  
            success: function(data, statusText, xhr) {
                 c++;
                if (c==$data.length) {
                  alert($msm);
                  window.location.href ="/consumos/"+$idAudit+"/"+$medicao;

              }
            },
            error: function(xhr, statusText, err) {
               //alert("Erro");
                alert("Erro: Contacte o Administrador de Sistema");
                //$('#status').html(err || statusText);
            }
     }); 
      }
     }
 
 function toDateT($data1){
      //Formato Ano/mes/dia 
      $as = $data1.split(' ');
      $as1 = $as[0].split('/');
      $a1 = new Date($as1[2]+'-'+$as1[1]+'-'+$as1[0]+' '+$as[1]);
      return $a1;
 }

 function setState($estate,$userId){

  ajaxPost('/userChange',{user:$userId,bool:$estate?1:0,op:'estado'}); 

 }
 function setCanLog($canLog,$userId){

   ajaxPost('/userChange',{user:$userId,bool:$canLog?1:0,op:'canLog'});

}

 function changePermission($state,$tipouserId,$idPermission){

   ajaxPost('/tipouserChangePermission',{user:$tipouserId,bool:$state?1:0,idPermission:$idPermission});

  
}
function changeLn(){
  
  $('#ln_form').ajaxSubmit({
            success: function(data, statusText, xhr) {
              location.reload(true); //true para forcar atualizar do servidor nao do cache
           },
            error: function(xhr, statusText, err) {
               //alert("Erro");
                alert("Erro: Contacte o Administrador de Sistema");
                //$('#status').html(err || statusText);
            }
     });

}



    