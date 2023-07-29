<form wire:submit.prevent="save" class="w-3/4 flex flex-col gap-4" x-data="data()">
    <div class="flex justify-between">
        <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white bg-orange-500">1</div>
        <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white bg-orange-300 transition duration-200"
            x-bind:class="step >= 2 && '!bg-orange-500'">2</div>
        <div class="w-[35px] h-[35px] rounded-full flex justify-center items-center text-white bg-orange-300 transition duration-200"
            x-bind:class="step >= 3 && '!bg-orange-500'">3</div>
    </div>
    <template x-if="step==1">
        <div class="flex gap-2 justify-between">
            <input type="radio" class="hidden peer/create" name="choice" id="create" value="create"
                x-model="choice">
            <label for="create"
                class="w-1/2 border cursor-pointer border-orange-500 peer-checked/create:ring-orange-500 peer-checked/create:ring peer-checked/create:ring-2 p-5 rounded-lg">
                <i class="fa-solid fa-plus fa-xl"></i>
                <p>Buat Toko Baru</p>
            </label>
            <input type="radio" class="hidden peer/join" name="choice" id="join" value="join"
                x-model="choice">
            <label for="join"
                class="border w-1/2 cursor-pointer border-orange-500 peer-checked/join:ring-orange-500 peer-checked/join:ring peer-checked/join:ring-2 p-5 rounded-lg">
                <i class="fa-solid fa-right-to-bracket fa-xl"></i>
                <p>Bergabung Dengan Toko Yang Sudah Ada</p>
            </label>
        </div>
    </template>
    <template x-if="step==2&&choice=='create'">
        <div class="flex flex-col gap-2">
            <div class="">
                <label for="name" class="text-sm text-gray-700">Nama Toko</label>
                <input type="text"
                    class="w-full py-2 px-3 block rounded-md border @error('name') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                    placeholder="Nama Toko" id="name" x-model="name">
                @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="address" class="text-sm text-gray-700">Alamat Toko</label>
                <input type="text"
                    class="w-full py-2 px-3 block rounded-md border @error('address') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                    placeholder="Alamat Toko" id="address" x-model="address">
                @error('address')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="logo" class="text-sm text-gray-700">Logo</label>
                <div class="border rounded-md @error('files') border-red-600 @else border-orange-500 @enderror">
                    <input type="file"
                        class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600"
                        x-on:change="handleLogoChange($event)" />
                </div>
                @error('files')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="" x-show="isLoading">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>
            @if ($files)
                <img src="{{ $files[0]->temporaryUrl() }}" alt=""
                    class="w-1/6 rounded-full object-cover object-center aspect-square">
            @endif
        </div>
    </template>
    <template x-if="step==2&&choice=='join'">
        <div class="">
            <label for="shopId" class="text-sm text-gray-700">Kode Toko</label>
            <input type="text"
                class="w-full py-2 px-3 block rounded-md border @error('shopId') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                placeholder="Kode Toko" id="shopId" x-model="shopId">
            @error('shopId')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </template>
    <template x-if="step>=3">
        <div>
            <template x-if="choice=='create'">
                <div>
                    <p class="my-3">Nama Toko: <span x-text="name"></span></p>
                    <p class="my-3">Alamat Toko: <span x-text="address"></span></p>
                    <p class="my-3">Logo Toko:</p>
                    @if ($files)
                        <img src="{{ $files[0]->temporaryUrl() }}" alt=""
                            class="w-1/6 rounded-full object-cover object-center aspect-square">
                    @endif
                </div>
            </template>
            <template x-if="choice=='join'">
                <div>
                    <p class="my-3">Kode Toko: <span x-text="shopId"></span></p>
                </div>
            </template>
        </div>
    </template>
    <div class="flex justify-between items-center">
        <button class="py-2 bg-orange-500 rounded-md text-white px-3 disabled:bg-orange-300 disabled:cursor-not-allowed"
            x-bind:disabled="step == 1" x-on:click="step--" type="button">Kembali</button>
        <button class="py-2 bg-orange-500 rounded-md text-white px-3 disabled:bg-orange-300 disabled:cursor-not-allowed"
            x-bind:disabled="choice == ''" x-on:click="addStep()" x-bind:type="step == 4 ? 'submit' : 'button'"
            x-text="step==3?'Simpan':'Berikutnya'"></button>
    </div>
    <script>
        function data() {
            return {
                step: @entangle('step'),
                choice: @entangle('choice').defer,
                name: @entangle('name').defer,
                address: @entangle('address').defer,
                shopId: @entangle('shopId').defer,
                logo: @entangle('files'),
                isLoading: false,
                handleLogoChange(e) {
                    this.isLoading = true
                    @this.uploadMultiple('files', e.target.files,
                        (uploadedFilename) => {
                            this.isLoading = false
                        }, () => {}, (event) => {})
                },
                addStep() {
                    this.step++
                }
            }
        }
    </script>
</form>
