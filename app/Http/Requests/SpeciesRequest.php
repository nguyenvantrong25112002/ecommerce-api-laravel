<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class SpeciesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $ruleName = 'required|max:255';
        if (request()->id) {
            $ruleName = 'required|max:255|unique:properties,name,' . request()->id . ',id';
        }
        $rule = [
            'name' =>  $ruleName,
            'describe' => 'required'
        ];
        return $rule;
    }


    protected function failedValidation(Validator $validator)
    {
        return  new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => false
        ]));
    }
}