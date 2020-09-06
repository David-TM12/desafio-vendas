<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FabricanteRequest extends FormRequest
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
        return [
            "nome" => "required|string",
            "site" => "required|url"
        ];
    }

    public function messages(){
       
       return  [
            'required' => 'Este campo é obrigatório',
            'url' => 'informe uma url valida neste campo Ex: http://meusite.com.br'
        ];

    }
}
