<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        // dd(request()->all());
        $ruleName = 'required|max:255';
        $image = "required|image|mimes:jpeg,png,jpg,gif|max:4048";
        if ($this->route()->id) {
            $ruleName = 'required|max:255|unique:products,name,' . $this->route()->id . ',id';
            $image = "image|mimes:jpeg,png,jpg,gif|max:4048";
        }
        $rule = [
            'image' => $image,
            'name' =>  $ruleName,
            'slug' => 'required|max:255',
            'category_id' => 'required|array',
            'price' => "required|numeric|min:0|not_in:0",
            'sale_off' => 'nullable|integer',
            'quantity' => 'required|integer',
            'details' => 'required',
            'description' => 'required',
            'gallerys.*.image' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
            'gallerys.*.order' => 'nullable|integer',
            'end_price_sale' => 'required|integer',
        ];
        return $rule;
    }
}