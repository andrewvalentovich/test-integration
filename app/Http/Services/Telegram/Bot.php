<?php


namespace App\Http\Services\Telegram;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class Bot
{
    /**
     * @param $message
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendMessage($message)
    {
        $client = new Client();

        try {
            $client->request(
                'GET',
                "https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN')
                ."/sendMessage?chat_id=" . env('TELEGRAM_BOT_CHAT_ID')
                ."&text=" . urlencode($message)
            );
        } catch (ClientException $e) { // Ловим ошибки 4хх
            Log::error("Ошибка {$e->getResponse()->getStatusCode()} {$e->getResponse()->getReasonPhrase()} при отправке сообщения App\Http\Services\Telegram sendMessage()", [
                'error' => true,
                'line' => 60
            ]);
        }
    }
}
