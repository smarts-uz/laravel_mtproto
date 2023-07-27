<?php

namespace App\Http\Controllers;

use danog\MadelineProto\EventHandler;
use Illuminate\Http\Request;

class MessageController extends EventHandler
{


    public function onUpdateNewMessage(array $update )
    {
        if ($update['message']['_'] === 'messageEmpty' || $update['message']['out'] ?? false) {
            return;
        }

        switch($update['message']['message']){
            case 'hello':
            $this->messages->sendMessage(['peer'=>$update, 'message'=>'Hi!']);
        }
        
        if (strpos($update['message']['message'], 'newgroup')===+1 and in_array($update['message']['message'][0], ['/', '.'])) {
            if (!isset(explode(' ', $update['message']['message'], 2)[1])) {
                $title = 'New Group - Userbot';
            } else {
                $title = explode(' ', $update['message']['message'], 2)[1];
            }
            try {
                $group = $MadelineProto->channels->createChannel(['megagroup' => true, 'title' => $title, 'about' => '']);
                $text = "➕ <b>New Group Created</b>";
                $text .= "\n💭 <b>Title:</b> ".htmlspecialchars($title);
                if (isset($group['updates'][1]['channel_id'])) {
                    try {
                        $link = $MadelineProto->messages->exportChatInvite(['peer' => '-100'.$group['updates'][1]['channel_id']])['link'];
                    } catch (Exception $e) {
                    }
                    if ($link) {
                        $text .= "\n🔗 <b>Invite Link:</b> <a href='".$link."'>here</a>";
                    }
                }
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $text, 'parse_mode' => 'html', 'reply_to_msg_id' => $update['message']['id'], 'disable_web_page_preview' => true]);
            } catch (\danog\MadelineProto\RPCErrorException $e) {
                $text = "⚠️ <b>Error:</b> <code>".htmlspecialchars($e->rpc)."</code>";
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $text, 'parse_mode' => 'html', 'reply_to_msg_id' => $update['message']['id']]);
            } catch (Exception $e) {
                $text = "⚠️ <b>Error:</b> <code>".htmlspecialchars($e->getMessage())."</code>";
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $text, 'parse_mode' => 'html', 'reply_to_msg_id' => $update['message']['id']]);
            }
        }
    }
    
}
