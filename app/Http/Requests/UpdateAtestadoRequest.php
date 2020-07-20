<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAtestadoRequest extends FormRequest
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
            'paciente_id' => 'required|exists:App\Paciente,id',
            'acompanhante_id' => 'required|exists:App\Acompanhante,id',
            'obito_id' => 'required|exists:App\Obito,id',
        ];
    }
}
