<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|min:5',
            'price' => 'required|integer',
            'old_price' => 'integer|gt:price|nullable',
            'body' => 'required',
            'salon' => 'required',
            'kpp' => 'required',
            'year' => 'required|integer|min:1',
            'color' => 'required',
            'car_class_id' => 'required|exists:car_classes,id',
            'car_body_id' => 'required|exists:car_bodies,id',
            'car_engine_id' => 'required|exists:car_engines,id',
            'image' => ['sometimes', 'nullable', 'image'],
        ];
    }
}
