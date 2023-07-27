<?php

namespace App\Http\Controllers;

use danog\MadelineProto\EventHandler;
use Illuminate\Http\Request;

class StartController extends EventHandler
{
    public function checkfarsi($string){
        if(preg_match("/[0-9a-zA-Z]+/i", $string)){
            return "en";
        }else{
            return "fa";
        }
    }
    function we($typew){
        if($typew == "Clear"){
            return "آفتابی☀";
        }
        elseif($typew == "Clouds"){
            return "ابری ☁☁";
        }
        elseif($typew == "Rain"){
             return "بارانی ☔";
        }
        elseif($typew == "Thunderstorm"){
            return "طوفانی ☔☔☔☔";
        }
        elseif($typew == "Mist"){
            return "مه 💨";
        }
    }

    
}
