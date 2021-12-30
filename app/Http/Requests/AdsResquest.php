<?php

namespace App\Http\Requests;

use App\Models\Ads;
use Illuminate\Foundation\Http\FormRequest;

class AdsResquest extends FormRequest
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
                    'description' => 'required|min:3|max:1000',
                    'advertiser_id' => 'required|exists:users,id',
                    'start_date' => "required|date_format:Y-m-d",
                    'type' => "required|in:".implode(',',Ads::getAvailableTypes()),
                    'category_id' => 'required|exists:categories,id',
                    "tags" => "required|array",
                    "tags.*" => "integer"
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'title' => "nullable|string",
                    'description' => 'nullable|min:3|max:1000',
                    'advertiser_id' => 'nullable|exists:users,id',
                    'start_date' => "nullable|date_format:Y-m-d",
                    'type' => "nullable|in:".implode(',',Ads::getAvailableTypes()),
                    'category_id' => 'nullable|exists:categories,id',
                    "tags" => "nullable|array",
                    "tags.*" => "integer"
                ];
                break;
        }
        return  $rules;

    }
}
