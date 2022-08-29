<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComprasEditRequest extends FormRequest
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
            
				"urgencia" => "nullable",
				"objeto" => "nullable|string",
				"valor" => "nullable|numeric",
				"data" => "nullable|date",
				"observacoes" => "nullable",
				"justificativa" => "nullable",
				"status" => "nullable",
            
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
