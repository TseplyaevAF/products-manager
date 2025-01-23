<?php

namespace App\Http\Requests\Product;

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
     * @return array
     */
    public function rules()
    {
        $this;
        return [
            'article' => 'required|string|regex:/^[a-zA-Z0-9 ]+$/|unique:products,article',
            'name' => 'required|string|min:10',
            'status' => 'nullable',
            'videoram' => 'nullable|string',
            'ram_type' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'article.required' => 'Поле "Артикул" является обязательным',
            'article.regex' => 'Поле "Артикул" должно содержать только латинские символы и цифры',
            'article.unique' => 'Поле "Артикул" должно быть уникальным',
            'name.required' => 'Поле "Название" является обязательным',
            'name.min' => 'Поле "Название" должно быть длиной не менее 10 символов',
        ];
    }
}
