<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            'cpf' => ['required', 'unique:usuarios', new Cpf],
            'usuario' => 'required|min:5|max:30',
            'nome' => 'required|min:5|max:100',
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
            'cpf.required' => 'O CPF é obrigatório',
            'cpf.unique' => 'O CPF já está cadastrado',
            'usuario.required' => 'O usuário é obrigatório',
            'usuario.min' => 'O usuário deve ter no mínimo :min caracteres',
            'usuario.max' => 'O usuário deve ter no máximo :max caracteres',
            'nome.required' => 'O nome é obrigatório',
            'nome.min' => 'O nome deve ter no mínimo :min caracteres',
            'nome.max' => 'O nome deve ter no máximo :max caracteres',
        ];
    }
}
