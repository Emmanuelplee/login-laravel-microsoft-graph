<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Puesto;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Repositories\Activities;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\error;

class UsersController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $search;
    public $selected_id = 0, $name, $surname, $email, $path_foto_perfil,
        $inicio_sesion, $ip_equipo, $activo, $tipo, $id_role, $id_puesto;

    // Para los Select con búsqueda
    public $roles;
    public $positions;

    public $user_auth;
	private $pagination = 3;
    public $showModal;

	public function mount()
	{
        $this->user_auth = auth()->user()->id;
        $this->activities = new Activities;

		$this->componentName    = 'Usuarios';
		$this->pageTitle        = 'Listado';
        // $this->selected_id      = 0;
        $this->id_puesto        = 'ELEGIR';
        $this->id_role          = 'ELEGIR';

        $this->roles            = [];
        $this->positions        = [];
	}
    #[On('changeOption')]
    public function updateSelects($value)
    {
        $this->dispatch('newPositionId', $value);
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

    public function updated(){
        $this->selected_id = $this->selected_id;
    }

    public function render()
	{
        $data = User::query()->select('id','alias','name','surname','email','path_foto_perfil',
            'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto')
            ->with('my_role_is:id,name,status,id_role_tipo','position:id,nombre,descripcion')
            ->orderBy('id', 'asc')
            ->get();
			// ->paginate($this->pagination);

        $this->roles = Role::orderBy('name', 'asc')->get();
        $this->positions = DB::table('puestos')->select(
                DB::raw('id AS id'),
                DB::raw('nombre AS name'),
            )
            ->orderBy('nombre', 'asc')
            ->get()
            ->toArray();
		return view('livewire.users.component', [
            'data'      => $data,
            // 'puestos'   => $puestos,// 'roles'     => $roles,
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
            $this->dispatch('item-modal-edit', title: 'Mostrar modal del Registro!');
            return;
        }else {
            $this->dispatch('item-error', 'No existe el registro!');
            return;
        }
    }
    #[On('afterEdit')]
    public function afterEdit() {
        error_log('afterEdit');
        $this->selected_id = $this->selected_id;
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
            'id_role'     => 'required|not_in:ELEGIR',
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

        // Obtener los datos originales
        $originalData = $user->only(['name', 'surname', 'activo', 'id_puesto', 'id_role']);
        // Datos actualizados
        $updatedData = [
            'name'      => $this->name,
            'surname'   => $this->surname,
            // 'email'     => $this->email,
            'activo'    => $this->activo,
            'id_puesto' => $this->id_puesto,
            'id_role'   => $this->id_role,
        ];

        // Obtener solo los datos modificados
        $dirtyData = array_diff_assoc($updatedData, $originalData);

        if (!empty($dirtyData)) {
            // * Deshabilitar el logging temporalmente ================================
            activity()->disableLogging();

            // Actualizar el usuario solo con los datos modificados
            $user->update($dirtyData);
            // Sincronizar roles si se ha cambiado el rol
            if($this->id_role != 'ELEGIR'){
                $user->syncRoles(intval($this->id_role));
            }
            // * Habilitar el logging nuevamente =====================================
            activity()->enableLogging();

            // Crear el formato de log deseado
            $logProperties = [
                'attributes' => $dirtyData,
                'old' => array_intersect_key($originalData, $dirtyData),
            ];
            // Registrar la actividad
            activity('usuario')
                ->causedBy(auth()->user())
                ->performedOn($user)
                ->withProperties($logProperties) // Registrar solo los datos modificados
                ->event('updated')
                ->log('Registro del usuario actualizado');
        }

        $this->resetUI();
        $this->dispatch('item-modal-updated', 'Registro Actualizado!');
    }
    #[On('destroy')]
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
        $this->id_role          = 'ELEGIR';
        $this->resetValidation();
        // $this->resetPage();
    }
}
