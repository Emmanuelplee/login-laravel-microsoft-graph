<?php

namespace App\Livewire\Users;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class DynamicSelectController extends Component
{
    #[Modelable]
    public $selectedOption = '';

    public $idBox = '';
    public $options = [];
    public $nameLabel = '';
    public $optionDefault = '';

    public function mount($idBox,$options, $nameLabel, $optionDefault)
    {
        // $this->selectedOption = $selectedOption;
        $this->idBox = $idBox;
        $this->options = $options;
        $this->nameLabel = $nameLabel;
        $this->optionDefault = $optionDefault;
    }
    public function updated($propertyName)
    {
        if ($propertyName === 'selectedOption') {
            error_log('updated dynamic select');
            // $this->dispatch('changeOption', $this->selectedOption);
        }
    }
    public function render()
    {
        return view('livewire.users.dynamic-select-component');
    }
}
