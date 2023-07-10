<?php

namespace App\Http\Livewire\Loans;

use App\Models\LoansModel;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

use App\Models\approvals;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;

class LoansStatus extends Component
{

    public $showLoanDetails;

    protected $listeners = ['currentloanID' => '$refresh'];

    public $activeTab = 'member';

    public function showTab($tab)
    {
        $this->activeTab = $tab;

    }


    public function render()
    {
        return view('livewire.loans.loans-status');
    }
    public function close(){
        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
    }


    public function delete($id){
        LoansModel::where('id',$id)->delete();
    }

    public function commit($id){
        LoansModel::where('id',$id)->update(['status'=>'On progress']);
    }

    public function approve($id){
        LoansModel::where('id',$id)->update(['status'=>'Pending']);
        $this->sendApproval($id,'has requested for approval of a new loan','11');
    }

    public function reject($id){
        LoansModel::where('id',$id)->update(['status'=>'Rejected']);
    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createBranch',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);

    }

}
