<?php


namespace App\Http\Controllers\Lead;


use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreRequest;
use App\Http\Services\Bitrix\CreateLead;
use App\Models\Lead;
use Carbon\Carbon;

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
        if(!$response) {
            $data['birth_day'] = Carbon::parse($data['birth_day']);
            // При подстановке такого же номера телефона для нового лида но с другим индексом (+7 вместо 8 и наоборот) создастся лид.
            Lead::firstOrCreate(['phone' => $data['phone'], 'email' => $data['email']], $data);
        }

    }
}
