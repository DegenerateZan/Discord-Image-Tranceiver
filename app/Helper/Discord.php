<?php

namespace App\Helper;

use Discord\Builders\MessageBuilder;
use Discord\Parts\Channel\Message;
use Discord\Parts\Guild\Guild;
use Discord\Parts\Channel\Channel;

use function React\Async\await;

class Discord
{
    public static function SendImage($filePath)
    {
        global $discordService;
        /** @var Guild*/
        $guild = await($discordService->discord->guilds->fetch($_ENV["GUILD_ID"]));
        /** @var Channel */
        $channel = await($guild->channels->fetch($_ENV["CHANNEL_ID"]));

        $builder = new MessageBuilder();
        $builder->addFile($filePath);

        /** @var Message */
        $messageResult = await($channel->sendMessage($builder));
        return $messageResult->attachments->first()->url;
    }
}