<?php

namespace App\Service;

use Discord\Discord;
use Discord\WebSockets\Intents;
use React\EventLoop\LoopInterface;

class DiscordService
{
    public Discord $discord;

    public bool $isInitialized;

    public function __construct(LoopInterface $loop)
    {
        $this->discord =  new Discord([
            'token' => $_ENV["BOT_TOKEN"],
            'loop' => $loop,
            'intents' => Intents::getDefaultIntents()
             | Intents::MESSAGE_CONTENT, // Note: MESSAGE_CONTENT is privileged, see https://dis.gd/mcfaq
        ]);
    }

    public function initialize(){
        $this->discord->on("init", function(Discord $discord){
            $this->discord;
            $this->isInitialized = true;
        });
    }


}