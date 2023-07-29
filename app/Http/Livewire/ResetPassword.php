<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component
{
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $token = '';

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'token' => 'required',
        'password' => 'required|confirmed'
    ];

    protected $queryString = ['email'];

    public function render()
    {
        return view('livewire.reset-password');
    }

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('auth.login')->with('success', __($status));
        }

        $this->dispatchBrowserEvent('toast:error', ['message' => __($status)]);
    }
}
