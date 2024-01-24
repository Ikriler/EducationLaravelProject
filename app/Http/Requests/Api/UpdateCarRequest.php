<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'min:5', 'sometimes'],
            'price' => 'required|integer|sometimes',
            'old_price' => 'integer|gt:price|sometimes|nullable',
            'car_class_id' => 'required|exists:car_classes,id|sometimes',
            'car_body_id' => 'required|exists:car_bodies,id|sometimes',
            'car_engine_id' => 'required|exists:car_engines,id|sometimes',
        ];
    }
}
