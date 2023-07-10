<?php

namespace App\Http\Livewire\ProductsManagement;

use Livewire\Component;

class Loans extends Component
{

    protected $listeners = ['refreshProductListComponent' => '$refresh'];
    
    public function render()
    {
        return view('livewire.products-management.loans');
    }
}
