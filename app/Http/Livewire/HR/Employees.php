<?php


namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\grants;
use App\Models\Benefit;
use App\Models\Bonus;
use Illuminate\Http\Request;

class Employees extends Controller
{

    public $employees;


    public function render()
    {
        $employees = Employee::all();


        return view('livewire.h-r.employees', compact('employees'));
    }

    public function show(Employee $employee)
    {
        $employee->load([
            'absences' => function ($query) {
                $query->orderBy('absence_date', 'desc');
            },
            'benefits',
            'bonuses',
        ]);

        return view('employees.show', compact('employee'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());

        return redirect()->route('employees.show', $employee->id);
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('employees.show', $employee->id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }

    public function addAbsence(Request $request, Employee $employee)
    {
        $employee->absences()->create($request->all());

        return redirect()->route('employees.show', $employee->id);
    }
}
