<?php

namespace App\Livewire\Common;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class SelectPositionsController extends Component
{
    #[Modelable]
    public $selected = '';

    public $options= [];
    public $filteredOptions = [];

    public $search = '';
    public function mount($options)
    {
        $this->options = $options;
        // $this->selected = $selected;
        // $this->selected = intval($selected);
        $this->filteredOptions = $options;

        $this->dispatch('mount', $this->getId());
    }
    public function updateSearchPositions()
    {
        error_log('updateSearchPositions');
        // Abrir el select con nuevas opciones
        $this->dispatch('focusSelect');
        $this->filteredOptions = collect($this->options)->filter(function ($item) {
            $search = strtolower($this->search);
            error_log($search);
            // dd($item);
            return stripos($item->name, $search) !== false;
        });
        // $this->resetPage();
    }

    public function resetPage()
    {
        $this->search = '';
    }
    public function render()
    {
        if ($this->search == '') {
            $this->filteredOptions = collect($this->options)->filter(function ($option) {
                return stripos($option->name, $this->search) !== false;
            });
        }
        return view('livewire.common.select-positions-controller', [
            // 'filteredOptions' => $filteredOptions
        ]);
    }
    public function searchOptions()
    {
        error_log($this->selected);
    }
    public function selectOption($option)
    {
        error_log(json_encode($option));
        // $this->selected = $option->id;
    }
}
