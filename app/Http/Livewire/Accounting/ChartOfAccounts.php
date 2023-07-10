<?php

namespace App\Http\Livewire\Accounting;

use Livewire\Component;
use App\Models\AccountsModel;
use App\Models\sub_products;
use Illuminate\Support\Facades\Session;

use App\Models\approvals;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;


class ChartOfAccounts extends Component
{

    public $term = "";
    public $showAddUser = false;
    public $memberStatus = 'All';
    public $numberOfProducts;
    public $products;
    public $item;
    public $category;
    public $account_name;
    public $notes;
    public $account_number;
    public $createNewAccount;


    protected $rules = [
        'account_number' => 'required|min:9',
        'notes' => 'required|min:5',
        'account_name' => 'required|min:5',
        'category' => 'required|min:1',
    ];






    protected $listeners = ['refreshChartOfAccountsComponent' => '$refresh'];

    public function visit($item)
    {

        Session::put('savingsViewItem', $item);
        $this->item = $item;
        $this->emit('refreshSavingsComponent');
    }

    public function boot()
    {
        $this->item = 1;
    }

    public function render()
    {
        $query = sub_products::where('product_id', 12);
        $this->products = $query->get();
        $this->numberOfProducts = $query->count();
        if($this->notes && $this->account_name && $this->category){
            $this->account_number = $this->category.'11110'.rand(0000,9999);
        }


        return view('livewire.accounting.chart-of-accounts');
    }



    public function save()
    {

        $this->validate();

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        $id = AccountsModel::create([
            'account_use' => 'internal',
            'institution_number'=> $institution,
            'branch_number'=> '',
            'member_number'=> '',
            'product_number'=> '10',
            'sub_product_number'=> '10'.$this->category,
            'account_name'=> $this->account_name,
            'account_number'=> $this->account_number,
            'notes'=> $this->notes,

        ])->id;



        approvals::create([
            'institution' => $institution,
            'process_name' => 'createAccount',
            'process_description' => 'has added a new account',
            'approval_process_description' => 'has approved a new account',
            'process_code' => '04',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ''
        ]);


        $this->resetData();

        Session::flash('message', 'Account has been successfully saved!');
        Session::flash('alert-class', 'alert-success');

        $this->createNewAccount = false;

    }

    public function resetData()
    {
        $this->category = '';
        $this->account_name = '';
        $this->account_number = '';

    }

    public function back()
    {

        Session::put('memberNameInView', '');
        Session::put('memberIdInView', '');
        Session::put('showAddMember', false);
        $this->emit('refreshMembersListComponent');
    }

    public function setAccount($account){
        $this->accountSelected = $account;
    }

        public function showDiv(){
            $this->createNewAccount = true;
        }


}