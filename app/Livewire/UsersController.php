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

    public $user_auth;
	private $pagination = 3;
	public function mount(Activities $act)
	{
        $this->user_auth = auth()->user();
        $this->activities = $act;

		$this->componentName    = 'Usuarios';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;
        $this->id_puesto        = 'elegir_puesto';
        $this->role             = 'elegir_rol';
        // $this->email            = 'test@test.com';
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
        $roles = Role::orderBy('name', 'asc')->get();
        $puestos = Puesto::orderBy('nombre', 'asc')->get();
		return view('livewire.users.component', [
            'data'      => $data,
            'puestos'   => $puestos,
            'roles'     => $roles,
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
        $user = User::find($id);
        if (isset($user)) {
            $this->selected_id  = $user->id;
            $this->name         = $user->name;
            $this->surname      = $user->surname;
            $this->email        = $user->email;
            $this->activo       = $user->activo;
            $this->tipo         = $user->tipo;
            // dd($user);
            $this->dispatch('item-modal-edit', title: 'Mostar modal del Registro!');
            return;
        }else {
            $this->dispatch('item-error', 'No existe el registro!');
            return;
        }
    }

    public function update($id)
    {

    }

    protected $listeners = [
        // 'deleteRow' => 'destroy',
        'resetUI' => 'resetUI',
    ];
    public function resetUI()
    {
        $this->selected_id      = 0;
        $this->name             = '';
        $this->surname          = '';
        $this->email            = '';
        $this->path_foto_perfil = '';
        $this->inicio_sesion    = '';
        $this->ip_equipo        = '';
        $this->activo           = 1;
        $this->tipo             = '';
        $this->role             = 'elegir_rol';
        $this->id_puesto        = 'elejir_puesto';
        $this->resetValidation();
        // $this->resetPage();
    }
}
