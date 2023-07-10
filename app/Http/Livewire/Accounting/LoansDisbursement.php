<?php

namespace App\Http\Livewire\Accounting;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LoansDisbursement extends Component
{

    protected $listeners = ['currentloanID' => '$refresh'];

    public function close(){
        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
    }


    public function render()
    {
        return view('livewire.accounting.loans-disbursement');
    }
}
