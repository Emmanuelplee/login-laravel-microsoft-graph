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
    public function show($id)
    {
        error_log('show');
        // $item = Role::find($id);
        // if (isset($item)) {
        //     $this->selected_id  = $item->id;

        //     $this->name         = $item->name;
        //     $this->status       = $item->status == 1 ? true : false;
        //     // $this->id_role_tipo = $item->id_role_tipo;
        //     $this->id_role_tipo = $item->roleTipo->only('id','nombre','descripcion');

        //     $this->showModal = true;
        //     $this->dispatch('item-modal-edit', title: 'Mostrar modal show!');
        //     return;
        // }else {
        //     $this->dispatch('item-error', 'No existe el registro!');
        //     return;
        // }
    }
    public function edit($id)
    {
        error_log('edit');
        // $item = Role::find($id);
        // // dd($item);
        // if (isset($item)) {
        //     $this->selected_id  = $item->id;
        //     $this->name         = $item->name;
        //     $this->status       = $item->status == 1 ? true : false;
        //     $this->id_role_tipo = $item->id_role_tipo;

        //     $this->dispatch('item-modal-edit', title: 'Mostrar modal edit!');
        //     return;
        // }else {
        //     $this->dispatch('item-error', 'No existe el registro!');
        //     return;
        // }
    }
}
