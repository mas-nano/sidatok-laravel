<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';

    protected $rules = [
        'email' => 'required|email:rfc,dns'
    ];

    public function render()
    {
        return view('livewire.forgot-password');
    }

    public function forgotPassword()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        $status === Password::RESET_LINK_SENT ? $this->dispatchBrowserEvent('toast:success', ['message' => __($status)]) : $this->dispatchBrowserEvent('toast:error', ['message' => __($status)]);
    }
}
