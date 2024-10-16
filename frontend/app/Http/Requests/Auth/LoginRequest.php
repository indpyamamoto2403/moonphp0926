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
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        Log::debug('ログイン処理開始');
        $this->ensureIsNotRateLimited();

        $user = User::where('name', $this->name)->first();

        if (!$user) {
            // ユーザーが存在しない場合、新規作成
            $user = $this->createNewUser();
            Log::debug('新規ユーザー作成: ' . $user->name);
        } else {
            // ユーザーが存在する場合
            if (!Hash::check($this->password, $user->password)) {
                // パスワードが一致しない場合、新しいユーザーを作成
                Log::debug('パスワード不一致。新規ユーザー作成: ' . $this->name);
                $user = $this->createNewUser();
            } else {
                Log::debug('既存ユーザーログイン: ' . $user->name);
            }
        }

        // ユーザーでログイン
        Auth::login($user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
        Log::debug('ログイン処理完了: ' . $user->name);
    }

    private function createNewUser(): User
    {
        // 新しいユーザー名を生成（既存の名前 + ランダムな文字列）
        $newUsername = $this->name;
        
        // 新しいユーザーを作成
        $user = User::create([
            'name' => $newUsername,
            'password' => Hash::make($this->password),
        ]);

        Log::debug('新規ユーザー作成: ' . $user->name);
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
        return Str::transliterate(Str::lower($this->string('name')).'|'.$this->ip());
    }
}