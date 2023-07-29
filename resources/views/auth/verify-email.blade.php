@extends('layouts.auth')
@section('title')
    Verifikasi Email
@endsection
@section('auth-content')
    <div class="w-2/3 flex flex-col justify-center items-center gap-2">
        <div class="">
            <i class="fa-regular fa-envelope fa-3x"></i>
        </div>
        <p class="text-lg">Verifikasi email sudah kami kirim kepada Email Anda. Silakan lakukan verifikasi email.</p>
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button class="py-3 px-2 bg-orange-500 rounded-md text-white">Kirim ulang kode verifikasi</button>
        </form>
    </div>
@endsection
