<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login_name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        Log::debug('ログイン処理開始' . $this->login_name);
        $this->ensureIsNotRateLimited();

        $user = User::where('login_name', $this->login_name)->first();

        if (!$user) {
            // ユーザーが存在しない場合、新規作成
            Log::debug('ユーザーが存在しないため新規作成');
            $user = $this->createNewUser();
        } else {
            // ユーザーが存在する場合
            Log::debug('ユーザーが存在するためログイン処理');
            if (!Hash::check($this->password, $user->password)) {
                // パスワードが一致しない場合、新しいユーザーを作成
                $user = $this->createNewUser();
            } else {
            }
        }

        // ユーザーでログイン
        Auth::login($user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
    }

    private function createNewUser(): User
    {
        // 新しいユーザー名を生成（既存の名前 + ランダムな文字列）
        $newLoginname = $this->login_name;
        Log::debug('新しいユーザー名を生成' . $newLoginname);
        // 新しいユーザーを作成
        $user = User::create([
            'login_name' => $newLoginname,
            'password' => Hash::make($this->password),
        ]);
        // 作成されたユーザーをログ出力
        Log::debug('新しいユーザーが作成されました: ', ['user' => $user]);

        return $user;
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'name' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login_name')).'|'.$this->ip());
    }
}