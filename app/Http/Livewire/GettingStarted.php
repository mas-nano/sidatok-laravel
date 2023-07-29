<?php

namespace App\Http\Livewire;

use App\Models\Shop;
use Livewire\Component;
use App\Traits\UploadFile;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class GettingStarted extends Component
{
    use WithFileUploads, UploadFile;

    public int $step = 1;
    public string $choice = '';
    public string $name = '';
    public string $address = '';
    public string $shopId = '';
    public $files = [];

    protected function rules()
    {
        return [
            'choice' => ['required', Rule::in(['create', 'join'])],
            'name' => 'exclude_unless:choice,create|required',
            'address' => 'exclude_unless:choice,create|required',
            'shopId' => 'exclude_unless:choice,join|required',
            'files.*' => 'exclude_unless:choice,create|nullable|image|max:2048'
        ];
    }

    public function render()
    {
        return view('livewire.getting-started');
    }

    public function updatedFiles()
    {
        $this->validate([
            'files.*' => 'exclude_unless:choice,create|nullable|image|max:2048',
        ]);
    }

    public function save()
    {
        $validator = Validator::make([
            'choice' => $this->choice,
            'name' => $this->name,
            'address' => $this->address,
            'shopId' => $this->shopId,
            'files' => $this->files
        ], $this->rules(), [], [
            'name' => 'Nama Toko',
            'address' => 'Alamat Toko',
            'shopId' => 'Kode Toko',
            'files' => 'Logo Toko'
        ]);

        if ($validator->fails()) {
            $this->step = 2;
        }

        $validator->validate();

        if ($this->choice == 'create') {
            $path = null;
            if (count($this->files) > 0) {
                $path = $this->upload('logo', $this->files[0]);
            }
            $shop = Shop::create([
                'shop_id' => Str::random(5),
                'name' => $this->name,
                'address' => $this->address,
                'logo' => $path
            ]);
            $owner = Role::create([
                'name' => 'owner',
                'shop_id' => $shop->id
            ]);
            Role::create([
                'name' => 'staff',
                'shop_id' => $shop->id
            ]);
            setPermissionsTeamId($shop->id);
            session('shop_id', $shop->id);
            Auth::user()->syncRoles(['owner']);
            Auth::user()->update([
                'shop_id' => $shop->id
            ]);
            $permissions = Permission::all();
            $owner->syncPermissions($permissions);
            return redirect()->route('dashboard.index');
        }
        if ($this->choice == 'join') {
            $shop = Shop::where('shop_id', $this->shopId)->first();
            if ($shop) {
                setPermissionsTeamId($shop->id);
                session('shop_id', $shop->id);
                Auth::user()->syncRoles(['staff']);
                Auth::user()->update([
                    'shop_id' => $shop->id
                ]);
                return redirect()->route('dashboard.index');
            }
            $this->step = 2;
            $this->dispatchBrowserEvent('toast:error', ['message' => 'Toko tidak tersedia']);
        }
    }
}
