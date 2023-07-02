<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'birthDay' => 'required|date',
            'phone' => ['required' , 'regex:/^(\+7|8)\d{3}\d{3}\d{2}\d{2}$/'],
            'email' => 'required|unique:leads',
            'comment' => 'nullable|max:512',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Данное поле является обязательным для заполнения',
            'name.max' => 'Превышено максимальное количество символов (255)',
            'surname.required' => 'Данное поле является обязательным для заполнения',
            'surname.max' => 'Превышено максимальное количество символов (255)',
            'patronymic.required' => 'Данное поле является обязательным для заполнения',
            'patronymic.max' => 'Превышено максимальное количество символов (255)',
            'birthDay.required' => 'Данное поле является обязательным для заполнения',
            'phone.required' => 'Данное поле является обязательным для заполнения',
            'phone.regex' => 'Введите номер телефона в следующем формате 89991231212 или +79991231212',
            'phone.unique' => 'Лид с таким номером телефона уже существует',
            'email.required' => 'Данное поле является обязательным для заполнения',
            'email.unique' => 'Лид с таким адресом электронной почты уже существует',
            'comment.max' => 'Превышено максимальное количество символов (512)',
        ];
    }

}
