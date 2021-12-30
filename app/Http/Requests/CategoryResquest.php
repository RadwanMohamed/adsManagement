<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryResquest extends FormRequest
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
        $rules = [];
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'title' => "required|string",
                    'description' => 'required|min:3|max:1000'
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'title' => "nullable|string",
                    'description' => 'nullable|min:3|max:1000'
                ];
                break;
        }
        return  $rules;

    }
}
