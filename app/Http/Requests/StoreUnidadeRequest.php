<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnidadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'empresa_id' => 'required|exists:App\Empresa,id',
            'municipio' => 'required|min:5|max:100',
            'email' => 'nullable|email|min:5|max:100',
            'logomarca' => 'nullable|image',
            'tipo' => 'required|in:0,1,2,3',
            'status' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'municipio.required' => 'O município é obrigatório',
            'municipio.min' => 'O município deve ter no mínimo :min caracteres',
            'municipio.max' => 'O município deve ter no máximo :max caracteres',
            'email.email' => 'O e-mail deve ser válido',
            'email.min' => 'O e-mail deve ter no mínimo :min caracteres',
            'email.max' => 'O e-mail deve ter no máximo :max caracteres',
            'logomarca.image' => 'A logomarca deve ser um arquivo de imagem',
            'tipo.required' => 'O tipo é obrigatório',
            'tipo.in' => 'O tipo é inválido',
            'status.required' => 'O status é obrigatório',
            'status.boolean' => 'O status deve ser ativou ou inativo',
        ];
    }
}
