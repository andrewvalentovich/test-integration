<?php


namespace App\Http\Services\Bitrix;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class CreateLead
{
    /**
     * Функция generateQuery возвращает параметры запроса
     * @param array $data
     * @return array
     */
    public static function generateQuery(array $data)
    {
        return [
            "fields" => [
                "NAME" => $data['name'],
                "SECOND_NAME" => $data['surname'],
                "LAST_NAME" => $data['patronymic'],
                "BIRTHDATE" => $data['birth_day'],
                "ASSIGNED_BY_ID" => 1,
                "PHONE" => [ [ "VALUE" => $data['phone'], "VALUE_TYPE" => "WORK" ] ],
                "EMAIL" => [[ "VALUE" => $data['email'], "VALUE_TYPE" => "WORK" ] ],
                "COMMENTS" => $data['comment']
            ],
            "params" => ["REGISTER_SONET_EVENT" => "Y"]
        ];
    }

    /**
     * @param string $method
     * @param string $crm_func
     * @param array $data
     * @return string|int
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendRequest($method, $crm_func, array $data)
    {
        $client = new Client();
        $url = env('CLIENT_REST_WEB_HOOK_URL') . $crm_func . '.json'; // Формируем url для отправки запроса

        try {
            // Отправляем запрос
            $response = $client->request($method, $url, [
                "query" => static::generateQuery($data)
            ]);
        } catch (ClientException $e) { // Ловим ошибки 4хх
            $error = "Ошибка {$e->getResponse()->getStatusCode()} {$e->getResponse()->getReasonPhrase()} при создании лида!";
            Log::error($error . " Cработало исключение в Services/Bitrix/CreateLead callRequest()", [
                'error' => true,
                'line' => 60
            ]);
        }

        // Возвращаем id лида, если всё хорошо, или возвращаем $error, если словили искоючение
        return isset($error) ? $error : json_decode($response->getBody()->getContents())->result;
    }

    /**
     * @param $id
     * @return string
     */
    public static function getLinkCrmDealDetails($id)
    {
        $concrete = 'crm/deal/details/';
        return env('CRM_BITRIX_URL') . $concrete . $id . '/';
    }


}
