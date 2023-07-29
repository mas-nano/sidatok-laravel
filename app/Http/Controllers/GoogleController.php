<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser, true);
                $shop_id = Auth::user()->shop_id;
                if ($shop_id) {
                    session(['shop_id' => $shop_id]);
                    return redirect()->route('dashboard.index');
                }
                return redirect()->route('getting-started');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => 0,
                    'photo' => $user->avatar,
                    'email_verified_at' => Carbon::now()
                ]);
                Auth::login($newUser, true);
                $shop_id = Auth::user()->shop_id;
                if ($shop_id) {
                    session(['shop_id', $shop_id]);
                    return redirect()->route('dashboard.index');
                }
                return redirect()->route('getting-started');
            }
        } catch (\Throwable $th) {
            return redirect()->route('auth.login')->with('error', $th->getMessage());
        }
    }
}
