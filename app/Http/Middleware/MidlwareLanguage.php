<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;

class MidlwareLanguage {

   public function __construct(Application $app, Request $request){
    $this->app = $app;
   	$this->request=$request;
   }
   public function handle($request, Closure $next){
   
   		$this->app->setLocale(Session::get('applocale'));

   		return $next($request);

   }


}
