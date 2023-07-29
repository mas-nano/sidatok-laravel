@extends('layouts.root')
@section('bg-root')
    #f8f8f8
@endsection
@section('content')
    <div x-data="{ large: false }">
        <div class="w-24 h-screen fixed bg-white transition-all py-6 duration-150 overflow-x-hidden"
            x-bind:class="large && '!w-72'" x-on:mouseover="()=>large=!large" x-on:mouseout="()=>large=!large">
            <div class="flex flex-col justify-between h-full">
                <div class="flex flex-col gap-6">
                    <a href="#" class="py-4 px-8 flex justify-center items-center hover:bg-slate-50">
                        <div class="w-[36px] h-[36px] flex flex-col justify-center items-center">
                            <div class="md:w-full w-1/2 md:h-1/2 h-1/4 rounded-t-full bg-[#f46801]"></div>
                            <div class="md:h-1/2 h-1/4 w-1/2 md:w-full blur-xl bg-[#f46801] rounded-b-full"></div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.index') }}"
                        class="py-4 px-8 whitespace-nowrap hover:bg-slate-50 {{ request()->segment(1) === 'dashboard' ? 'border border-t-0 border-l-0 border-b-0 border-r-4 border-r-orange-500' : '' }}">
                        <i class="fa-solid fa-house fa-xl fa-fw text-orange-500 align-middle"></i>
                        <span class="align-middle ml-8">Dashboard</span>
                    </a>
                    <a href="#"
                        class="py-4 px-8 whitespace-nowrap hover:bg-slate-50 {{ request()->segment(1) === 'kasir' ? 'border border-t-0 border-l-0 border-b-0 border-r-4 border-r-orange-500' : '' }}">
                        <i class="fa-solid fa-border-all fa-xl fa-fw text-orange-500 align-middle"></i>
                        <span class="align-middle ml-8">Kasir</span>
                    </a>
                    <a href="#"
                        class="py-4 px-8 whitespace-nowrap hover:bg-slate-50 {{ request()->segment(1) === 'laporan' ? 'border border-t-0 border-l-0 border-b-0 border-r-4 border-r-orange-500' : '' }}">
                        <i class="fa-solid fa-chart-pie fa-xl fa-fw text-orange-500 align-middle"></i>
                        <span class="align-middle ml-8">Laporan</span>
                    </a>
                    <a href="{{ route('dashboard.item') }}"
                        class="py-4 px-8 whitespace-nowrap hover:bg-slate-50 {{ request()->segment(1) === 'item' ? 'border border-t-0 border-l-0 border-b-0 border-r-4 border-r-orange-500' : '' }}">
                        <i class="fa-solid fa-box-open fa-xl fa-fw text-orange-500 align-middle"></i>
                        <span class="align-middle ml-8">Barang</span>
                    </a>
                </div>
                <div class="flex flex-col gap-6">
                    <a href="#" class="py-4 px-8 whitespace-nowrap hover:bg-slate-50">
                        <i class="fa-solid fa-gear fa-xl fa-fw text-orange-500 align-middle"></i>
                        <span class="align-middle ml-8">Pengaturan</span>
                    </a>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="py-4 px-8 whitespace-nowrap hover:bg-slate-50">
                            <i class="fa-solid fa-arrow-right-to-bracket fa-xl fa-fw text-orange-500 align-middle"></i>
                            <span class="align-middle ml-8">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-7 ml-[108px] transition-all duration-150" x-bind:class="large && '!ml-72'">
            @yield('dashboard-content')
        </div>
    </div>
@endsection
