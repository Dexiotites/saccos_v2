<?php

namespace App\Http\Livewire\HR;


use Livewire\Component;


use App\Models\Employee;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class EmployeesTable extends LivewireDatatable
{

    protected $listeners = ['refreshMembersTable' => '$refresh'];
    public $exportable = true;

    public function boot(){
        Session::put('memberStatus',null);
    }


    public function builder()
    {
        $memberStatus = '';
        if (Session::get('memberSearchTerm') == '') {
            $memberStatus = Session::get('memberStatus');
            if ($memberStatus == 'All') {
                return Employee::query()->leftJoin('branches', 'branches.id', 'employees.branch');
            } else {
                return Employee::query()->where('employee_status', $memberStatus)->leftJoin('branches', 'branches.id', 'employees.branch');
            }

        } else {
            $memberStatus = Session::get('memberStatus');
            if ($memberStatus == 'All') {
                return Employee::query()->leftJoin('branches', 'branches.id', 'employees.branch')->search(Session::get('memberSearchTerm'));
            } else {
                return Employee::query()->where('employee_status', $memberStatus)->leftJoin('branches', 'branches.id', 'employees.branch')->search(Session::get('memberSearchTerm'));
            }


        }

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
        return [

            Column::name('employee_id')
                ->label('Employee Number'),

            Column::raw('CONCAT(first_name, " ", last_name) AS planetName')
                ->label('Name'),

            Column::name('branch')
                ->label('Branch'),

            Column::name('department')
                ->label('Department'),

            Column::name('job_title')
                ->label('Title'),

            Column::name('phone')
                ->label('Phone Number'),

            Column::name('employee_status')
                ->label('Status'),

            Column::callback(['employee_id', 'first_name'], function ($id, $name) {
                return view('livewire.members.table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }


}
