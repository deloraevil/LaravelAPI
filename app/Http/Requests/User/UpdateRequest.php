<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'surname' => ['sometimes', 'required', 'string', 'min:4', 'max:39'],
            'phone' => ['sometimes', 'required', 'string', 'regex:/^\+7[0-9]{10}$/',
                Rule::unique('users', 'phone')->ignore($this->route('user')?->id)],
            'img_path' => ['sometimes', 'nullable', 'image', 'mimes:png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Имя обязательно',
            'name.min' => 'Имя должно быть длиннее 3 символов',
            'name.max' => 'Имя должно быть короче 40 символов',
            'surname.required' => 'Фамилия обязательна',
            'surname.min' => 'Фамилия должна быть длиннее 3 символов',
            'surname.max' => 'Фамилия должна быть короче 400 символов',
            'phone.required' => 'Номер телефона обязателен',
            'phone.regex' => 'Номер телефона должен быть в формате +7XXXXXXXXXX',
            'phone.unique' => 'Пользователь с таким номером телефона уже существует',
            'img_path.image' => 'Аватар должен быть изображением',
            'img_path.mimes' => 'Аватар должен быть в формате PNG или JPG',
            'img_path.max' => 'Размер аватара не должен превышать 2 МБ',
        ];
    }
}
