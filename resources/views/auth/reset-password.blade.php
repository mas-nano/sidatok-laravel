@extends('layouts.auth')
@section('title')
    Reset Password
@endsection
@section('auth-content')
    @livewire('reset-password', ['token' => $token])
@endsection
