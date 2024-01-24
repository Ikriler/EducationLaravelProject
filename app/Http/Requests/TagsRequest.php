<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
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
            'tags' => '',
        ];
    }

    protected function prepareForValidation()
    {
        $tags = collect(explode(',', $this->get('tags', '')));

        $tags = $tags
            ->map(fn ($item) => preg_replace('/\W/u', '', $item))
            ->filter(fn ($item) => !empty($item))
        ;

        $this->merge(['tags' => $tags->all()]);
    }
}
