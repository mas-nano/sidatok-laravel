<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public int $remember = 0;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
        'remember' => 'nullable'
    ];

    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember == 1)) {
            $shop_id = Auth::user()->shop_id;
            if ($shop_id) {
                session(['shop_id' => $shop_id]);
                return redirect()->route('dashboard.index');
            }
            return redirect()->route('getting-started');
        }
        $this->dispatchBrowserEvent('toast:error', ['message' => 'Email atau password Anda salah!']);
    }

    public function render()
    {
        return view('livewire.login');
    }
}
