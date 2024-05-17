<?php

namespace App\Livewire\ReportPermissions;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ReportPermissionsController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName;

    public $selected_id, $name;

    public $user_auth;

    public function mount()
	{
        $this->user_auth = auth()->user()->id;

		$this->componentName    = 'Reporte de Permisos';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;
	}
    public function render()
    {
        return view('livewire.report-permissions.report-permissions-component')
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
