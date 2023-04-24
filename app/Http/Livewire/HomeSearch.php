<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeSearch extends Component
{
    public string $search;

    public function render()
    {
        return view('livewire.home-search');
    }

    public function searchQuery()
    {
        $this->emit('searchMethod',$this->search);
    }
}
