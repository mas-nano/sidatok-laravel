<div class="w-2/3">
    <h4 class="text-3xl text-gray-700">Reset Password</h4>
    <h4 class="mt-1 text-gray-700">Silakan masukkan password baru</h4>
    <form wire:submit.prevent="resetPassword" class="mt-4 mb-2">
        <input type="hidden" name="" wire:model.defer="token">
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
            <div class="" x-data="{ show: false }">
                <label for="password_confirmation" class="text-sm text-gray-700">Konfirmasi Password</label>
                <div class="flex border rounded-md @error('email') border-red-600 @else border-orange-500 @enderror">
                    <input x-bind:type=" show ? 'text' : 'password'"
                        class="w-full py-2 px-3 rounded-md block outline-none" wire:model.defer="password_confirmation"
                        placeholder="Password" id="password_confirmation">
                    <button class="p-2" type="button" x-on:click="show=!show">
                        <template x-if="show">
                            <i class="fa-regular fa-eye-slash"></i>
                        </template>
                        <template x-if="!show">
                            <i class="fa-regular fa-eye"></i>
                        </template>
                    </button>
                </div>
                @error('password_confirmation')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <button class="w-full py-3 bg-orange-500 rounded-md text-white" type="submit"
                wire:loading.class="!bg-orange-300" wire:loading.attr="disabled" wire:target="resetPassword"><i
                    class="fa-solid fa-circle-notch fa-spin hidden" wire:loading.class.remove="hidden"
                    wire:target="resetPassword"></i> Reset Password</button>
        </div>
    </form>
</div>
