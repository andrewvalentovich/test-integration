<?php


namespace App\Http\Controllers\Lead;


use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreRequest;
use App\Models\Lead;

class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        // При подстановке такого же номера телефона для нового лида но с другим индексом (+7 вместо 8 и наоборот) создастся лид.
        $lead = Lead::firstOrCreate(['phone' => $data['phone'], 'email' => $data['email']], $data);


        dd($lead);
    }
}