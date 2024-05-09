<?php

namespace App\Livewire\Users;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class DynamicSelectController extends Component
{
    #[Modelable]
    public $selectedOption = '';

    public $options = [];
    public $nameLabel = '';
    public $optionDefault = '';

    public function mount($options, $nameLabel, $optionDefault)
    {
        // $this->selectedOption = $selectedOption;

        $this->options = $options;
        $this->nameLabel = $nameLabel;
        $this->optionDefault = $optionDefault;
    }
    // public function updated($propertyName)
    // {
    //     error_log('updated dynamic select');
    //     if ($propertyName === 'selectedOption') {
    //         $this->dispatch('changeOption', $this->selectedOption);
    //     }
    // }
    public function render()
    {
        return view('livewire.users.dynamic-select-component');
    }
}
