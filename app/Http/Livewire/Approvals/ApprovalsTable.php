<?php

namespace App\Http\Livewire\Approvals;

use App\Http\Traits\MailSender;
use App\Models\approvals;
use App\Models\Branches;
use App\Models\ChannelsModel;
use App\Models\departmentsList;
use App\Models\Nodes;
use App\Models\NodesList;
use App\Models\servicesModel;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\ServicesList;
use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class ApprovalsTable extends LivewireDatatable
{

    use WithFileUploads;
    use MailSender;
    public $exportable = true;
    public $searchable="process_name, process_description,process_status,process_type,process_status,approval_status";

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {

        return approvals::query();


    }


    public function columns(): array
    {
        return [

            Column::name('created_at')
                ->label('Date Created')->defaultSort(),

            Column::name('process_name')
                ->label('Action Name'),

            Column::name('process_description')
                ->label('Details'),

            Column::callback(['user_id'], function ($id) {
                if($id){
                    return User::find($id)->name;
                }else{
                    return '';
                }

            })->unsortable()->label('Initiator'),

            Column::callback(['approver_id'], function ($id) {
                $user = User::find($id);
                if($user){
                    return $user->name;
                } else {
                    return 'Pending';
                }
            })->unsortable()->label('Approver'),



            Column::callback(['process_id'], function ($process_id) {

                $editPackage = approvals::where('process_id',$process_id)->value('edit_package');
                $processName = approvals::where('process_id',$process_id)->value('process_name');
                if($editPackage){
                    return view('livewire.approvals.changes-list', ['process_id' => $process_id, 'process_name' => $processName, 'edit_package' =>$editPackage]);
                }

                return null;
            })->unsortable()->label('Edit Changes'),


            Column::callback(['approval_status'], function ($status) {
                return view('livewire.settings.table-status', ['status' => $status, 'move' => false]);
            })->label('Approval Status'),



            Column::callback(['ID'], function ($id) {
                if(approvals::find($id)->approval_status =='PENDING'){
                    return view('livewire.approvals.action', ['id' => $id, 'move' => false]);
                }
                return null;
            })->unsortable()->label('Decision'),

        ];
    }

    public function approve($id): void
    {
        $approval = approvals::find($id);

        ///////////////////////////////////NODES//////////////////////////////////////////

        if($approval->process_name =='deleteNode'){
            $this->approveDeleteNode($approval->process_id,$id);
        }
        if($approval->process_name =='editNode'){
            $this->approveEditNode($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addNode'){
            $this->approveAddNode($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////SERVICES/////////////////////////////////////////////


        if($approval->process_name =='deleteService'){
            $this->approveDeleteService($approval->process_id,$id);
        }
        if($approval->process_name =='editService'){
            $this->approveEditService($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addService'){
            $this->approveAddService($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////CHANNEL/////////////////////////////////////////////


        if($approval->process_name =='deleteChannel'){
            $this->approveDeleteChannel($approval->process_id,$id);
        }
        if($approval->process_name =='editChannel'){
            $this->approveEditChannel($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addChannel'){
            $this->approveAddChannel($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////USERS/////////////////////////////////////////////


        if($approval->process_name =='deleteUser' || $approval->process_name =='blockUser' || $approval->process_name =='activateUser' ){
            $this->approveDeleteUser($approval->process_id,$id);
        }
        if($approval->process_name =='editUser'){
            $this->approveEditUser($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addUser'){
            $this->approveAddUser($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////DEPARTMENT/////////////////////////////////////////////


        if($approval->process_name =='deleteDepartment'){
            $this->approveDeleteDepartment($approval->process_id,$id);
        }
        if($approval->process_name =='editRole'){
            $this->approveEditDepartment($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addDepartment'){
            $this->approveAddDepartment($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////PASSWORD RESET/////////////////////////////////////////////


        if($approval->process_name =='passwordReset'){
            $this->approvePasswordReset($approval->reset_email,$id);
        }

        ////////////////////////////////PERMISSIONS/////////////////////////////////////////////


        if($approval->process_name =='editPermission'){
            $this->approveEditPermission($approval->process_id,$id);
        }

            ////////////////////////////////TRANSACTIONS/////////////////////////////////////////////


            if($approval->process_name =='resolveTransaction'){
                $this->approveResolveTransaction($approval->process_id,$id,$approval->edit_package);
            }
    


    }

    public function reject($id): void
    {

        $approval = approvals::find($id);

        ///////////////////////////////////NODES//////////////////////////////////////////

        if($approval->process_name =='deleteNode'){
            $this->rejectDeleteNode($approval->process_id,$id);
        }
        if($approval->process_name =='editNode'){
            $this->rejectEditNode($approval->process_id,$id);
        }
        if($approval->process_name =='addNode'){
            $this->rejectAddNode($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////SERVICES/////////////////////////////////////////////


        if($approval->process_name =='deleteService'){
            $this->rejectDeleteService($approval->process_id,$id);
        }
        if($approval->process_name =='editService'){
            $this->rejectEditService($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addService'){
            $this->rejectAddService($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////CHANNEL/////////////////////////////////////////////


        if($approval->process_name =='deleteChannel'){
            $this->rejectDeleteChannel($approval->process_id,$id);
        }
        if($approval->process_name =='editChannel'){
            $this->rejectEditChannel($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addChannel'){
            $this->rejectAddChannel($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////USER/////////////////////////////////////////////


        if($approval->process_name =='deleteUser' || $approval->process_name =='blockUser' || $approval->process_name =='activateUser'){
            $this->rejectDeleteUser($approval->process_id,$id);
        }
        if($approval->process_name =='editUser'){
            $this->rejectEditUser($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addUser'){
            $this->rejectAddUser($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////DEPARTMENT/////////////////////////////////////////////


        if($approval->process_name =='deleteDepartment'){
            $this->rejectDeleteDepartment($approval->process_id,$id);
        }
        if($approval->process_name =='editRole'){
            $this->rejectEditDepartment($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addDepartment'){
            $this->rejectAddDepartment($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////PASSWORD RESET/////////////////////////////////////////////


        if($approval->process_name =='passwordReset'){
            $this->rejectPasswordReset($approval->reset_email,$id);
        }

        ////////////////////////////////PERMISSIONS/////////////////////////////////////////////


        if($approval->process_name =='editPermission'){
            $this->rejectEditPermission($approval->process_id,$id);
        }

        ////////////////////////////////TRANSACTIONS/////////////////////////////////////////////


               if($approval->process_name =='resolveTransaction'){
                $this->rejectResolveTransaction($approval->process_id,$id);
            }

    }



    ///////////////////////////////////////NODES////////////////////////////////////////
    public function approveDeleteNode($process_id,$approvalsId): void
    {

        NodesList::where('ID', $process_id)->update([
            'NODE_STATUS' => 'DELETED'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved deletion of the node',
        ]);

    }

    public function rejectDeleteNode($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the node',
        ]);

    }

    private function approveEditNode($process_id, $approvalsId,$changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = NodesList::where('id',$process_id)->value($key);
            if($dbValue != $value){
                NodesList::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the node',
        ]);
    }

    private function rejectEditNode($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the node',
        ]);
    }

    private function approveAddNode($process_id, $approvalsId, $edit_package): void
    {

        NodesList::where('ID', $process_id)->update([
            'NODE_STATUS' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the node',
        ]);

    }

    private function rejectAddNode($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the node',
        ]);
    }

///////////////////////////////////END OF NODES////////////////////////////////////////



    ///////////////////////////////////////SERVICES////////////////////////////////////////
    public function approveDeleteService($process_id,$approvalsId): void
    {

        servicesModel::where('ID', $process_id)->update([
            'STATUS' => 'DELETED'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the deletion of the service',
        ]);

    }

    public function rejectDeleteService($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the service',
        ]);

    }

    private function approveEditService($process_id, $approvalsId,$changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = servicesModel::where('ID',$process_id)->value($key);
            if($dbValue != $value){
                servicesModel::where('ID', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the service',
        ]);
    }

    private function rejectEditService($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the service',
        ]);
    }

    private function approveAddService($process_id, $approvalsId, $edit_package): void
    {

        servicesModel::where('ID', $process_id)->update([
            'STATUS' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the service',
        ]);

    }

    private function rejectAddService($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the service',
        ]);
    }

///////////////////////////////////END OF SERVICES////////////////////////////////////////



    ///////////////////////////////////////CHANNEL////////////////////////////////////////
    public function approveDeleteChannel($process_id,$approvalsId): void
    {

        ChannelsModel::where('ID', $process_id)->update([
            'STATUS' => 'DELETED'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the deletion of the channel',
        ]);

    }

    public function rejectDeleteChannel($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the channel',
        ]);

    }

    private function approveEditChannel($process_id, $approvalsId, $changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = ChannelsModel::where('ID',$process_id)->value($key);
            if($dbValue != $value){
                ChannelsModel::where('ID', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the channel',
        ]);
    }

    private function rejectEditChannel($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the channel',
        ]);
    }

    private function approveAddChannel($process_id, $approvalsId, $edit_package): void
    {

        ChannelsModel::where('ID', $process_id)->update([
            'STATUS' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the channel',
        ]);

    }

    private function rejectAddChannel($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the channel',
        ]);
    }

///////////////////////////////////END OF CHANNEL////////////////////////////////////////



    ///////////////////////////////////////USER////////////////////////////////////////
    public function approveDeleteUser($process_id,$approvalsId): void
    {

        $status = approvals::where('id',$approvalsId)->value('process_status');
        User::where('id', $process_id)->update([
            'status' => $status
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved this action',
        ]);

    }

    public function rejectDeleteUser($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the user',
        ]);

    }

    private function approveEditUser($process_id, $approvalsId, $changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = User::where('id',$process_id)->value($key);
            if($dbValue != $value){
                User::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the user information',
        ]);
    }

    private function rejectEditUser($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the user information',
        ]);
    }

    private function approveAddUser($process_id, $approvalsId, $edit_package): void
    {

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+{}[]<>,.?/~';
        $randomString = str_shuffle($characters);
        $password = substr($randomString, 0, 8);

        User::where('id', $process_id)->update([
            'status' => 'ACTIVE',
            'password' => bcrypt($password),
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the user',
        ]);


        $this->composeEmail(User::where('id',$process_id)->value('email'), 'Dear '.User::where('id',$process_id)->value('name').', You have been added as a user in the CyberPoint Pro System. You can proceed and login using your email and temporary password '.$password. ' use link https://testcyberpointpro.ubx.co.tz as soon as you are logged in you must change the temporary password to your choice. Thank you');

        //dd($password);
    }

    private function rejectAddUser($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the user',
        ]);
    }

///////////////////////////////////END USER////////////////////////////////////////



    ///////////////////////////////////////DEPARTMENT////////////////////////////////////////
    public function approveDeleteDepartment($process_id,$approvalsId): void
    {

        departmentsList::where('id', $process_id)->update([
            'status' => 'DELETED'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the deletion of the department',
        ]);

    }

    public function rejectDeleteDepartment($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the department',
        ]);

    }

    private function approveEditDepartment($process_id, $approvalsId, $changes): void
    {
        //dd('hapaa');
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = departmentsList::where('id',$process_id)->value($key);
            if($dbValue != $value){
                departmentsList::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the department',
        ]);
    }

    private function rejectEditDepartment($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the department',
        ]);
    }

    private function approveAddDepartment($process_id, $approvalsId, $edit_package): void
    {

        departmentsList::where('id', $process_id)->update([
            'status' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the department',
        ]);

    }

    private function rejectAddDepartment($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the user',
        ]);
    }

///////////////////////////////////END DEPARTMENT////////////////////////////////////////


///////////////////////////////////PASSWORD RESET////////////////////////////////////////
    private function approvePasswordReset($reset_email, $id): void
    {

        if (User::where('email',$reset_email)->get()->count() > 0 ) {

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+{}[]<>,.?/~';
            $randomString = str_shuffle($characters);
            $password = substr($randomString, 0, 8);

            User::where('email', $reset_email)->update([
                'password'  =>  bcrypt($password),
                'otp_time'  =>  now(),
                'verification_status'   =>  '0',
            ]);

            approvals::where('id', $id)->update([
                'approver_id' => Auth::user()->id,
                'approval_status' => 'APPROVED',
                'approval_process_description' => 'Approved password reset for the user with email - '.$reset_email,
            ]);

            $this->composeEmail($reset_email, 'Dear '.User::where('email',$reset_email)->value('name').', You have requested to reset your password, use the following temporary password - '.$password.' Change the password immediately after login. ');

        } else {

            approvals::where('id', $id)->update([
                'approver_id' => Auth::user()->id,
                'approval_status' => 'REJECTED',
                'approval_process_description' => Auth::user()->name . ' This email is not registered - '.$reset_email,
            ]);
        }



    }



    private function rejectPasswordReset($reset_email, $id): void
    {
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected password reset for the user with email - '.$reset_email,
        ]);
    }

    ////////////////////////////////PERMISSIONS/////////////////////////////////////////////
    private function approveEditPermission($process_id, $id)
    {
        UserSubMenu::where('user_id', $process_id)->update([
            'updated' => 0,
            'previous' => null,
            'status' => 'ACTIVE'
        ]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved change',
        ]);
    }

    private function rejectEditPermission($process_id, $id)
    {
        $menuData = UserSubMenu::where('user_id', $process_id)->where('updated', 1)->get();
        foreach ($menuData as $data)
        {
            UserSubMenu::where('ID', $data->ID)->update([
                'updated' => 0,
                'previous' => null,
                'permission' => $data->previous,
                'status' => 'ACTIVE'
            ]);
        }


        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected change',
        ]);
    }


    /////////////////////////////////////TRANSACTIONS///////////////////////////////

    public function approveResolveTransaction($process_id, $approvalsId, $changes){
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = Transactions::where('id',$process_id)->value($key);
            if($dbValue != $value){
                Transactions::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved resolution of transaction',
        ]);
    }

    public function rejectResolveTransaction($process_id,$approvalsId){
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected transaction resolution',
        ]);
    }

}
