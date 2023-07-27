<?php

namespace App\Service;

use danog\MadelineProto\API;
use App\Http\Controllers\ProtoController;
use App\Http\Controllers\MessageController;
use danog\MadelineProto\Settings;


class MTProtoService
{

    public $MadelineProto;
    public $settings;
    public function __construct()
    {
    $this->settings = new Settings();
    $this->settings->setAppInfo((new Settings\AppInfo())->setApiId((int)env('API_ID'))->setApiHash(env('API_HASH')));
    $this->MadelineProto = new API(env('SESSION_PATH'). '/session.madeline', $this->settings);
    $this->MadelineProto->start();
    }

    public function handler(): void
    {
       MessageController::startAndLoop(env('SESSION_PATH'). '/session.madeline', $this->settings);
        // ProtoController::startAndLoop(env('SESSION_PATH'). '/session.madeline', $this->settings);
    }

}
