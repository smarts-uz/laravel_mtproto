<?php

namespace App\Http\Controllers;

use danog\MadelineProto\EventHandler;
use Illuminate\Http\Request;

class ProtoController extends EventHandler
{


    public function onUpdateNewMessage(array $update){

        if ($update['message']['_'] === 'messageEmpty' || $update['message']['out'] ?? false) {
            return;
        }

        switch($update['message']['message']){
            case 'hello':
            $this->messages->sendMessage(['peer'=>$update, 'message'=>'Hi!']);
            default:
                $this->messages->sendMessage(['peer'=>$update, 'message'=>$update['message']['message']]);


        }

    }
}
