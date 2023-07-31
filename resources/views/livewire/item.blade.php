<div x-data="data">
    <div class="flex justify-between items-center">
        <div class="">
            <h4 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name }}</h4>
            <p class="text-slate-500">Semoga harimu menyenangkan :)</p>
        </div>
        <div class="flex gap-4 items-center">
            <div class="flex px-4 py-2 gap-2 rounded-lg items-center bg-white">
                <label for="search">
                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                </label>
                <input type="text" name="" id="search" class="py-2 outline-none">
            </div>
            <button type="button" class="px-4 py-4 bg-white rounded-lg">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>
    <div class="flex justify-between items-center my-8">
        <h4 class="text-2xl">Barang</h4>
        <button type="button" class="px-4 py-2 bg-green-600 text-white rounded-lg" x-on:click="modal=!modal">Tambah
            Barang</button>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-4 transition-all duration-150">
        @foreach ($items as $item)
            <div class="rounded-lg bg-white p-4 flex flex-col">
                <div class="relative">
                    <img src="{{ asset('storage/' . $item->photo) }}" alt=""
                        class="w-full h-40 object-center rounded-lg object-cover">
                    <button type="button"
                        class="rounded-lg opacity-80 p-4 absolute top-0 right-0 bg-white -translate-x-2 translate-y-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
                <h6 class="text-lg font-semibold my-2">{{ $item->name }}</h6>
                <p class="text-slate-500 flex-1">{{ $item->detail }}</p>
                <p class="my-2"><span class="text-xl font-semibold text-orange-500">Rp{{ $item->price }}</span><span
                        class="text-base text-slate-500">/ 1pcs</span>
                </p>
                <div class="flex justify-end gap-2">
                    <button type="button" class="rounded-lg py-2 px-4 bg-yellow-400 text-white">Ubah</button>
                    <button type="button" class="rounded-lg py-2 px-4 bg-red-500 text-white">Hapus</button>
                </div>
            </div>
        @endforeach
    </div>
    <div wire:ignore.self class="fixed top-0 inset-0 overflow-y-scroll py-8" x-show="modal"
        x-transition.opacity.duration.150ms>
        <form wire:submit.prevent="store"
            class="bg-white rounded-lg p-4 drop-shadow-xl mx-auto w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4 2xl:w-1/5 transition-all duration-150">
            <div class="flex justify-between items-center">
                <p class="text-xl">Tambah Barang</p>
                <button x-on:click="modal=!modal" id="close" type="button"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
                <div class="">
                    <label for="name" class="text-sm text-gray-700">Nama</label>
                    <input type="text"
                        class="w-full py-2 px-3 block rounded-md border @error('name') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                        wire:model.defer="name" placeholder="Nama" id="name">
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="price" class="text-sm text-gray-700">Harga</label>
                    <input type="text"
                        class="w-full py-2 px-3 block rounded-md border @error('price') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                        wire:model.defer="price" placeholder="Harga" id="price">
                    @error('price')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="discount" class="text-sm text-gray-700">Diskon</label>
                    <input type="text"
                        class="w-full py-2 px-3 block rounded-md border @error('discount') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                        wire:model.defer="discount" placeholder="Diskon" id="discount">
                    @error('discount')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="photo" class="text-sm text-gray-700">Foto</label>
                    <div class="border rounded-md @error('files') border-red-600 @else border-orange-500 @enderror">
                        <input type="file"
                            class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600"
                            x-on:change="preview" x-ref="photo" accept="image/*" wire:model.defer="files" />
                    </div>
                    @error('files')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <template x-if="imgSrc">
                    <img :src="imgSrc" alt="" class="w-full">
                </template>
                <div class="">
                    <label for="detail" class="text-sm text-gray-700">Detail</label>
                    <textarea type="text"
                        class="w-full py-2 px-3 block rounded-md border @error('detail') border-red-600 @else border-orange-500 @enderror focus:ring-2 outline-none focus:drop-shadow-lg focus:ring-orange-500"
                        wire:model.defer="detail" placeholder="Detail" id="detail"></textarea>
                    @error('detail')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <hr class="my-4">
            <div class="flex justify-end items-center gap-4">
                <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-lg"
                    x-on:click="modal=!modal">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg disabled:bg-green-400 disabled:cursor-not-allowed"><i
                    class="fa-solid fa-circle-notch fa-spin hidden" wire:loading.class.remove="hidden"
                    wire:target="login"></i> Tambah</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                modal: false,
                imgSrc: null,
                preview() {
                    let file = this.$refs.photo.files[0];
                    if (!file || file.type.indexOf('image/') === -1) return;
                    this.imgSrc = null;
                    let reader = new FileReader();

                    reader.onload = e => {
                        this.imgSrc = e.target.result;
                    }

                    reader.readAsDataURL(file);
                }
            }))
        })
        window.addEventListener('close-modal', () => {
            document.getElementById('close').click()
        })
    </script>
</div>
