<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KeywordSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // ユーザーがこのリクエストを行う権限があると仮定
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'keyword1' => 'required|string|max:255',
            'keyword2' => 'nullable|string|max:255',
            'keyword3' => 'nullable|string|max:255',
            'search_num' => 'required|integer|min:1|max:5',
        ];
    }

    /**
     * バリデーションエラーのカスタムメッセージを取得
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'keyword1.required' => '検索キーワード1は必須です。',
            'keyword1.max' => '検索キーワード1は255文字以内で入力してください。',
            'search_num.required' => '取得件数は必須です。',
            'search_num.integer' => '取得件数は整数で指定してください。',
            'search_num.min' => '取得件数は1以上で指定してください。',
            'search_num.max' => '取得件数は5以下で指定してください。',
        ];
    }
}