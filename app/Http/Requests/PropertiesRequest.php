<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertiesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $ruleName = 'required|max:255';
        if ($this->route()->id) {
            $ruleName = 'required|max:255|unique:properties,name,' . $this->route()->id . ',id';
        }
        $rule = [
            'name' =>  $ruleName,
        ];
        // dd($rule);
        return $rule;
    }
}