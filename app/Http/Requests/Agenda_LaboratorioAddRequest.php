<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Agenda_LaboratorioAddRequest extends FormRequest
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
            
				"titulo" => "required|string",
				"numero_pessoas" => "required|numeric|max:20",
				"data_inicio" => "required|date",
				"hora_inicio" => "required",
				"data_termino" => "required|date",
				"hora_termino" => "required",
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
