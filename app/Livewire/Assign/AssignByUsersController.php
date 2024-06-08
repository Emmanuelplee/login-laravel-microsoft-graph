<?php

namespace App\Livewire\Assign;

use App\Models\User;
use Livewire\Component;
use App\Models\Permissions;

use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\error;

class AssignByUsersController extends Component
{
    public $pageTitle, $componentName;
    public $selected_id , $userName, $roleName;
    public $user_auth;

    public $tableControllerKey;// key refrescar RolesTableController
    public function mount()
	{
        $this->user_auth        = auth()->user()->id;
		$this->componentName    = 'Asignar permisos por usuario';
		$this->pageTitle        = 'Listado';

        $this->selected_id      = 0;
        $this->userName         = '';
        $this->roleName         = '';

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
    public function render()
    {
        $data = Permissions::query()
            ->select('id', 'name', 'description',DB::raw("0 as checked"))
            ->take(2)->get();
        return view('livewire.assign.assign-by-users-component',[
            'data' => $data,
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    #[On('update-user')]
    public function getUser($user = 'ELEGIR')
    {
        error_log('updateUser -> getUser');
        error_log($user);
        if ($user == 'ELEGIR') {
            $this->selected_id = 0;
            $this->userName = '';
            $this->roleName = '';
        }else{
            $this->selected_id = $user;
            $u = User::find($user);
            // $this->userName = DB::table('users')->where('id', $user)->value('name');
            $this->userName = $u->name;
            $this->roleName = $u->my_role_is->name;
        }
    }
}
