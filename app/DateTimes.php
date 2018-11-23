<?php

namespace App;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class DateTimes 
{
    public  static function differ2Time($data1,$data2){

       return DateTimes::diffTimeMaster(new DateTime($data1),new DateTime($data2));
    }

    public  static function differTime($data){

    	$start_date = new DateTime($data);
        $end_date = new DateTime((new DateTime())->format('Y-m-d'));
		return DateTimes::diffTimeMaster($start_date,$end_date);

    }


  public  static function differTimeA($data){

      $start_date = new DateTime($data);
        $end_date = new DateTime((new DateTime())->format('Y-m-d'));

     $since_start = $start_date->diff($end_date);

            if($since_start->y <1 ){
                    if($since_start->m <31 ){
                
                       if($since_start->days <1 ){
                
                                  return 'Hoje';        
                       }
                       else{
                            
                             return ($since_start->days).($since_start->days==1?' dia':' dias');//.$since_start->h.' h';
                       }

                   }
                   else{

                       return $since_start->m.' mêses e'.$since_start->days.' dias';
                   }
            }else{
                return $since_start->y.' ano e '.($since_start->m==0?(((new DateTime($start_date->format("Y-m-0")))->diff($start_date)->d)).' dias':$since_start->m.' mêses');
            }

    }








    public  static function smallerThan($data1){

        $start_date = new DateTime($data1);
        $end_date = new DateTime((new DateTime())->format('Y-m-d'));
        return   $start_date < $end_date;

    }
     public  static function date($data,$withTime){
            
     	     if ($withTime!=0) {
     	     	  $dat = new DateTime($data);
     	     	  return $dat->format("d/m/Y h:i:s");
     	     }

     	          $dat = new DateTime($data);
     	     	  return $dat->format("d/m/Y");

    }
     public  static function datel($data){
            
              $dat = new DateTime($data);
              return $dat->format("Y-m-d");

    }

    public  static function diffday($data){
            
     	   	   $dat = new DateTime($data);
               $dat1 = new DateTime();
               if ($dat->format("d/m/Y") == $dat1->format("d/m/Y") ) {
                   return $dat1->diff($dat)->days;
               }
     	       return $dat1->diff($dat)->days+1;

    }

    public  static function diffDate($data){
            
     	   	   $dat = new DateTime();
     	       return $dat->diff( new DateTime($data));

    }

    public  static function now(){
            
     	  
     	     	  $dat = new DateTime();
     	     	  return $dat->format("d-m-Y H:i");

     	    }
    public  static function time($data){
            
     	  
     	     	  $dat = new DateTime($data);
     	     	  return $dat->format("H:i");

     	    } 	
     public  static function todayLarFormat(){
            
     	  
     	     	  $dat = new DateTime();
     	     	  return $dat->format("Y-m-d");

     	    } 

    private static function diffTimeMaster($start_date,$end_date){

        $since_start = $start_date->diff($end_date);

            if($since_start->y <1 ){
                    if($since_start->m <31 ){
                
                       if($since_start->days <1 ){

                        if($since_start->h <1 ){
                
                                if($since_start->i <1 ){
                
                                  return $since_start->s.($since_start->s==0?' segundo':' segundos');             
                
                       }
                       else{
                          return $since_start->i.' mins';
                       }
                
                       }else{

                         return $since_start->h.'h'.$since_start->i.' mins';

                       }
                                        
                       }
                       else{
                            if ($start_date->format("d/m/Y") == $end_date->format("d/m/Y")) {
                              return ' hoje';
                            } 
                             return ($since_start->days).($since_start->days==1?' dia':' dias');//.$since_start->h.' h';
                       }

                   }
                   else{

                       return $since_start->m.' mêses e'.$since_start->days.' dias';
                   }
            }else{
                return $since_start->y.' ano e '.($since_start->m==0?(((new DateTime($start_date->format("Y-m-0")))->diff($start_date)->d)).' dias':$since_start->m.' mêses');
            }
    }        	 	        
}


