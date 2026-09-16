<?php

namespace App\Http\Requests\Company;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'min:4', 'max:39'],
            'description' => ['sometimes', 'required', 'string', 'min:150', 'max:400'],
            'img_path' => ['sometimes', 'nullable', 'image', 'mimes:png', 'max:3072'],
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Имя обязательно',
            'name.min' => 'Имя должно быть длиннее 3 символов',
            'name.max' => 'Имя должно быть короче 40 символов',
            'description.required' => 'Описание обязательно',
            'description.min' => 'Описание должно быть длиннее 150 символов',
            'description.max' => 'Описание должно быть короче 400 символов',
            'img_path.image' => 'Логотип должен быть изображением',
            'img_path.mimes' => 'Логотип должен быть в формате PNG',
            'img_path.max' => 'Размер логотипа не должен превышать 3 МБ',

        ];
    }
}
