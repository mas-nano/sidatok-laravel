@extends('layouts.root')
@section('bg-root')
    #d2d0dd
@endsection
@section('content')
    <div class="md:w-screen md:h-screen md:flex md:flex-col md:justify-center md:items-center">
        <div class="xl:w-2/3 lg:w-3/4 md:w-5/6 p-0 w-full h-3/4 flex flex-col-reverse md:flex-row">
            <div
                class="md:w-1/2 w-full rounded-b-lg md:rounded-l-lg md:rounded-br-none flex justify-center items-center md:p-0 p-3 bg-white">
                @yield('auth-content')
            </div>
            <div
                class="bg-[#f3f4f8] md:flex-1 md:rounded-r-lg h-36 md:h-full md:rounded-tl-none rounded-t-lg flex justify-center items-center">
                <div class="w-[200px] h-[200px] flex flex-col justify-center items-center">
                    <div class="md:w-full w-1/2 md:h-1/2 h-1/4 rounded-t-full bg-[#f46801]"></div>
                    <div class="md:h-1/2 h-1/4 w-1/2 md:w-full blur-xl bg-[#f46801] rounded-b-full"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
