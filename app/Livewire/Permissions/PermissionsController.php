<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use App\Models\Permissions;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $showModal;
    public $selected_id, $name, $description;
    public $user_auth;

    public $tableControllerKey;// key refrescar RolesTableController
    public function mount()
	{
        $this->user_auth        = auth()->user()->id;
		$this->componentName    = 'Permisos';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;

        $this->showModal        = false;

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
    /**
     * Función boot para manejar los errores
     *
     * @return void
     */
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
        $data = Permission::query()
            ->select('id','name','description')
            ->take(2)->get();
        return view('livewire.permissions.permissions-component', [
            'data' => $data
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    /**
     * Función para mostrar información
     * Por default al crear registro
     *
     * @return void
     */
    public function storeShow()
    {
        error_log('storeShow');
        $this->selected_id  = 0;
        $this->name         = '';
        $this->description  = '';
    }
    /**
     * Función para crear registro
     *
     * @return void
     */
    public function store(){
        error_log('store');
        $rules = [
            'name'          => 'required|min:3|unique:permissions',
            'description'   => 'required',
        ];
        $messages = [
            'name.required'         => 'El nombre es requerido',
            'name.min'              => 'El nombre debe tener al menos 3 caracteres',
            'name.unique'           => 'Ya existe el nombre del permiso',
            'description.required'  => 'La descripcion es requerido',
        ];

        $this->validate($rules, $messages);

        $createItem = Permissions::create([
            'name'          => $this->name,
            'description'   => $this->description,
        ]);
        if ($createItem) {
            // Si existe se hace
        }

        // $this->resetUI();
        $this->dispatch('item-added','Registro Creado!');
        $this->refreshChildTable();

    }
    /**
     * Función para mostrar información
     * De un registro
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        error_log('show');
        $item = Permissions::find($id);
        if (isset($item)) {
            $this->selected_id  = $item->id;
            $this->name         = $item->name;
            $this->description  = $item->description;
            // $this->id_role_tipo = $item->roleTipo->only('id','nombre','descripcion');

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
        $item = Permissions::find($id);
        if (isset($item)) {
            $this->selected_id  = $item->id;
            $this->name         = $item->name;
            $this->description  = $item->description;
            // $this->id_role_tipo = $item->roleTipo->only('id','nombre','descripcion');

            $this->dispatch('item-modal-edit', title: 'Mostrar modal edit!');
            return;
        }else {
            $this->dispatch('item-error', 'No existe el registro!');
            return;
        }
    }
    /**
     * Función para actualizar
     *
     * @param [type] $id
     * @return void
     */
    public function update()
    {
        error_log('update');
        $rules = [
            'name'          => "required|min:3|unique:permissions,name,{$this->selected_id}",
            'description'   => 'required',
        ];
        $messages = [
            'name.required'         => 'El nombre requerido',
            'name.min'              => 'El nombre debe tener al menos 3 caracteres',
            'name.unique'           => 'Ya existe el nombre del permiso',
            'description.required'  => 'La descripcion es requerido',
        ];

        $this->validate($rules, $messages);

        $item = Permissions::find($this->selected_id);
        $item->update([
            'name'          => $this->name,
            'description'   => $this->description,
        ]);
        // $this->resetUI();
        $this->dispatch('item-modal-updated','Registro Actualizado!');
        $this->refreshChildTable();

    }
    /**
     * Función para eliminar
     *
     * @param [type] $id
     * @return void
     */
    #[On('destroy')]
    public function destroy($id)
    {
        error_log('destroy');
        $item = Permissions::find($id);
        if (isset($item)) {
            $item->delete();
            $this->resetUI();
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
        $this->description      = '';

        $this->showModal        = false;
        $this->resetValidation();
        // $this->resetPage();
    }
}
