<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" media="print" href="admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <style>
    .img{
    height: 28px;
    width: 130px;
    position: absolute;
    float: right;
    }
    .header{
    margin-top:3.2%;
    width: 100%;
    border-bottom: 1px solid green;
    }
    #tit{
    display: inline-block;
    position: absolute;
    }
    .col1{
    margin-left:16px;
      margin-top:13px;
    border: 1px solid grey;
    width:40%;
    height:200px;
    }
    .col2{
    margin-top:6px;
    margin-left:16px;
    margin-right:16px;
    }
    .col3{
    margin-left:16px;
    margin-top:2%;
    margin-right:16px;
    }
        .col4{
    margin-left:16px;
    margin-top:2%;
    margin-right:16px;
    }
    .pieContainer{
    margin-right:auto;
      margin-top:3%;
    border-bottom: 1px solid grey;
    border-left: 1px solid grey;
    width:50%;
    height:200px;
    }
    .pieObs{
    margin-right:auto;
    float:right;
    position:fixed;
      margin-top:-200px;
    width:25%;
    height:100px;
    }
    
    
    </style>
  </head>
  <body>
    <img class="img pull-right" src="img/logo.png"  alt="" />
    <div class="header">
      <div>
        <p id="tit" >Auditoria Energetica Habitacional</p>
      </div>
    </div>
    
    <div class="row">


      <div class="col1">
        dsfsdf
      </div>

      <div class="col2">

        <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Consumo</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach(App\Equipamento::all() as $eq)
                    <tr>
                      <td>{{$eq->nome}}</td>
                      <td>{{$eq->consumo}}</td>
                    </tr> 
                   @endforeach
                   
                  </tbody>
                </table>
        {{$user}}
      </div>
      <div class="col3">
        Lista de Equipamentos Medidos
      </div>
      <div class="col4">
        <p  class="text-primary text-center">Destribuição de Consumo por Equipamemto</p>
        <div class="pieContainer">
          
        </div>
        <div class="pieObs">
          <p id="on">Observacao</p>
        </div>
        
      </div>
      <div style="margin-top:16%;">
        <div class="col4">
          <p class="text-primary text-center">Destribuição Empresa Fornecedora</p>
          <div class="pieContainer">
            
          </div>
          <div class="pieObs">
            Observacao
          </div>
          
        </div>
      </div>
      
      </div>
      </body>

    </html>