<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class SimulationSimulateFormRequest extends FormRequest
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
            'valor_emprestimo' => 'required|numeric|min:1',
            'instituicoes'     => 'sometimes|nullable|array',
            'convenios'        => 'sometimes|nullable|array',
            'parcela'          => 'sometimes|nullable|integer|min:0'
        ];
    }

    /**
     * Get the messages to apply to the validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Campo obrigatório.',
            'array'    => 'Escolha uma ou mais opções.',
            'numeric'  => 'Digite um valor numérico.',
            'integer'  => 'Digite um número inteiro.',
            'min'      => 'Valor mínimo aceito: :min'
        ];
    }
}
