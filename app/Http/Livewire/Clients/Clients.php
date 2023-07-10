<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;


use App\Models\institutions;

class Clients extends Component
{


    public $totalClients;
    public $inActiveClients;
    public $clients;
    public $selected;
    public $changeView;

    public function boot(){
        $this->totalClients = \App\Models\institutions::count();
        $this->inActiveClients = \App\Models\institutions::where('STATUS', 'INACTIVE')->count();
        $this->selected = 1;
    }

    public function setView($page){
        $this->selected = $page;
    }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->clients = \App\Models\institutions::get();
        return view('livewire.clients.clients');
    }
}
