<?php

namespace App\Http\Livewire\Members;

use Exception;
use Livewire\Component;
use App\Models\MembersModel;
use App\Models\approvals;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Members extends Component
{
    use WithFileUploads;

    public $tab_id = '1';
    public $title = 'Members list';
    public $selected;
    public $activeMembersCount;
    public $inactiveMembersCount;
    public $showCreateNewMember;
    public $membershipNumber;
    public $parentMember;
    public $showDeleteMember;
    public $MemberSelected;
    public $showEditMember;
    public $pendingMember;
    public $MembersList;
    public $pendingMembername;
    public $Member;
    public $showAddMember;


    public $email;
    public $Member_status;
    public $permission = 'BLOCKED';
    public $password;

    public $photo;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $branch;
    public $registering_officer;
    public $supervising_officer;
    public $approving_officer;
    public $membership_type;
    public $incorporation_number;
    public $phone_number;
    public $mobile_phone_number;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $membership_number;
    public $registration_date;
    public $street;
    public $address;
    public $notes;
    public $current_team_id;
    public $profile_photo_path;
    public $branch_id;
    public $business_name;
    public $name;
    public $member;

    public $confirmingUserDeletion = false;

    public $branches;


    public $sub_product_number_shares ='1199';
    public $sub_product_number_savings='1279';
    public $sub_product_number_deposits='1321';
    public $place_of_birth;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $tin_number;
    public $nida_number;
    public $ref_number;
    public $shares_ref_number;


    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockMember' => 'blockMemberModal',
        'editMember' => 'editMemberModal'
        ];


        protected $rules = [
            'first_name'=> 'required|min:3',
            'last_name'=> 'required|min:3',
            'membership_type'=> 'required|min:3',
            'incorporation_number'=> 'required|min:3|unique:members',
            'mobile_phone_number'=> 'required|min:9|unique:members',
            'date_of_birth'=> 'required|min:3',
            'gender'=> 'required|min:2',
            'marital_status'=> 'required|min:3',
            'membership_number'=> 'required|min:3|unique:members',
            'street'=> 'required|min:3',
            'address' => 'required|min:3',
            'notes' => 'required|min:3',
            'business_name' => 'required|min:3',
        ];


        public function boot(){
            $this->branch = '1000';
        }

        public function updatedPhoto()
        {
            $this->validate([
                'photo' => 'image|max:1024',// 1MB Max
            ]);

            //$this->profile_photo_path = $this->photo->store('uploads');

            $path = $this->photo->store('photos', 'local');
            $path = str_replace("photos/", "", $path);
            $this->profile_photo_path = 'storage/' . $path;

            //$this->profile_photo_path = $this->photo->store('photos');

            //dd($this->profile_photo_path );
        }



    public function showAddMemberModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showAddMember = true;
    }

    public function updatedMember(){

        $memberData = MembersModel::where('id', $this->Member)->get();
        foreach ($memberData as $member) {
            $this->id = $member->id;
            $this->first_name = $member->first_name;
            $this->middle_name = $member->middle_name;
            $this->last_name = $member->last_name;
            $this->branch = $member->branch;
            $this->membership_type = $member->membership_type;
            $this->incorporation_number = $member->incorporation_number;
            $this->phone_number = $member->phone_number;
            $this->mobile_phone_number = $member->mobile_phone_number;
            $this->email = $member->email;
            $this->date_of_birth = $member->date_of_birth;
            $this->gender = $member->gender;
            $this->marital_status = $member->marital_status;
            $this->membership_number = $member->membership_number;
            $this->registration_date = $member->registration_date;
            $this->street = $member->street;
            $this->address = $member->address;
            $this->notes = $member->notes;
            $this->business_name = $member->business_name;
            $this->profile_photo_path = $member->profile_photo_path;
            $this->registering_officer = $member->registering_officer;
            $this->institution_id = $member->institution_id;
            $this->place_of_birth = $member->place_of_birth;
            $this->branch_id = $member->branch_id;
            $this->next_of_kin_name = $member->next_of_kin_name;
            $this->next_of_kin_phone = $member->next_of_kin_phone;
            $this->tin_number = $member->tin_number;
            $this->nida_number = $member->nida_number;
            $this->ref_number = $member->ref_number;
            $this->shares_ref_number = $member->shares_ref_number;

            // Perform further operations with the retrieved data as needed
            // For example, you can use these properties in your code
        }



    }





    public function updateMember()
    {

        $id = auth()->user()->id;

        //$this->validate();


        MembersModel::where('id', $this->Member)->update([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'branch' => $this->branch,
            'membership_type' => $this->membership_type,
            'incorporation_number' => $this->incorporation_number,
            'phone_number' => $this->phone_number,
            'mobile_phone_number' => $this->mobile_phone_number,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'membership_number' => $this->membership_number,
            'registration_date' => $this->registration_date,
            'street' => $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'business_name' => $this->business_name,
            'profile_photo_path' => $this->profile_photo_path,
            'registering_officer' => $this->registering_officer,
            'institution_id' => $this->institution_id,
            'place_of_birth' => $this->place_of_birth,
            'branch_id' => Session::get('branchIdInView'),
            'next_of_kin_name' => $this->next_of_kin_name,
            'next_of_kin_phone' => $this->next_of_kin_phone,
            'tin_number' => $this->tin_number,
            'nida_number' => $this->nida_number,
            'ref_number' => $this->ref_number,
            'shares_ref_number' => $this->shares_ref_number,
            'updated_at' => now()
        ]);



        $this->sendApproval($id,'has edited member information','12');

        $this->resetData();

        Session::flash('message', 'A new user has been successfully created!');
        Session::flash('alert-class', 'alert-success');

    }









    public function addMember()
    {


        if($this->membership_type == "Individual"){



            $this->validate([
                'first_name'=> 'required|min:3',
                'last_name'=> 'required|min:3',
                'membership_type'=> 'required|min:3',
            ]);
        }else{
            $this->validate([

                'membership_type'=> 'required|min:3',
                'incorporation_number'=> 'required|min:3|unique:members',


                'street'=> 'required|min:3',
                'address' => 'required|min:3',
                'notes' => 'required|min:3',
                'business_name' => 'required|min:3',
                'branch' => 'required|min:1',
            ]);
        }

        //dd("bb");

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }


        $last_member= MembersModel::latest()->first();
        if($last_member){
            $last_member_id = $last_member->id;
            $last_member_id = $last_member_id  + 1;
            $newMemberId = Session::get('branchIdInView').str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }else{
            $last_member_id = 0;
            $last_member_id = $last_member_id  + 1;
            $newMemberId = Session::get('branchIdInView').str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }


        $id =  MembersModel::create([

            'first_name'=> $this->first_name,
            'middle_name'=> $this->middle_name,
            'last_name'=> $this->last_name,
            'branch'=> $this->branch,
            'membership_type'=> $this->membership_type,
            'incorporation_number'=> $this->incorporation_number,
            'phone_number'=> $this->phone_number,
            'mobile_phone_number'=> $this->mobile_phone_number,
            'email' => $this->email,
            'date_of_birth'=> $this->date_of_birth,
            'gender'=> $this->gender,
            'marital_status'=> $this->marital_status,
            'membership_number'=> $newMemberId,
            'registration_date'=> $this->registration_date,
            'street'=> $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'business_name' => $this->business_name,
            'profile_photo_path' => $this->profile_photo_path,
            'registering_officer' => $id,
            'institution_id' => $institution_id,
            'place_of_birth' => $this->place_of_birth,
            'branch_id'=> Session::get('branchIdInView'),
            'next_of_kin_name'=> $this->next_of_kin_name,
            'next_of_kin_phone'=> $this->next_of_kin_phone,
            'tin_number'=> $this->tin_number,
            'nida_number' => $this->nida_number,
            'ref_number' => $this->ref_number,
            'shares_ref_number' => $this->shares_ref_number,
        ])->id;

        $this->sendApproval($id,'has registered a new member','12');

        $idx =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> '1001',
            'branch_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $newMemberId,
            'product_number'=> '11',
            'sub_product_number'=> '1101',
            'account_name'=> $this->first_name.' '.$this->middle_name.' '.$this->last_name,
            'account_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT).'111'.str_pad($last_member_id, 5, '0', STR_PAD_LEFT),

        ])->id;
        //$this->sendApproval($idx,'has created a new savings account','09');

        $idy =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> '1001',
            'branch_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $newMemberId,
            'product_number'=> '12',
            'sub_product_number'=> '1201',
            'account_name'=> $this->first_name.' '.$this->middle_name.' '.$this->last_name,
            'account_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT).'121'.str_pad($last_member_id, 5, '0', STR_PAD_LEFT),

        ])->id;
        //$this->sendApproval($idy,'has created a new amana account','09');


        $idz =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> '1001',
            'branch_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $newMemberId,
            'product_number'=> '13',
            'sub_product_number'=> '1301',
            'account_name'=> $this->first_name.' '.$this->middle_name.' '.$this->last_name,
            'account_number'=> str_pad($this->branch, 2, '0', STR_PAD_LEFT).'131'.str_pad($last_member_id, 5, '0', STR_PAD_LEFT),

        ])->id;
        //$this->sendApproval($idz,'has created a new deposit account','09');


        $this->resetData();

        Session::flash('message', 'A new user has been successfully created!');
        Session::flash('alert-class', 'alert-success');

        $this->showAddMember = false;

    }

    public function resetData()
    {
        $this->name = '';
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->branch = '';
        $this->membership_type = '';
        $this->incorporation_number = '';
        $this->phone_number = '';
        $this->mobile_phone_number = '';
        $this->email = '';
        $this->date_of_birth = '';
        $this->gender = '';
        $this->marital_status = '';
        $this->membership_number = '';
        $this->registration_date = '';
        $this->street = '';
        $this->address = '';
        $this->notes = '';
        $this->business_name = '';
        $this->photo = null;

    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();


        approvals::create([
            'institution' => $id,
            'process_name' => 'createMember',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => $id
        ]);

    }


    public function submit()
    {

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        $this->validate();

        // Execution doesn't reach here if validation fails.

        $id =  MembersModel::create([
            'name' => $this->name,
            'region' => $this->region,
            'wilaya' => $this->wilaya,
            'membershipNumber' => $this->membershipNumber,
            'parentMember' => $this->parentMember,
            'institution_id' => $institution_id,
            'Member_status'  => 'Pending'
        ])->id;

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createMember',
            'process_description' => 'has created a new Member',
            'approval_process_description' => 'has approved a new Member',
            'process_code' => '01',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);



        $this->resetData();

        Session::flash('message', 'A new Member has been successfully created!');
        Session::flash('alert-class', 'alert-success');
    }




    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Members list';
        }
        if($tabId == '2'){
            $this->title = 'Enter new Member details';
        }
    }


    public function createNewMember()
    {


        $this->showCreateNewMember = true;
    }

    public function blockMemberModal($id)
    {

        $this->showDeleteMember = true;
        $this->MemberSelected = $id;
    }

    public function editMemberModal($id)
    {
        $this->showEditMember = true;
        $this->pendingMember = $id;
        $this->Member = $id;
        $this->pendingMembername = MembersModel::where('id',$id)->value('first_name');
        $this->updatedMember();

    }

        public function closeModal(){
            $this->showCreateNewMember = false;
            $this->showDeleteMember = false;
            $this->showEditMember = false;
        }

        public function confirmPassword(): void
        {
            // Check if password matches for logged-in user
            if (Hash::check($this->password, auth()->user()->password)) {
                //dd('password matches');
                $this->delete();
            } else {
                //dd('password does not match');
                Session::flash('message', 'This password does not match our records');
                Session::flash('alert-class', 'alert-warning');
            }
            $this->resetPassword();


        }

        public function resetPassword(): void
        {
            $this->password = null;
        }

    public function delete(): void
    {
        $user = User::where('id',$this->userSelected)->first();
        $action = '';
        if ($user) {

            if($this->permission == 'BLOCKED'){
                $action = 'blockUser';
            }
            if($this->permission == 'ACTIVE'){
                $action = 'activateUser';
            }
            if($this->permission == 'DELETED'){
                $action = 'deleteUser';
            }

            $update_value = approvals::updateOrCreate(
                [
                    'process_id' => $this->userSelected,
                    'user_id' => Auth::user()->id

                ],
                [
                    'institution' => '',
                    'process_name' => $action,
                    'process_description' => $this->permission.' user - '.$user->name,
                    'approval_process_description' => '',
                    'process_code' => '29',
                    'process_id' => $this->userSelected,
                    'process_status' => $this->permission,
                    'approval_status' => 'PENDING',
                    'user_id'  => Auth::user()->id,
                    'team_id'  => '',
                    'edit_package'=> null
                ]
            );


            // Delete the record
            //$node->delete();
            // Add your logic here for successful deletion
            Session::flash('message', 'Awaiting approval');
            Session::flash('alert-class', 'alert-success');

            $this->closeModal();
            $this->render();


        } else {
            // Handle case where record was not found
            // Add your logic here
            Session::flash('message', 'Node error');
            Session::flash('alert-class', 'alert-warning');
        }

    }





    public function render()
    {
        return view('livewire.members.members');
    }
}
