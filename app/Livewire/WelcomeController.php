<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class WelcomeController extends Component
{
    public $pageTitle, $componentName, $search;

    public function mount()
    {
        $this->componentName    = 'Inicio';
		$this->pageTitle        = 'Principal';
    }
    public function render()
    {
        $user_auth = auth()->user();
        $user = User::find($user_auth->id);
        $data = $user->only('alias','name','surname','email','path_foto_perfil',
                            'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto');
        return view('livewire.welcome-component', [
            'data'      => $data,
            ])
			->extends('layouts.theme.app')
            // ->layoutData(['data' => $data])
			->section('content');
    }
}
