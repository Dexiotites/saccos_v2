<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use App\Models\Members;
use Illuminate\Support\Facades\Session;

class MemberView extends Component
{

    public $member;


    public $member_number = '';
    public $item = 100;
    public $product_number;

    public function boot(){

        $this->member = Members::where('id', Session::get('memberToViewId'))->get();
    }

    public function render()
    {
        return view('livewire.members.member-view');
    }

    public function back(){



        Session::put('memberToViewId', false);
        $this->emit('refreshMembersListComponent');
    }
}
