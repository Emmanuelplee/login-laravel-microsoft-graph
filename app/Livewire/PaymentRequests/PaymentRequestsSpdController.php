<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PaymentRequestsSpdController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $user_auth,$showModal;
    public $selected_id;
    public $stepTable;

    // ~ Otras propiedades
    // public $properties;
    public function mount()
	{
		$this->componentName    = 'Solicitudes de pago';
		$this->pageTitle        = 'Listado';
        $this->user_auth        = auth()->user();
        $this->showModal        = false;

        $this->selected_id      = 0;
        $this->stepTable        = 1; // Mostrar principal por defecto
        // ~ Otras propiedades
        // $this->properties = [];
    }
    public function render()
    {
        return view('livewire.payment-requests.payment-requests-spd-component',
        [
            'data' => 'Hola desde Solicitudes de pago',
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    #[On('resetUI')]
    public function resetUI()
    {
        error_log('resetUI');
        $this->selected_id      = 0;
        $this->showModal        = false;
        // ~ Otras propiedades
        // $this->properties       = [];
    }
}
