<?php

namespace App\Livewire\Assign;

use Livewire\Component;
use App\Models\Permissions;

class AssignByUsersController extends Component
{
    public function render()
    {
        $data = Permissions::query()
            ->select('id', 'name', 'description')
            ->take(2)->get();
        return view('livewire.assign.assign-by-users-component',[
            'data' => $data,
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
