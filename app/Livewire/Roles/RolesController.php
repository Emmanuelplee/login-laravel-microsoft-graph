<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class RolesController extends Component
{
    use WithFileUploads;
	use WithPagination;


    public $pageTitle, $componentName, $search;


    public $selected_id, $name;


    public $user_auth;
	private $pagination = 3;

    public function mount()
	{
        $this->user_auth = auth()->user()->id;

		$this->componentName    = 'Roles';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;
	}
    public function render()
    {
        $data = Role::query()->take(10);
        return view('livewire.roles.roles-component', [
            'data'      => $data,
            ])
			->extends('layouts.theme.app')
			->section('content');
    }
}
