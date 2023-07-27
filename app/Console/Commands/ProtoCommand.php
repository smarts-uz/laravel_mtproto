<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\MTProtoService;

class ProtoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proto:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $MTProto = new MTProtoService();
        $MTProto->handler();
    }
}
