<?php

namespace App\Http\Livewire\Branches;


use App\Models\approvals;
use App\Models\BranchesModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\NodesList;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BranchesList extends LivewireDatatable
{

    use WithFileUploads;

    public $exportable = true;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return BranchesModel::query(); // You can modify the ordering as per your requirement
    }

    public function columns(): array
    {
        return [
            Column::name('id')->label('ID'),
            Column::name('name')->label('Name'),
            Column::name('region')->label('Region'),

            Column::name('membershipNumber')->label('Membership Number'),
            Column::name('phone_number')->label('Contacts'),

            Column::callback(['branch_status'], function ($status) {
                return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
            })->label('status'),

            Column::callback(['id'], function ($id) {
                return view('livewire.branches.list-action', ['id' => $id, 'move' => false]);
            })->unsortable()->label('Action'),
        ];
    }

    public function edit($id){
    $this->emitUp('editBranch',$id);
    }

    public function block($id){
    $this->emitUp('blockBranch',$id);
    }

}