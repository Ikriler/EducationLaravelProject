<?php

namespace App\Http\Requests\Api;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
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
            'old_price' => 'nullable|integer|gt:price',
            'body' => 'required',
            'salon' => 'required',
            'kpp' => 'required',
            'year' => 'required|integer|min:1',
            'color' => 'required',
            'car_class_id' => 'required|exists:car_classes,id',
            'car_body_id' => 'required|exists:car_bodies,id',
            'car_engine_id' => 'required|exists:car_engines,id',
            'categories.*' => ['sometimes', 'required', 'exists:'.Category::class.',id'],
        ];
    }
}
