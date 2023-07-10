<?php

namespace App\Http\Livewire\Loans;

use Livewire\Component;


use App\Models\issured_shares;
use App\Models\LoansModel;
use App\Models\Members;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class LoansTable extends LivewireDatatable
{

    protected $listeners = ['refreshSavingsComponent' => '$refresh'];
    public $exportable = true;


    public function builder()
    {


        return LoansModel::query();


        //dd(Session::get('sharesViewItem'));

        // if(Session::get('viewLoansWithCategory') == 'Progress'){

        //     return LoansModel::query()
        //         ->leftJoin('loan_sub_products', 'loan_sub_products.product_id', 'loans.loan_sub_product')
        //         ->leftJoin('members', 'members.membership_number', 'loans.member_number');

        // }elseif(Session::get('viewLoansWithCategory') == 'Committee') {

        //     return LoansModel::query()
        //         ->leftJoin('loan_sub_products', 'loan_sub_products.product_id', 'loans.loan_sub_product')
        //         ->leftJoin('members', 'members.membership_number', 'loans.member_number')
        //         ->where('status','Awaiting Approval')
        //         ->orWhere('status','Restructured')
        //         ->orWhere('status','Top Up');
        // }elseif(Session::get('viewLoansWithCategory') == 'Accounting') {

        //     return LoansModel::query()
        //         ->leftJoin('loan_sub_products', 'loan_sub_products.product_id', 'loans.loan_sub_product')
        //         ->leftJoin('members', 'members.membership_number', 'loans.member_number')
        //         ->where('status','Approved');
        // }else{

        //     return LoansModel::query()
        //         ->leftJoin('loan_sub_products', 'loan_sub_products.product_id', 'loans.loan_sub_product')
        //         ->leftJoin('members', 'members.membership_number', 'loans.member_number');

        // }




    }

    public function viewMember($memberId)
    {

        Session::put('memberToViewId', $memberId);
        $this->emit('refreshMembersListComponent');
    }

    public function editMember($memberId, $name)
    {
        Session::put('memberToEditId', $memberId);
        Session::put('memberToEditName', $name);
        $this->emit('refreshMembersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {

//        Session::put('currentloanMember',null);
//        Session::put('currentloanMember',null);
//        Session::put('currentloanID',null);

        $html =null;

        return [


            Column::callback(['member_number'], function ($member_number) {

                return Members::where('membership_number',$member_number)->value('first_name').' '.Members::where('membership_number',$member_number)->value('middle_name').' '.Members::where('membership_number',$member_number)->value('last_name');
            })->label('Member name'),

            Column::callback(['guarantor'], function ($guarantor) {

                return Members::where('membership_number',$guarantor)->value('first_name').' '.Members::where('membership_number',$guarantor)->value('middle_name').' '.Members::where('membership_number',$guarantor)->value('last_name');
            })->label('Guarantor'),

        Column::name('loan_id')
            ->label('loan id'),

        Column::name('loan_account_number')
            ->label('loan account number'),


        Column::name('principle')
            ->label('principle'),

        Column::name('interest')
            ->label('interest'),

        Column::name('status')
            ->label('Status'),

            Column::callback(['id'], function ($id) use ($html) {
                //$status = 1;
                $member_number = LoansModel::where('id',$id)->value('member_number');
                $status = LoansModel::where('id',$id)->value('status');

                if($status == 'Pending'){
                    $status = 1;
                }elseif ($status == 'Awaiting Approval'){
                    $status = 2;
                }
                elseif ($status == 'Approved'){
                    $status = 3;
                }
                elseif ($status == 'Restructured'){
                    $status = 4;
                }
                elseif ($status == 'Top Up'){
                    $status = 5;
                }
                elseif ($status == 'Active'){
                    $status = 6;
                }
                elseif ($status == 'Rejected'){
                    $status = 7;
                }
                elseif ($status == 'Recovery'){
                    $status = 8;
                }else{
                    $status = 1;
                }


                $html = '<div class="w-full">
                            <button wire:click="viewloan('.$id.','.$member_number.','.$status.')" class=" m-2 py-2 px-4 text-sm font-medium text-center text-gray-900
                            bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4
                            focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600
                            dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            </div> ';

                return $html;
            })->label('view'),

        ];



    }


    public function viewloan($id,$member_number,$status){

        if($status == 1){
            Session::put('loanStatus','Pending');
        }elseif ($status == 2){
            Session::put('loanStatus','Awaiting Approval');
        }
        elseif ($status == 3){
            Session::put('loanStatus','Approved');
        }
        elseif ($status == 4){
            Session::put('loanStatus','Restructured');
        }
        elseif ($status == 5){
            Session::put('loanStatus','Top Up');
        }
        elseif ($status == 6){
            Session::put('loanStatus','Active');
        }
        elseif ($status == 7){
            Session::put('loanStatus','Rejected');
        }
        elseif ($status == 8){
            Session::put('loanStatus','Recovery');
        }else{
            Session::put('loanStatus','Pending');
        }

        if ($status == 1){
            Session::put('disableInputs',false);
        }else{
            Session::put('disableInputs',true);
        }

        Session::forget('currentloanMember');
        Session::forget('currentloanID');


        Session::put('currentloanMember',$member_number);
        Session::put('currentloanID',$id);
        $this->emit('currentloanID');
        $this->emit('viewMemberDetails');
    }



}
