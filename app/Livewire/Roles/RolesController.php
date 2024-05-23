<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use App\Models\RoleTipo;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class RolesController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName;
    public $selected_id, $name, $status, $id_role_tipo;
    public $user_auth;

    public $tableControllerKey;// key para refrescar el componente

    public $showModal;

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

    public function store()
    {

    }
    public function show($id)
    {
        error_log('show');
        $item = Role::find($id);
        if (isset($item)) {
            $this->selected_id  = $item->id;

            $this->name         = $item->name;
            $this->status       = $item->status == 1 ? true : false;
            // $this->id_role_tipo = $item->id_role_tipo;
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

            $this->dispatch('item-modal-edit', title: 'Mostrar modal edit!');
            return;
        }else {
            $this->dispatch('item-error', 'No existe el registro!');
            return;
        }
    }
    public function update()
    {
        error_log('update');
        $rules = [
            'name'        => 'required|min:3',
            'surname'     => 'required|min:3',
            'email'       => "required|email|unique:users,email,{$this->selected_id}",
            'activo'      => 'required',

            'id_puesto'   => 'required|not_in:ELEGIR',
        ];
        $messages = [
            'name.required'       => 'El nombre del usuario es requerido',
            'name.min'            => 'El nombre del usuario debe tener al menos 3 caracteres',
            'surname.required'    => 'El apellido del usuario es requerido',
            'surname.min'         => 'El apellido del usuario debe tener al menos 3 caracteres',
            'email.required'      => 'El email es requerido',
            'email.email'         => 'El de tipo email',
            'email.unique'        => 'El email ya existe en el sistema',
            'activo.required'     => 'El campo activo es requerido',

            'id_puesto.required'  => 'Secciona el puesto del usuario',
            'id_puesto.not_in'    => 'El campo debe ser diferente a Selecciona un puesto',
        ];

        $this->validate($rules, $messages);

        $item = Role::find($this->selected_id);
        $item->update([
            'name'      => $this->name,
            'surname'   => $this->surname,
            // 'email'     => $this->email,
            'activo'    => $this->activo,
            'id_puesto' => $this->id_puesto,
            'id_role'   => $this->id_role,
        ]);
        $this->resetUI();
        $this->dispatch('item-modal-updated','Registro Actualizado!');

    }
    #[On('destroy')]
    public function destroy($id)
    {
        error_log('destroy');
        $item = Role::find($id);
        if (isset($item)) {
            // dd($item);
            $item->delete();
            // $this->resetUI();
            $this->dispatch('item-deleted','Usuario Eliminado!');
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
        $this->surname          = '';
        $this->email            = '';
        $this->path_foto_perfil = '';
        $this->inicio_sesion    = '';
        $this->ip_equipo        = '';
        $this->activo           = false;
        $this->tipo             = '';
        $this->id_puesto        = 'ELEGIR';

        $this->showModal        = false;
        $this->resetValidation();
        // $this->resetPage();
    }
}
