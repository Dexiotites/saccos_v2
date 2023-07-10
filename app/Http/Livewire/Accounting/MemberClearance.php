<?php

namespace App\Http\Livewire\Accounting;

use App\Models\Branches;
use App\Models\Search;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

use App\Models\approvals;
use App\Models\TeamUser;
use App\Models\Members;
use Illuminate\Support\Facades\Auth;

class MemberClearance extends Component
{

    public $approvals;
    public $term = "";
    public $showAddUser = false;
    protected $listeners = ['refreshBranchesListComponent' => '$refresh'];



    public function clear ($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'clearance' => 'Yes'
        ]);

    }

    public function reject ($member,$approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'process_status' => 'Rejected'
        ]);

        Members::where('id', $member)->update([
            'member_status' => 'Rejected'
        ]);


    }


    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////

    public function render()
    {

        $institution = TeamUser::where('user_id', Auth::user()->id)->value('institution');
        $this->approvals = approvals::where('institution', $institution)
            ->where('process_status', 'Pending')
            ->where('process_code', '12')
            ->where('clearance', 'No')->get();


        return view('livewire.accounting.member-clearance');
    }
}

