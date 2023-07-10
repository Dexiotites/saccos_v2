<?php

namespace App\Http\Livewire\Loans;

use Livewire\Component;



use App\Models\Members;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\AccountsModel;
use App\Models\LoansModel;

class GuarantorInfo extends Component
{

    public $member;
    public $member_number = '';
    public $item = 100;
    public $product_number;

    public function render()
    {

        //4121201
        //$this->member = Members::where('membership_number', '4121201')->get();
        //$this->member_number = Session::get('currentloanMember');
        $this->member = Members::where('membership_number', trim(LoansModel::where('id',Session::get('currentloanID'))->value('guarantor')))->get();

        return view('livewire.loans.guarantor-info');
    }

    public function set()
    {

        LoansModel::where('id', Session::get('currentloanID'))->update([
            'guarantor' => $this->member_number
        ]);

    }

}
