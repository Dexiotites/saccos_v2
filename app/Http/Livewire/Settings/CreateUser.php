<?php

namespace App\Http\Livewire\Settings;

use App\Http\Traits\MailSender;
use App\Models\approvals;
use App\Models\departmentsList;
use App\Models\sub_menus;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use libphonenumber\PhoneNumberUtil;
use Livewire\Component;
use App\Models\User;

class CreateUser extends Component
{
    use MailSender;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $department;
    public $departmentList;
    public $menusArray;
    /**
     * @var string[]|null
     */
    public $menuItems;
    public $sub_menus;
    /**
     * @var true
     */
    public bool $showRoles = false;
    public $newuser;
    public $phone_number;


    protected $rules = [
        'newuser' => 'required|min:1',
        'department' => 'required|min:1'

    ];
    public $departmentName;


    public function boot(): void
    {
        $this->password = "12345";
    }


    public function updatedPhoneNumber($value)
    {
        dd('t');
        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneNumberUtil->parse($value, 'TZ'); // Replace 'US' with the appropriate country code
            $isValidNumber = $phoneNumberUtil->isValidNumber($phoneNumber);
        } catch (\libphonenumber\NumberParseException $e) {
            $isValidNumber = false;
        }

        if ($isValidNumber) {
            $this->phone_number = $phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
        } else {
            $this->phone_number = '';
        }
    }


    public function create(): void
    {

        if($this->showRoles){



            $this->emitUp('showUsersList');

        }else{


            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone_number' => [
                    'required',
                    'string',
                    'regex:/^(\+255|0)[1-9]\d{8}$/',
                    'unique:users,phone_number'
                ]
            ]);


            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->status = 'PENDING';
            $user->department = $this->department;
            $user->password = bcrypt($this->password);
            $user->otp_time = now();
            $user->verification_status = '0';
            if ($user->save()) {

                session()->flash('message', 'User created, default password has been sent to the email provided');
                session()->flash('alert-class', 'alert-success');
                session()->flash('success', 'User created successfully.');


                $update_value = approvals::updateOrCreate(
                    [
                        'process_id' => $user->id,
                        'user_id' => Auth::user()->id

                    ],
                    [
                        'institution' => '',
                        'process_name' => 'addUser',
                        'process_description' => Auth::user()->name.' has requested to add a User - '.$this->name,
                        'approval_process_description' => '',
                        'process_code' => '30',
                        'process_id' => $user->id,
                        'process_status' => 'PENDING',
                        'approval_status' => 'PENDING',
                        'user_id'  => Auth::user()->id,
                        'team_id'  => ''

                    ]
                );

                $this->newuser = $user->id;
                $this->showRoles = true;
                Session::put('newuser', $user->id);



            }

            $this->composeEmail($this->email, 'Dear '.$this->name.', You have been given access
            to the CyberPoint Pro System under '.$this->department.' department. Your initial
            password is '.$this->password .'. Please, make sure you update your password as soon as possible.');
        }




    }



    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->departmentList = departmentsList::get();
        return view('livewire.settings.create-user');
    }
}
