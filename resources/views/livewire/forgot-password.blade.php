<div class="w-2/3">
    <h4 class="text-3xl text-gray-700">Lupa Password</h4>
    <h4 class="mt-1 text-gray-700">Silakan masukkan Email Anda</h4>
    <form wire:submit.prevent="forgotPassword" class="mt-4 mb-2">
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
            <button class="w-full py-3 bg-orange-500 rounded-md text-white" type="submit"
                wire:loading.class="!bg-orange-300" wire:loading.attr="disabled"><i
                    class="fa-solid fa-circle-notch fa-spin hidden" wire:loading.class.remove="hidden"
                    wire:target="forgotPassword"></i> Kirim Kode Lupa Password</button>
            <p class="text-gray-700">Sudah punya akun? <a href="{{ route('auth.login') }}"
                    class="text-blue-600">Masuk</a></p>
        </div>
    </form>
</div>
