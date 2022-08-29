<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Agenda_FablabEditRequest extends FormRequest
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
				"titulo" => "nullable|string",
				"data_inicio" => "nullable|date",
				"hora_inicio" => "nullable",
				"data_termino" => "nullable|date",
				"hora_termino" => "nullable",
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
