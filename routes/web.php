<?php


use Illuminate\Support\Facades\App;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/','UserController@goHome');
Route::get('/login', function () {
    return view('auth.login');
});



Route::get('/lnchange/{locale}','UserController@lnchange');

Route::post('/addFatura','UserController@addFatura');

Route::get('/getFaturas/{id}','UserController@getFaturas');

Route::get('/editld/{id}','UserController@editEquipLD');

Route::get("/getTasks",'UserController@getTasks');

Route::get("/getLogs",'UserController@getDaysLogs');

Route::get("/log", function () {
    if(User::isAdmin(Auth::user())) return view('log');
    
});
Route::post('/loginu','UserController@lg');


Route::post('/editELD','UserController@editELD');

Route::post('/tipouserChangePermission','UserController@tipouserChangePermission');

Route::post('/userChange','UserController@userChange');


Route::post('/getEI','UserController@getEI');

Route::post('/edtiuser','UserController@edtiuser');

Route::post('/audit/update','UserController@edtiaudit');
  
Route::get('/perfil','UserController@perfil');

Route::get('/audit/edit/{id}','UserController@edit_audit');

Route::get('/users_manage','UserController@goToUsers');

Route::get('/c_auditoria', function () {
	if(! Auth::user())  return  view('auth.login');
    return view('create_audit');
});
Route::get('/c_auditoria/{id}','UserController@audit_cli');

Route::get('/c_eq_ld', function () {
	if(! Auth::user())  return  view('auth.login');
    return view('create_eq_ld');
});
Route::get('/c_cliente', function () {
	if(! Auth::user())  return  view('auth.login');
    return view('create_cliente');
});

Route::get('/equip_ld', function () {
	if(! Auth::user())  return  view('auth.login');
    return view('equip_ldomestico');
});

Route::get('/equip_instalacao', function () {
    if(! Auth::user())  return  view('auth.login');
    return view('equip_instalacao');
});



Route::get('/auditorias', function () {
	if(! Auth::user())  return  view('auth.login');
    return view('auditorias');
});

Route::get('/getCliente','UserController@getCliente');

Route::get('/clientes', function () {
	if(! Auth::user())  return  view('auth.login');
    return view('clientes');
});

Auth::routes();

Route::get('/home', 'UserController@goHome');



Route::get('/audit_res/{id}', 'UserController@audit_res');

Route::get('/mpdf', 'UserController@mpdf');

Route::get('delete/cliente/{id}', 'UserController@desableCli');
Route::get('auditoria/apagar/{id}', 'UserController@delAudit');


Route::post('/alterevent', 'UserController@alterevent');

Route::post('/addEvent', 'UserController@addEvent');

Route::post('/nofificar', 'UserController@nofificarEvento');

Route::post('/addTipoEvent', 'UserController@addTipoEvent');

Route::post('/addEI', 'UserController@addEI');

Route::post('/getFile', 'UserController@theFile');

Route::get('/consumos/{idReg}/{idCon}', 'UserController@consumos');

Route::get('/medicao/{idAuditoria}/{idMedicao}', 'UserController@medicao');

Route::get('/edit_prop/{id}', 'UserController@edit_prop');

Route::get('/cliente/detalhes/{id}', 'UserController@c_detalhes');


Route::post('concluir', 'UserController@concluir');

Route::post('retomar', 'UserController@retomar');

Route::post('/adicionar_utilizaor', 'UserController@usercreate');

Route::post('/addAudit', 'UserController@addAudit');

Route::post('/addMedida', 'UserController@addMedida');

Route::post('/addCliente', 'UserController@addCliente');

Route::post('/editCliente', 'UserController@editCliente');


Route::post('/addProp', 'UserController@addPropriedade');

Route::post('/saveFile', 'UserController@store');



Route::post('/setPermission', 'UserController@setPermission');

Route::post('/editPermission', 'UserController@editPermission');



Route::post('/addEquipLD', 'UserController@addEquipLD');

Route::post('/addCompart', 'UserController@addComp');

Route::post('/addFEquipLD', 'UserController@addFEquipLD');

Route::post('/addMedicao', 'UserController@addMedicao');

Route::post('/editMedida', 'UserController@editMedida');

Route::post('/addRegisto', 'UserController@addRegisto');

Route::post('/addConsumo', 'UserController@addConsumo');

Route::post('/deleteEvent', 'UserController@deleteEvent');

Route::post('/deleteTipoEvent', 'UserController@deleteTipoEvent');