<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    public string $email = '';
    public string $name = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'email' => 'required|unique:users|email:dns,rfc',
        'name' => 'required',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required'
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'name' => $this->name
        ]);

        event(new Registered($user));
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('verification.notice');
        }
        $this->dispatchBrowserEvent('toast:error', ['message' => 'Registrasi Gagal! Silakan coba lagi.']);
    }

    public function render()
    {
        return view('livewire.register');
    }
}
