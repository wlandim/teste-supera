<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'razao_social' => 'required|min:5|max:100',
            'nome_fantasia' => 'required|min:5|max:100',
            'email' => 'nullable|email|min:5|max:100',
            'logomarca' => 'nullable|image',
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
            'razao_social.required' => 'A razão social é obrigatória',
            'razao_social.unique' => 'A razão social já está cadastrada',
            'razao_social.min' => 'A razão social deve ter no mínimo :min caracteres',
            'razao_social.max' => 'A razão social deve ter no máximo :max caracteres',
            'nome_fantasia.required' => 'O nome fantasia é obrigatório',
            'nome_fantasia.unique' => 'O nome fantasia já está cadastrado',
            'nome_fantasia.min' => 'O nome fantasia deve ter no mínimo :min caracteres',
            'nome_fantasia.max' => 'O nome fantasia deve ter no máximo :max caracteres',
            'email.email' => 'O e-mail deve ser válido',
            'email.min' => 'O e-mail deve ter no mínimo :min caracteres',
            'email.max' => 'O e-mail deve ter no máximo :max caracteres',
            'logomarca.image' => 'A logomarca deve ser um arquivo de imagem',
            'status.required' => 'O status é obrigatório',
            'status.boolean' => 'O status deve ser ativou ou inativo',
        ];
    }
}
