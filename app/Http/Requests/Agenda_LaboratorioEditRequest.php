<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Agenda_LaboratorioEditRequest extends FormRequest
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
            
				"confirmacao" => "nullable",
				"titulo" => "filled|string",
				"numero_pessoas" => "filled|numeric|max:20",
				"data_inicio" => "filled|date",
				"hora_inicio" => "filled",
				"data_termino" => "filled|date",
				"hora_termino" => "filled",
				"observacoes" => "nullable",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
