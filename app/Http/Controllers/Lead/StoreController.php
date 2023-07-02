<?php


namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreRequest;
use App\Http\Services\Bitrix\CreateLead;
use App\Http\Services\Telegram\Bot;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        // Отправляем запрос на сервер Bitrix24 и получаем ответ в $response
        $response = CreateLead::sendRequest("GET", "crm.lead.add", $data);

        // Если нет ошибок - в $responce получаем false и выполняем сценарий ниже
        if(is_integer($response)) {
            $data['birth_day'] = Carbon::parse($data['birth_day']);

            // *при подстановке такого же номера телефона для нового лида но с другим индексом (+7 вместо 8 и наоборот) создастся лид
            $lead = Lead::firstOrCreate(['phone' => $data['phone'], 'email' => $data['email']], $data);
            Bot::sendMessage(
                "Создан лид " . CreateLead::getLinkCrmDealDetails($response) . "\n".
                "Имя: {$lead['name']}\n".
                "Фамилия: {$lead['surname']}\n".
                "Отчество: {$lead['patronymic']}\n".
                "День рождения: {$lead['birth_day']}\n".
                "Телефон: {$lead['phone']}\n".
                "Почта: {$lead['email']}\n".
                "Комментарий: {$lead['comment']}\n"
            );
        } elseif (is_string($response)) {
            Bot::sendMessage("Ошибка создания лида: " . $response);
        } else {
            Log::error("Не строка и не число в App\Http\Controllers\Lead __invoke()", [
                'error' => true,
                'line' => 44
            ]);
        }

        return redirect()->route('lead.create');
    }
}
