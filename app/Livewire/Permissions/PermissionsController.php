<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName;

    public $selected_id, $name;

    public $user_auth;
    public function mount()
	{
        $this->user_auth = auth()->user()->id;

		$this->componentName    = 'Permisos';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;
	}
    public function render()
    {
        $data = Permission::query()
            ->select('id','name','description')
            ->take(2)->get();
        return view('livewire.permissions.permissions-component', [
            'data' => $data
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
