<?php

namespace App\Http\Requests;

use App\Contracts\Repositories\BasketPositionsRepositoryContract;
use App\Contracts\Repositories\BasketsRepositoryContract;
use Illuminate\Foundation\Http\FormRequest;

class BasketPositionCountRequest extends FormRequest
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
            'count' => ['integer']
        ];
    }

    protected function prepareForValidation(): void
    {
        $count = $this->count;

        $basketPositionsRepository = app(BasketPositionsRepositoryContract::class);

        $basketPosition = $basketPositionsRepository->getByBasketPositionId($this->basketPosition);

        $count = $basketPosition->count + $count;

        $this->replace(['count' => $count]);
    }
}
