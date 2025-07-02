<?php

namespace App\Livewire;

use Livewire\Component;
#[\Livewire\Attributes\On('setTrix')]

class Trix extends Component
{
    public string $value;

    public function mount($value = '')
    {
        $this->value = $value ?? '';
    }

    public function updatedValue($value)
    {
        $this->dispatch('valueUpdated', value: $value);
    }

    public function render()
    {
        return view('livewire.trix');
    }
}

