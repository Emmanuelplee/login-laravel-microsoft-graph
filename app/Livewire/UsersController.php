<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Repositories\Activities;

class UsersController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $selected_id, $name, $description, $image,
        $pageTitle, $componentName, $search;
    public $user_auth;

	private $pagination = 5;
	public function mount(Activities $act)
	{
        $this->user_auth = auth()->user();
        $this->activities = $act;

		$this->componentName = 'Usuarios';
		$this->pageTitle = 'Listado';
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

		return view('livewire.user.users', ['data' => $data])
			->extends('layouts.theme.app')
            // ->layoutData(['data' => $data])
			->section('content');
	}
}
