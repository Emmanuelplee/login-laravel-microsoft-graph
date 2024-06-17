<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class RolesController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $showModal;
    public $selected_id, $name, $status, $id_role_tipo;
    public $user_auth;

    public $tableControllerKey;// key refrescar RolesTableController

    // Para los Select con búsqueda
    public $role_tipos;
    public function mount()
	{
        $this->user_auth = auth()->user()->id;
		$this->componentName    = 'Roles';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;
        $this->id_role_tipo     = 'ELEGIR';

        $this->showModal        = false;

        $this->role_tipos       = [];
        $this->tableControllerKey = uniqid();
	}
    /**
     * Esta función es para refrescar el componente
     * De la tabla por medio del key uniqid()
     *
     * @return void
     */
    #[On('refreshChildTable')]
    public function refreshChildTable()
    {
        error_log('refreshChildTable');
        $this->tableControllerKey = uniqid();
    }
    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                if ($validator->errors()->count() > 0) {
                    $errors = $validator->errors()->messages();
                    $firstKey = array_key_first($errors);
                    $this->dispatch('form-focus-error', firstName: $firstKey);
                    return;
                }
            });
        });
    }
    public function render()
    {
        $data = Role::query()
            ->select('id','name','status','id_role_tipo','created_at','updated_at')
            ->with('roleTipo:id,nombre,descripcion')->take(2)->get();

        $this->role_tipos = DB::table('role_tipos')->select(
            DB::raw('id AS id'),DB::raw('nombre AS name'),)
            ->orderBy('nombre', 'asc')->get()->toArray();
        return view('livewire.roles.roles-component', [
            'data'          => $data,
            'role_tipos'    => $this->role_tipos,
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function storeShow()
    {
        $this->selected_id      = 0;
        $this->name             = '';
        $this->status           = true;
        $this->id_role_tipo     = 7;//rol tipo por default nuevo
    }
    public function store(){
        $rules = [
            'name'          => 'required|min:3|unique:roles',
            'status'        => 'required',
            'id_role_tipo'  => 'required|not_in:ELEGIR',
        ];
        $messages = [
            'name.required'         => 'Nombre del rol requerido',
            'name.min'              => 'El nombre debe tener al menos 3 caracteres',
            'name.unique'           => 'Ya existe el nombre del rol',
            'status.required'       => 'El estatus es requerido',
            'id_role_tipo.required' => 'El rol tipo es requerido',
            'id_role_tipo.not_in'   => 'Elige un rol tipo diferente a ELEGIR',
        ];

        $this->validate($rules, $messages);

        $createItem = Role::create([
            'name'          => $this->name,
            'status'        => $this->status,
            'id_role_tipo'  => $this->id_role_tipo,
        ]);
        if ($createItem) {
            // Si existe se hace
        }

        $this->resetUI();
        $this->dispatch('item-added','Registro Creado!');
        $this->refreshChildTable();

    }
    public function show($id)
    {
        error_log('show');
        $item = Role::find($id);
        if (isset($item)) {
            $this->selected_id  = $item->id;
            $this->name         = $item->name;
            $this->status       = $item->status == 1 ? true : false;
            $this->id_role_tipo = $item->roleTipo->only('id','nombre','descripcion');

            $this->showModal = true;
            $this->dispatch('item-modal-edit', title: 'Mostrar modal show!');
            return;
        }else {
            $this->dispatch('item-error', 'No existe el registro!');
            return;
        }
    }
    public function edit($id)
    {
        error_log('edit');
        $item = Role::find($id);
        // dd($item);
        if (isset($item)) {
            $this->selected_id  = $item->id;
            $this->name         = $item->name;
            $this->status       = $item->status == 1 ? true : false;
            $this->id_role_tipo = $item->id_role_tipo;

            $this->dispatch('item-modal-edit', title: '¡Mostrar modal edit!');
            return;
        }else {
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }
    }
    public function update()
    {
        error_log('update');
        $rules = [
            'name'          => "required|min:3|unique:roles,name,{$this->selected_id}",
            'status'        => 'required',
            'id_role_tipo'  => 'required|not_in:ELEGIR',
        ];
        $messages = [
            'name.required'         => 'Nombre del rol requerido',
            'name.min'              => 'El nombre debe tener al menos 3 caracteres',
            'name.unique'           => 'Ya existe el nombre del rol',
            'id_role_tipo.required' => 'El rol tipo es requerido',
            'id_role_tipo.not_in'   => 'Elige un rol tipo diferente a ELEGIR',
            'status.required'       => 'El estatus es requerido',
        ];

        $this->validate($rules, $messages);

        $item = Role::find($this->selected_id);

        if (($item->name == 'Desarrollador'  && $this->name != $item->name) || ($item->name == 'Administrador'  && $this->name != $item->name)) {
            $this->dispatch('item-error', '¡No  se recomienda cambiar el nombre de este rol!');
            return;
        }

        $item->update([
            'name'          => $this->name,
            'status'        => $this->status,
            'id_role_tipo'  => $this->id_role_tipo,
        ]);
        // $this->resetUI();
        $this->dispatch('item-modal-updated','¡Registro Actualizado!');
        $this->refreshChildTable();

    }
    #[On('destroy')]
    public function destroy($id)
    {
        error_log('destroy');
        $item = Role::find($id);
        if (isset($item)) {
            $item->delete();
            // $this->resetUI();
            $this->dispatch('item-deleted','Registro Eliminado!');
        }else {
            $this->dispatch('item-error','No existe el registro!');
        }
    }
    #[On('resetUI')]
    public function resetUI()
    {
        error_log('resetUI');
        $this->selected_id      = 0;
        $this->name             = '';
        $this->status           = false;
        $this->id_role_tipo     = 'ELEGIR';

        $this->showModal        = false;
        $this->resetValidation();
        // $this->resetPage();
    }
}
