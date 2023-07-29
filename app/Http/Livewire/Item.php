<?php

namespace App\Http\Livewire;

use App\Models\Item as ModelsItem;
use App\Traits\UploadFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Item extends Component
{
    use WithFileUploads, UploadFile;
    public $name, $price, $discount, $files, $detail;

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'files' => 'required|image|max:2048',
        'detail' => 'required'
    ];

    protected $validationAttributes = [
        'name' => 'Nama Produk',
        'price' => 'Harga Produk',
        'discount' => 'Diskon',
        'files' => 'Gambar',
        'detail' => 'Detail'
    ];

    public function render()
    {
        $items = auth()->user()->shop->items;
        return view('livewire.item', compact('items'));
    }

    public function store()
    {
        $this->validate();
        $path = $this->upload('product-picture', $this->files);
        ModelsItem::create([
            'name' => $this->name,
            'detail' => $this->detail,
            'photo' => $path,
            'price' => $this->price,
            'discount' => $this->discount ?: null,
            'shop_id' => auth()->user()->shop->id
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
