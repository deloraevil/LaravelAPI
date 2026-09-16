<?php

namespace App\Http\Requests\Review;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReviewRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
            'reviewable_type' => ['sometimes', 'required', 'string', Rule::in(['user', 'company'])],
            'reviewable_id' => ['sometimes', 'required', 'uuid'],
            'content' => ['sometimes', 'required', 'string', 'min:150', 'max:550'],
            'rating' => ['sometimes', 'required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function messages(): array{
        return [
            'user_id.required' => 'ID автора обязателен',
            'user_id.uuid' => 'ID автора должен быть UUID',
            'user_id.exists' => 'Указанный автор не найден',

            'reviewable_type.required' => 'Тип сущности обязателен',
            'reviewable_type.string' => 'Тип сущности должен быть строкой',
            'reviewable_type.in' => 'Тип сущности должен быть user или company',

            'reviewable_id.required' => 'ID сущности обязателен',
            'reviewable_id.uuid' => 'ID сущности должен быть UUID',

            'content.required' => 'Содержание отзыва обязательно',
            'content.string' => 'Содержание отзыва должно быть строкой',
            'content.min' => 'Содержание отзыва должно быть не короче 150 символов',
            'content.max' => 'Содержание отзыва должно быть не длиннее 550 символов',

            'rating.required' => 'Оценка обязательна',
            'rating.integer' => 'Оценка должна быть целым числом',
            'rating.min' => 'Оценка должна быть от 1 до 10',
            'rating.max' => 'Оценка должна быть от 1 до 10',
        ];
    }
}
