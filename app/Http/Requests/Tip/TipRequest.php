<?php

namespace App\Http\Requests\Tip;

use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
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
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_for_all_versions' => empty($this->version) ? true:false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'model_id' => 'required|integer',
            'is_for_all_versions' => 'sometimes|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'title.min' => 'O campo título deve ter no mínimo 5 caracteres.',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.min' => 'O campo descrição deve ter no mínimo 5 caracteres.',
            'description.max' => 'O campo descrição deve ter no máximo 255 caracteres.',
            'model_id.required' => 'O campo modelo é obrigatório.',
            'model_id.integer' => 'O campo modelo deve ser um número inteiro.'
        ];
    }
}
