<?php

namespace App\Http\Livewire\Dashboard;


use App\Models\Grant;
use App\Models\institutions;
use DOMDocument;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\sub_products;
use Illuminate\Support\Facades\Session;
use App\Models\issured_shares;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AccountsModel;
use App\Models\general_ledger;
use App\Models\Members;


use App\Models\approvals;
use App\Models\TeamUser;


class Dashboard extends Component
{

    public $tab_id = '1';
    public $title = 'Deposits report';

    public $term = "";
    public $showAddUser = false;
    public $memberStatus = 'All';
    public $numberOfProducts;
    public $products;
    public $item;

    public $member;
    public $product;
    public $number_of_shares;
    public $linked_savings_account;
    public $account_number;
    public $balance;
    public $deposit_charge_min_value;
    public $accountSelected;
    public $amount;
    public $notes;
    public $bank;
    public $reference_number;
    public $product_number;

    public $numberOfProducts1;
    public $products1;
    public $item1;

    public $member1;
    public $product1;
    public $number_of_shares1;
    public $linked_savings_account1;
    public $account_number1;
    public $balance1;
    public $deposit_charge_min_value1;
    public $accountSelected1;
    public $amount1;
    public $notes1;
    public $bank1;
    public $reference_number1;
    public $product_number1;
    public $ExternalAccounts;
    public $days;
    public $deposits;
    public $depositType;
    public $registrationFee;
    public $initial_shares_value;
    public $new_member_deposit_notes;
    public $results;

    protected $listeners = ['refreshMembersListComponent' => '$refresh'];


    public function visit($item)
    {

        Session::put('savingsViewItem', $item);
        $this->item = $item;
        $this->emit('refreshSavingsComponent');
    }

    public function boot()
    {
        $this->item = 1;

        $daysLoop = [];


        $date = date('F Y');//Current Month Year
        while (strtotime($date) <= strtotime(date('Y-m') . '-' . date('t', strtotime($date)))) {
            $day_num = date('j', strtotime($date));//Day number
            $day = $day_num;


            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));//Adds 1 day onto current date

            $daysLoop[] = $day;

        }

        $this->days = $daysLoop;

        $this->registrationFee = institutions::where('institution_id',Session::get('institution'))->value('application_fee');
        $initial_shares = institutions::where('institution_id',Session::get('institution'))->value('initial_shares');
        $value_per_share = institutions::where('institution_id',Session::get('institution'))->value('value_per_share');
        if($initial_shares && $value_per_share){
            $this->initial_shares_value = $initial_shares * $value_per_share;
        }

    }



    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Deposits report';
        }
        if ($tabId == '2') {
            $this->title = 'Enter new shares deposits';
        }
        if ($tabId == '3') {
            $this->title = 'Enter new shares deposits';
        }

    }


    protected $rules = [

        'bank' => 'required|min:1',
        'amount' => 'required|min:1',
        'account_number' => 'required|min:1',
    ];


    public function process(){


        if($this->member == 'new'){

            if($this->depositType=='RegistrationFee'){

                $this->dryDeposit(institutions::where('institution_id',Session::get('institution'))->value('fees_holding_account'),$this->registrationFee);
            }else{
                $this->dryDeposit(institutions::where('institution_id',Session::get('institution'))->value('temp_shares_holding_account'),$this->initial_shares_value);
            }


        }else{
            if($this->product_number == '12'){

                $this->saveSavings();
            }
            if($this->product_number == '13'){
                $this->saveDeposit();
            }
        }

    }

    public function process1(){
        $this->withDrawDeposits();

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


    public function saveSavings()
    {

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        $this->validate();

        $mirror_account = AccountsModel::where('account_number',$this->bank)->value('mirror_account');

        $savings_account_new_balance = (double)AccountsModel::where('account_number',$this->accountSelected)->value('balance') + (double)$this->amount;

        $savings_ledger_account_new_balance = (double)AccountsModel::where('account_number',$mirror_account)->value('balance') - (double)$this->amount;

        $partner_bank_account_new_balance = (double)AccountsModel::where('account_number',$this->bank)->value('balance') + (double)$this->amount;

        AccountsModel::where('account_number',$this->accountSelected)->update(['balance'=>$savings_account_new_balance]);
        AccountsModel::where('account_number',$mirror_account)->update(['balance'=>$savings_ledger_account_new_balance]);
        AccountsModel::where('account_number',$this->bank)->update(['balance'=>$partner_bank_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number'=> $this->accountSelected,
            'record_on_account_number_balance'=> $savings_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$mirror_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$mirror_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('sub_product_number'),
            'sender_id'=> '999999',
            'beneficiary_id'=> $this->member,
            'sender_name'=> 'Organization',
            'beneficiary_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $mirror_account,
            'beneficiary_account_number'=> $this->accountSelected,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->notes,
            'credit'=> (double)$this->amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        //CREDIT RECORD SHARE ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $this->bank,
            'record_on_account_number_balance'=> $partner_bank_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->accountSelected)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->bank)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->bank)->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'sender_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'sender_account_number'=> $this->accountSelected,
            'beneficiary_account_number'=> $this->bank,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->notes,
            'credit'=> (double)$this->amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number'=> $mirror_account,
            'record_on_account_number_balance'=> $savings_ledger_account_new_balance ,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$mirror_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$mirror_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('sub_product_number'),
            'sender_id'=> '999999',
            'beneficiary_id'=> $this->member,
            'sender_name'=> AccountsModel::where('account_number',$mirror_account)->value('account_name'),

            'beneficiary_name'=>  Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $mirror_account,
            'beneficiary_account_number'=> $this->accountSelected,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->notes,
            'credit'=> 0,
            'debit'=> (double)$this->amount,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);


        $this->sendApproval($id,'New savings transaction','06');

        $this->resetData();

        Session::flash('message1', 'Savings has been successfully deposited!');
        Session::flash('alert-class', 'alert-success');

    }

    public function saveDeposit()
    {

        $institution_id = '';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User) {
            $institution_id = $User->team_id;
        }

        $this->validate();

        $mirror_account = AccountsModel::where('account_number', $this->bank)->value('mirror_account');

        $savings_account_new_balance = (double)AccountsModel::where('account_number', $this->accountSelected)->value('balance') + (double)$this->amount;

        $savings_ledger_account_new_balance = (double)AccountsModel::where('account_number', $mirror_account)->value('balance') - (double)$this->amount;

        $partner_bank_account_new_balance = (double)AccountsModel::where('account_number', $this->bank)->value('balance') + (double)$this->amount;

        AccountsModel::where('account_number', $this->accountSelected)->update(['balance' => $savings_account_new_balance]);
        AccountsModel::where('account_number', $mirror_account)->update(['balance' => $savings_ledger_account_new_balance]);
        AccountsModel::where('account_number', $this->bank)->update(['balance' => $partner_bank_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $this->accountSelected,
            'record_on_account_number_balance' => $savings_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,
            'sender_product_id' => AccountsModel::where('account_number', $mirror_account)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $mirror_account)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $this->accountSelected)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->accountSelected)->value('sub_product_number'),
            'sender_id' => '999999',
            'beneficiary_id' => $this->member,
            'sender_name' => 'Organization',
            'beneficiary_name' => Members::where('membership_number', $this->member)->value('first_name') . ' ' . Members::where('membership_number', $this->member)->value('middle_name') . ' ' . Members::where('membership_number', $this->member)->value('last_name'),
            'sender_account_number' => $mirror_account,
            'beneficiary_account_number' => $this->accountSelected,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $this->notes,
            'credit' => (double)$this->amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => null,
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank)->value('account_name'),
            'partner_bank_account_number' => $this->bank,
            'partner_bank_transaction_reference_number' => $this->reference_number,
        ]);

        //CREDIT RECORD SHARE ACCOUNT
        general_ledger::create([
            'record_on_account_number' => $this->bank,
            'record_on_account_number_balance' => $partner_bank_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,
            'sender_product_id' => AccountsModel::where('account_number', $this->accountSelected)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $this->accountSelected)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $this->bank)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->bank)->value('sub_product_number'),
            'sender_id' => $this->member,
            'beneficiary_id' => AccountsModel::where('account_number', $this->bank)->value('institution_number'),
            'sender_name' => Members::where('membership_number', $this->member)->value('first_name') . ' ' . Members::where('membership_number', $this->member)->value('middle_name') . ' ' . Members::where('membership_number', $this->member)->value('last_name'),
            'beneficiary_name' => AccountsModel::where('account_number', $this->bank)->value('account_name'),
            'sender_account_number' => $this->accountSelected,
            'beneficiary_account_number' => $this->bank,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $this->notes,
            'credit' => (double)$this->amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => null,
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank)->value('account_name'),
            'partner_bank_account_number' => $this->bank,
            'partner_bank_transaction_reference_number' => $this->reference_number,
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number' => $mirror_account,
            'record_on_account_number_balance' => $savings_ledger_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,
            'sender_product_id' => AccountsModel::where('account_number', $mirror_account)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $mirror_account)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $this->accountSelected)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->accountSelected)->value('sub_product_number'),
            'sender_id' => '999999',
            'beneficiary_id' => $this->member,
            'sender_name' => AccountsModel::where('account_number', $mirror_account)->value('account_name'),

            'beneficiary_name' => Members::where('membership_number', $this->member)->value('first_name') . ' ' . Members::where('membership_number', $this->member)->value('middle_name') . ' ' . Members::where('membership_number', $this->member)->value('last_name'),
            'sender_account_number' => $mirror_account,
            'beneficiary_account_number' => $this->accountSelected,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $this->notes,
            'credit' => 0,
            'debit' => (double)$this->amount,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => null,
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank)->value('account_name'),
            'partner_bank_account_number' => $this->bank,
            'partner_bank_transaction_reference_number' => $this->reference_number,
        ]);

        $this->sendApproval($id,'New deposit transaction','07');

        $this->resetData();

        Session::flash('message', 'Funds deposited successfully!');
        Session::flash('alert-class', 'alert-success');

    }

    public function withDrawDeposits()
    {


        $institution_id = '';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User) {
            $institution_id = $User->team_id;
        }

        //$this->validate();

        $mirror_account = AccountsModel::where('account_number', $this->bank1)->value('mirror_account');

        $savings_account_new_balance = (double)AccountsModel::where('account_number', $this->accountSelected1)->value('balance') + (double)$this->amount1;

        $savings_ledger_account_new_balance = (double)AccountsModel::where('account_number', $mirror_account)->value('balance') - (double)$this->amount1;

        $partner_bank_account_new_balance = (double)AccountsModel::where('account_number', $this->bank1)->value('balance') + (double)$this->amount1;

        AccountsModel::where('account_number', $this->accountSelected1)->update(['balance' => $savings_account_new_balance]);
        AccountsModel::where('account_number', $mirror_account)->update(['balance' => $savings_ledger_account_new_balance]);
        AccountsModel::where('account_number', $this->bank1)->update(['balance' => $partner_bank_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $this->accountSelected1,
            'record_on_account_number_balance' => $savings_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,

            'sender_product_id' => AccountsModel::where('account_number', $this->accountSelected1)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $this->accountSelected1)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $mirror_account)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $mirror_account)->value('sub_product_number'),
            'sender_id' => $this->member1,
            'beneficiary_id' => '999999',
            'sender_name' => Members::where('membership_number', $this->member1)->value('first_name') . ' ' . Members::where('membership_number', $this->member1)->value('middle_name') . ' ' . Members::where('membership_number', $this->member1)->value('last_name'),
            'beneficiary_name' =>'Organization',
            'sender_account_number' => $this->accountSelected1,
            'beneficiary_account_number' => $mirror_account,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $this->notes1,
            'credit' => 0,
            'debit' => (double)$this->amount1,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => null,
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $this->reference_number1,
        ]);

        //CREDIT RECORD SAVINGS ACCOUNT
        general_ledger::create([
            'record_on_account_number' => $this->bank1,
            'record_on_account_number_balance' => $partner_bank_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,

            'sender_product_id' => AccountsModel::where('account_number', $this->bank1)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $this->bank1)->value('sub_product_number'),

            'beneficiary_product_id' => AccountsModel::where('account_number', $this->accountSelected1)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->accountSelected1)->value('sub_product_number'),
            'sender_id' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'beneficiary_id' => $this->member1,

            'sender_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'beneficiary_name' => Members::where('membership_number', $this->member1)->value('first_name') . ' ' . Members::where('membership_number', $this->member1)->value('middle_name') . ' ' . Members::where('membership_number', $this->member1)->value('last_name'),
            'sender_account_number' => $this->bank1,
            'beneficiary_account_number' =>$this->accountSelected1,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $this->notes1,
            'credit' => 0,
            'debit' => (double)$this->amount1,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => null,
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $this->reference_number1,
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number' => $mirror_account,
            'record_on_account_number_balance' => $savings_ledger_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,

            'sender_product_id' => AccountsModel::where('account_number', $this->accountSelected1)->value('product_number'),
            'sender_sub_product_id' =>AccountsModel::where('account_number', $this->accountSelected1)->value('sub_product_number'),

            'beneficiary_product_id' => AccountsModel::where('account_number', $mirror_account)->value('product_number'),
            'beneficiary_sub_product_id' =>  AccountsModel::where('account_number', $mirror_account)->value('sub_product_number'),
            'sender_id' => $this->member1,
            'beneficiary_id' => '999999',
            'sender_name' => Members::where('membership_number', $this->member1)->value('first_name') . ' ' . Members::where('membership_number', $this->member1)->value('middle_name') . ' ' . Members::where('membership_number', $this->member1)->value('last_name'),

            'beneficiary_name' => AccountsModel::where('account_number', $mirror_account)->value('account_name'),
            'sender_account_number' => $this->accountSelected1,
            'beneficiary_account_number' => $mirror_account,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $this->notes1,
            'credit' => (double)$this->amount1,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => null,
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $this->reference_number1,
        ]);

        $this->sendApproval($id,'New withDraw transaction','08');

        $this->resetData1();

        Session::flash('message2', 'Funds deposited successfully!');
        Session::flash('alert-class', 'alert-success');

    }

    public function resetData1()
    {
        // Reset the values of properties used in the function
        $this->bank1 = null;
        $this->accountSelected1 = null;
        $this->amount1 = null;
        $this->member1 = null;
        $this->notes1 = null;
        $this->reference_number1 = null;
    }

    public function dryDeposit($account,$amount)
    {

        //dd($amount);

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        //$this->validate();

        $mirror_account = AccountsModel::where('account_number',$this->bank)->value('mirror_account');

        $savings_account_new_balance = (double)AccountsModel::where('account_number',$account)->value('balance') + (double)$amount;

        $savings_ledger_account_new_balance = (double)AccountsModel::where('account_number',$mirror_account)->value('balance') - (double)$amount;

        $partner_bank_account_new_balance = (double)AccountsModel::where('account_number',$this->bank)->value('balance') + (double)$amount;

        AccountsModel::where('account_number',$account)->update(['balance'=>$savings_account_new_balance]);
        AccountsModel::where('account_number',$mirror_account)->update(['balance'=>$savings_ledger_account_new_balance]);
        AccountsModel::where('account_number',$this->bank)->update(['balance'=>$partner_bank_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number'=> $account,
            'record_on_account_number_balance'=> $savings_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$mirror_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$mirror_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$account)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$account)->value('sub_product_number'),
            'sender_id'=> '999999',
            'beneficiary_id'=> '0000',
            'sender_name'=> 'Organization',
            'beneficiary_name'=> $this->new_member_deposit_notes,
            'sender_account_number'=> $mirror_account,
            'beneficiary_account_number'=> $account,
            'transaction_type'=> 'DEPOSIT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->new_member_deposit_notes,
            'credit'=> (double)$amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        //CREDIT RECORD SHARE ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $this->bank,
            'record_on_account_number_balance'=> $partner_bank_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->bank)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->bank)->value('sub_product_number'),
            'sender_id'=> '0000',
            'beneficiary_id'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'sender_name'=> $this->new_member_deposit_notes,
            'beneficiary_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'sender_account_number'=> $account,
            'beneficiary_account_number'=> $this->bank,
            'transaction_type'=> 'DEPOSIT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->new_member_deposit_notes,
            'credit'=> (double)$amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number'=> $mirror_account,
            'record_on_account_number_balance'=> $savings_ledger_account_new_balance ,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$mirror_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$mirror_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$account)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$account)->value('sub_product_number'),
            'sender_id'=> '999999',
            'beneficiary_id'=> '0000',
            'sender_name'=> AccountsModel::where('account_number',$mirror_account)->value('account_name'),

            'beneficiary_name'=>  $this->new_member_deposit_notes,
            'sender_account_number'=> $mirror_account,
            'beneficiary_account_number'=> $account,
            'transaction_type'=> 'DEPOSIT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->new_member_deposit_notes,
            'credit'=> 0,
            'debit'=> (double)$amount,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);


        $this->sendApproval($id,'Processed a new member deposit transaction - '.$this->new_member_deposit_notes,'06');

        $this->resetData();

        Session::flash('message1', 'Successfully deposited!');
        Session::flash('alert-class', 'alert-success');

    }


    public function resetData()
    {
        $this->member = '';
        $this->product = '';
        $this->accountSelected = '';
        $this->amount = '';
        $this->account_number = '';
        $this->notes = '';
        $this->bank = '';
        $this->reference_number = '';


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
        $this->product_number = AccountsModel::where('account_number', $account)->value('product_number');
        //dd($this->product_number);
    }

    public function setAccount1($account){
        $this->accountSelected1 = $account;
        $this->product_number1 = AccountsModel::where('account_number', $account)->value('product_number');
        //dd($this->product_number);
    }



    public function updatedTerm(){
        // Perform the search operation based on the $term value
        session(['term' => $this->term]); // Store the current term in the session
        $this->emit('refreshTransactionsTable');

    }

    public function render()
    {

        $query = sub_products::where('product_id', 13);
        $this->products = $query->get();
        $this->numberOfProducts = $query->count();
        Session::put('userRole','Teller');



        return view('livewire.dashboard.dashboard');
    }
}
