<?php

namespace App\Livewire\ReportPermissions;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permissions;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ReportPermissionsController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $showModal;

    public $selected_id, $name;
    public $user_auth;

    public $stepTable;
    public $userFind, $permissionsUsers;
    public $roleFind, $permissions;
    public $permissionFind, $usersWithPermission;


    public function mount()
	{
        $this->user_auth = auth()->user()->id;

		$this->componentName    = 'Reporte de Permisos';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;

        $this->showModal        = false;

        $this->stepTable        = 1; // Mostrar tableOne por defecto
        // tabla One
        $this->userFind         = '';
        $this->permissionsUsers = [];
        // tabla Two
        $this->roleFind         = '';
        $this->permissions      = [];
        // table three mismos two
            // $this->roleFind         = '';
            // $this->permissions      = [];
        // tabla four
        $this->permissionFind         = '';
        $this->usersWithPermission = [];
    }
    public function render()
    {
        return view('livewire.report-permissions.report-permissions-component')
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function tableOneShow($id)
    {
        error_log('tableOneShow');
        $this->userFind = User::find($id);
        if (isset($this->userFind)) {
            $permissionsUsers = $this->userFind->getPermissionsViaRoles();// Objeto con collection de permissions
            $this->permissionsUsers = $this->userFind ? $permissionsUsers->pluck('name')->toArray() : [];

            $this->selected_id = $id;
            $this->showModal = true;
            $this->stepTable = 1;
            $this->dispatch('item-modal-edit', title: '¡Mostrar modal show!');
            return;
        }else{
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }

    }
    public function tableTwoShow($id)
    {
        error_log('tableTwoShow');
        $this->roleFind = Role::find($id);
        if (isset($this->roleFind)) {
            $this->permissions = $this->roleFind->permissions->pluck('name');// Objeto con collection de permissions

            $this->selected_id = $id;
            $this->showModal = true;
            $this->stepTable = 2;
            $this->dispatch('item-modal-edit', title: '¡Mostrar modal show!');
            return;
        }else{
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }

    }
    public function tableThreeShow($id)
    {
        error_log('tableThreeShow');
        $this->roleFind = Role::find($id);
        if (isset($this->roleFind)) {
            $this->permissions = $this->roleFind->permissions->pluck('name');// Objeto con collection de permissions

            $this->selected_id = $id;
            $this->showModal = true;
            $this->stepTable = 3;
            $this->dispatch('item-modal-edit', title: '¡Mostrar modal show!');
            return;
        }else{
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }

    }
    public function tableFourShow($id)
    {
        error_log('tableFourShow');
        $this->permissionFind = Permissions::find($id);
        if (isset($this->permissionFind)) {
            $item = $this->permissionFind;
            $this->usersWithPermission = User::query()->with('roles:id,name')
            ->whereHas('roles.permissions', function ($query) use ($item) {
                $query->where('name', $item->name);
            })->get();

            $this->selected_id = $id;
            $this->showModal = true;
            $this->stepTable = 4;
            $this->dispatch('item-modal-edit', title: '¡Mostrar modal show!');
            return;
        }else{
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }

    }
    #[On('resetUI')]
    public function resetUI()
    {
        error_log('resetUI');
        $this->selected_id      = 0;

        $this->showModal        = false;

        //tabla One
        $this->userFind         = '';
        $this->permissionsUsers = [];
        //tabla Two
        $this->roleFind         = '';
        $this->permissions      = [];
        // table three mismos two
            // $this->roleFind         = '';
            // $this->permissions      = [];
        // tabla four
        $this->permissionFind   = '';
        $this->usersWithPermission = [];
    }
}
