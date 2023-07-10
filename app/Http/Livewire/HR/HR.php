<?php

namespace App\Http\Livewire\HR;

use Livewire\Component;

class HR extends Component
{


    public $tab_id = '1';
    public $title = 'Savings report';


    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Employee report';
        }
        if($tabId == '2'){
            $this->title = 'Enter new employee details';
        }
        if($tabId == '3'){
            $this->title = 'Enter new shares details';
        }
    }


    
    public function render()
    {
        return view('livewire.h-r.h-r');
    }
}
