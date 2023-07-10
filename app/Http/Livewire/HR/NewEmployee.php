<?php

namespace App\Http\Livewire\HR;

use App\Models\Employee;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
use App\Models\Members;
use App\Models\AccountsModel;
use App\Models\Branches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\approvals;
use App\Models\TeamUser;

class NewEmployee extends Component
{


    use WithFileUploads;

    public $photo;
    public $branch_id;
    public $Employment_type = 'Permanent';
    public $first_name;
    public $middle_name;
    public $last_name;
    public $street;
    public $address;
    public $notes;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $email;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $place_of_birth;
    public $tin_number;
    public $nida_number;
    public $phone_number;
    public $gross_salary;



    public function boot(){

        $this->branches = Branches::get();


    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',// 1MB Max
        ]);
    }

    public function save()
    {


        $imageUrl = '';

//            $this->validate([
//                'first_name'=> 'required|min:3',
//                'last_name'=> 'required|min:3',
//                'Employment_type'=> 'required|min:3',
//                'phone_number'=> 'required|min:3',
//                'date_of_birth'=> 'required|min:3',
//                'gender'=> 'required|min:2',
//                'marital_status'=> 'required|min:3',
//                'place_of_birth'=> 'required|min:3',
//                'street'=> 'required|min:3',
//                'address' => 'required|min:3',
//                'notes' => 'required|min:3',
//                'email' => 'required|min:1',
//                'next_of_kin_name'=> 'required|min:3',
//                'next_of_kin_phone'=> 'required|min:3',
//                'tin_number'=> 'required|min:3',
//                'nida_number' => 'required|min:3',
//                'branch_id' => 'required|min:3',
//                'gross_salary' => 'required|min:3',
//
//            ]);


        if($this->photo){
            $imageUrl = $this->photo->store('avatars', 'public');
        }

        $last_member= Employee::latest()->first();
        if($last_member){
            $last_member_id = $last_member->id;
            $last_member_id = $last_member_id  + 1;
            $newMemberId = $this->branch_id.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }else{
            $last_member_id = 0;
            $last_member_id = $last_member_id  + 1;
            $newMemberId = $this->branch_id.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }

        $idx = auth()->user()->id;


        $id =  Employee::create([

            'first_name'=> $this->first_name,

            'middle_name'=> $this->middle_name,

            'last_name'=> $this->last_name,

            'branch'=> $this->branch_id,

            'email'=> $this->email,

            'phone'=> $this->phone_number,

            'job_title'=> $this->branch_id,

            'department'=> $this->branch_id,

            'salary'=> $this->gross_salary,



            'Employment_type'=> $this->Employment_type,
            'date_of_birth'=> $this->date_of_birth,
            'gender'=> $this->gender,
            'marital_status'=> $this->marital_status,
            'employee_number'=> $newMemberId,
            'street'=> $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'profile_photo_path' => $imageUrl,
            'registering_officer' => $idx,
            'place_of_birth' => $this->place_of_birth,
            'next_of_kin_name'=> $this->next_of_kin_name,
            'next_of_kin_phone'=> $this->next_of_kin_phone,
            'tin_number'=> $this->tin_number,
            'nida_number' => $this->nida_number,


        ])->id;

        $this->sendApproval($id,'has registered a new employee','22');


        $this->resetData();

        Session::flash('message', 'A new Employee has been successfully created!');
        Session::flash('alert-class', 'alert-success');

    }

    public function resetData()
    {

        $this->first_name = null;

        $this->middle_name = null;

        $this->last_name = null;

        $this->email = null;

        $this->phone_number = null;

        $this->branch_id = null;

        $this->gross_salary = null;



        $this->Employment_type = null;
        $this->date_of_birth = null;
        $this->gender = null;
        $this->marital_status = null;

        $this->street = null;
        $this->address = null;
        $this->notes = null;

        $this->place_of_birth = null;
        $this->next_of_kin_name = null;
        $this->next_of_kin_phone = null;
        $this->tin_number = null;
        $this->nida_number = null;

        $this->photo = null;

    }

    public function back(){

        Session::put('memberNameInView', '');
        Session::put('memberIdInView', '');
        Session::put('showAddMember', false);
        $this->emit('refreshMembersListComponent');
    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createEmployee',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);

    }



    public function render()
    {
        return view('livewire.h-r.new-employee');
    }
}
