<div class="w-2/3">
    <h4 class="text-3xl text-gray-700">Selamat Datang</h4>
    <h4 class="mt-1 text-gray-700">Silakan Login dengan data diri Anda</h4>
    <form wire:submit.prevent="login" class="mt-4 mb-2">
        <div class="flex flex-col gap-4">
            <div class="">
                <label for="email" class="text-sm text-gray-700">Email</label>
                <input type="text"
                    class="w-full py-2 px-3 block rounded-md border @error('email') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                    wire:model.defer="email" placeholder="Email" id="email">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="" x-data="{ show: false }">
                <label for="password" class="text-sm text-gray-700">Password</label>
                <div class="flex border rounded-md @error('email') border-red-600 @else border-orange-500 @enderror">
                    <input x-bind:type=" show ? 'text' : 'password'"
                        class="w-full py-2 px-3 rounded-md block outline-none" wire:model.defer="password"
                        placeholder="Password" id="password">
                    <button class="p-2" type="button" x-on:click="show=!show">
                        <template x-if="show">
                            <i class="fa-regular fa-eye-slash"></i>
                        </template>
                        <template x-if="!show">
                            <i class="fa-regular fa-eye"></i>
                        </template>
                    </button>
                </div>
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-1">
                    <input type="checkbox" name="remember" id="remember" class="p-2" wire:model.defer="remember">
                    <label for="remember" class="text-sm">Ingat saya?</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600">Lupa Password?</a>
            </div>
            <button class="w-full py-3 bg-orange-500 rounded-md text-white" type="submit"
                wire:loading.class="!bg-orange-300" wire:loading.attr="disabled" wire:target="login"><i
                    class="fa-solid fa-circle-notch fa-spin hidden" wire:loading.class.remove="hidden"
                    wire:target="login"></i> Login</button>
            <a href="{{ route('auth.google') }}" class="w-full py-3 text-center border-orange-500 border rounded-md"
                type="button"><i class="fa-brands fa-google"></i> Login With Google</a>
            <p class="text-gray-700">Belum punya akun? <a href="{{ route('auth.register') }}"
                    class="text-blue-600">Daftar</a></p>
        </div>
    </form>
</div>
