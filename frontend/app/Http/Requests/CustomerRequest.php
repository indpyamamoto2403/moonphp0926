<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // バリデーションのチェックを有効にするためにtrueに変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Log::debug(1);
        return [
            'name' => 'nullable|string|max:255', // 任意の入力
            'company_name' => 'required|string|max:255', // 必須項目
            'department' => 'nullable|string|max:255', // 任意の入力
            'yakushoku' => 'nullable|string|max:255', // 任意の入力
            'company_zipcode' => 'nullable|regex:/^\d{3}-\d{4}$/', // 任意だが、入力があれば「XXX-XXXX」の形式を強制
            'company_address' => 'nullable|string|max:255', // 任意の入力
            'company_url' => 'nullable|url', // 任意だが、入力があれば有効なURLであることを強制
            'company_overview' => 'nullable|string|max:1000', // 任意の入力
        ];
    }

    /**
     * カスタムエラーメッセージを定義する場合（任意）
     */
    public function messages(): array
    {
        return [
            'company_name.required' => '会社名は必須項目です。',
            'company_zipcode.regex' => '郵便番号は「XXX-XXXX」の形式で入力してください。',
            'company_url.url' => '有効なURLを入力してください。',
        ];
    }
}
