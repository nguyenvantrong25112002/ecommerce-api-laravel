<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        // $ruleName = 'required|unique:exams,name|min:4|max:255';
        // if ($this->route()->id) $ruleName = 'required|min:4|max:255|unique:exams,name,' . $this->route()->id . ',id';
        // $rule = [
        //     'name' => $ruleName,
        //     'description' => 'required|min:4',
        //     'max_ponit' => 'required|numeric|min:0|max:1000',
        //     'ponit' => 'required|numeric|min:0|max:1000',
        // ];
        $rule = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'order' => 'integer|max:1000|nullable',
            'parent_id' => 'integer|nullable',
            'status' => 'required|integer',
        ];
        return $rule;
    }
}