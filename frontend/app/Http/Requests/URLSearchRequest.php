<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class URLSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // ここをtrueに変更してリクエストを許可します
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'url'], // URLのバリデーションルールを追加
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'url.required' => 'URLは必須です。',
            'url.url' => '有効なURLを入力してください。',
        ];
    }
}
