<?php

namespace App\Livewire\Assign;

use Livewire\Component;
use App\Models\Permissions;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class AssignByRolesController extends Component
{
    public $pageTitle, $componentName;
    public $selected_id, $name, $description;
    public $user_auth;

    public $tableControllerKey;// key refrescar RolesTableController
    public function mount()
	{
        $this->user_auth        = auth()->user()->id;
		$this->componentName    = 'Asignar permisos por rol';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;

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
        return view('livewire.assign.assign-by-roles-component',[
            'data' => $data,
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    // #[On('ActivityLog')]
    // public function ActivityLogRefresh($data)
    // {
    //     error_log('ActivityLogRefresh');
    //     error_log(json_encode($data));
    // }
}
