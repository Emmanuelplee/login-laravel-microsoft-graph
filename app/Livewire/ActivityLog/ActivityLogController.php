<?php

namespace App\Livewire\ActivityLog;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CustomActivity;

class ActivityLogController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $showModal;

    public $selected_id, $name;
    public $user_auth;

    public $stepTable;

    public $properties;

    public function mount()
	{
        $this->user_auth = auth()->user();

		$this->componentName    = 'Registro de Actividades';
		$this->pageTitle        = 'Listado';
        $this->selected_id      = 0;

        $this->showModal        = false;

        $this->stepTable        = 1; // Mostrar tableOne por defecto
        $this->properties       = [];
    }
    public function render()
    {
        return view('livewire.activity-log.activity-log-component',
        [
            'data' => CustomActivity::latest()->take(2)->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function propertiesShow($data)
    {
        error_log('propertiesShow');
        // error_log(json_encode($data));
        $this->properties = $data;
        if ($this->properties['id']) {
            $this->selected_id = $this->properties['id'];
            // dd($this->selected_id);
            $this->showModal = true;
            $this->stepTable = 1;
            $this->dispatch('item-modal-edit', title: '¡Mostrar modal show!');
            return;
        }else {
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }

    }
    #[On('resetUI')]
    public function resetUI()
    {
        error_log('resetUI');
        $this->selected_id      = 0;
        $this->showModal        = false;
        // ~ Otros propiedades
        // $this->properties       = [];
    }
}
