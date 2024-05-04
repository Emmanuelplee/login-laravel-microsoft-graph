<?php

namespace App\Livewire;

use App\Models\Puesto;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Repositories\Activities;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;

class UsersController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $search;
    public $selected_id, $name, $surname, $email, $path_foto_perfil,
        $inicio_sesion, $ip_equipo, $activo, $tipo, $id_role, $id_puesto;

    // Para los Select con busqueda
    public $roles, $roleSelectedId, $roleSelectedName;
    public $positions, $positionSelectedId, $positionSelectedName;

    public $user_auth;
	private $pagination = 3;
	public function mount(Activities $act)
	{
        $this->user_auth = auth()->user()->id;
        $this->activities = $act;

		$this->componentName    = 'Usuarios';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;
        $this->id_puesto        = 'ELEGIR_PUESTO';
        $this->id_role          = 'ELEGIR_ROL';
        // $this->email            = 'test@test.com';

        $this->roles            = [];
        $this->positions        = [];
	}
    public function render()
	{
		// if (strlen($this->search) > 0) {
            // 	$data = User::where('name', 'like', '%' . $this->search . '%')
            // 		->paginate($this->pagination);
            // } else {
			// $users = User::query()->select('alias','name','surname','email','path_foto_perfil',
            // 'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto')
            //     ->with('role:id,name,estatus,id_role_tipo','position:id,nombre,descripcion')
            //     ->orderBy('id', 'desc')
			// 	->paginate($this->pagination);
		// }

        $data = User::query()->select('id','alias','name','surname','email','path_foto_perfil',
            'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto')
                ->with('role:id,name,estatus,id_role_tipo','position:id,nombre,descripcion')
                ->orderBy('id', 'asc')
				->paginate($this->pagination);

        // foreach ($data as $key => $value) {
            //     $data[$key]['image'] = $this->activities->getImageRoute($value['path_foto_perfil']);
            // }
        $this->roles = Role::orderBy('name', 'asc')->get();
        $this->positions = Puesto::orderBy('nombre', 'asc')->get();
		return view('livewire.users.component', [
            'data'      => $data,
            // 'puestos'   => $puestos,
            // 'roles'     => $roles,
            ])
			->extends('layouts.theme.app')
            // ->layoutData(['data' => $data])
			->section('content');
	}
    public function store()
    {

    }

    public function edit($id)
    {
        error_log('edit');
        $user = User::find($id);
        if (isset($user)) {
            $this->selected_id  = $user->id;
            $this->name         = $user->name;
            $this->surname      = $user->surname;
            $this->email        = $user->email;
            $this->activo       = $user->activo == 1 ? true : false;
            $this->tipo         = $user->tipo;

            $this->id_puesto    = $user->id_puesto;
            $this->id_role      = $user->id_role;
            // dd($user);
            $this->dispatch('item-modal-edit', title: 'Mostar modal del Registro!');
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

            'id_puesto'   => 'required|not_in:ELEGIR_PUESTO',
            'id_role'     => 'required|not_in:ELEGIR_ROL',
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
            'id_role.required'    => 'Secciona el perfil/rol del usuario',
            'id_role.not_in'      => 'El campo debe ser diferente de Selecciona un perfil',
        ];
        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);
        $user->update([
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
    // Ya no son necesarios
    protected $listeners = [
        // 'deleteRow' => 'destroy',
        'resetUI' => 'resetUI',
    ];

    public function destroy($id)
    {
        error_log('destroy');
        $data_user = User::find($id);
        if ($this->user_auth === $data_user->id) {
            $this->dispatch('item-error', 'No puedes eliminar tu propio usuario!');
            return;
        }
        if (isset($data_user)) {
            // dd($data_user);
            $data_user->delete();
            $this->resetUI();
            $this->dispatch('item-deleted','Usuario Eliminado!');
        }else {
            $this->dispatch('item-error','No existe el registro!');
        }
    }
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
        $this->id_puesto        = 'ELEGIR_PUESTO';
        $this->id_role          = 'ELEGIR_ROL';
        $this->resetValidation();
        // $this->resetPage();
    }
}
