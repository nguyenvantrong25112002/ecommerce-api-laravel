<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        // dd(request()->information);
        $rule = [
            'role' => 'required',
        ];
        if (request()->user ==  'new') {
            $rule = array_merge($rule, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'phone_number' => 'required|numeric',
                // 'birthday' => 'date_format:m/d/Y',
            ]);
        }
        if (request()->user ==  'old') {
            $rule = array_merge($rule, [
                'information' => 'required|max:255',
            ]);
        }
        // dd($rule);
        return $rule;
    }
}