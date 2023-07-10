<?php

namespace App\Http\Livewire\Procurement;

use Livewire\Component;

class Procurement extends Component
{


    public $tab_id = '1';
    public $title = 'Procurement report';


    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Procurement report';
        }
        if ($tabId == '2') {
            $this->title = 'Enter new employee details';
        }
        if ($tabId == '3') {
            $this->title = 'Enter new shares details';
        }
    }


    public function render()
    {
        return view('livewire.procurement.procurement');
    }
}
