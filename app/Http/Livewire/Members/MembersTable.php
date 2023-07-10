<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;


use App\Models\MembersModel;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class MembersTable extends LivewireDatatable
{

    protected $listeners = ['refreshMembersTable' => '$refresh'];
    public $exportable = true;


    public function builder()
    {
        return MembersModel::query();
        //->leftJoin('branches', 'branches.id', 'members.branch')
    }

    public function viewMember($memberId){
        Session::put('memberToViewId',$memberId);
        $this->emit('refreshMembersListComponent');
    }
    public function editMember($memberId,$name){
        Session::put('memberToEditId',$memberId);
        Session::put('memberToEditName',$name);
        $this->emit('refreshMembersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [

            Column::name('first_name')
                ->label('first name'),

            Column::name('middle_name')
                ->label('middle name'),

            Column::name('branch')
                ->label('branch'),

            Column::name('phone_number')
                ->label('phone number'),

                Column::name('membership_number')
                ->label('membership number'),


                Column::callback(['member_status'], function ($status) {
                    return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
                })->label('status'),

                Column::callback(['id'], function ($id) {
                    return view('livewire.branches.list-action', ['id' => $id, 'move' => false]);
                })->unsortable()->label('Action'),

        ];
    }

    public function edit($id){
        $this->emitUp('editMember',$id);
        }

        public function block($id){
        $this->emitUp('blockMember',$id);
        }


}