<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                    <div>
                        SYSTEM USERS MANAGEMENT
                        <div class="flex items-center text-sm font-semibold text-red-600 spacing-sm">
                            Active Users - {{$this->activeUsers}} users
                        </div>
                        <div class="flex items-center text-sm font-semibold text-red-600 spacing-sm">
                            Inactive Users - {{$this->inActiveUsers}} users
                        </div>

                    </div>

                </div>



            </div>




        </div>



        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">

            <!-- Left: Avatars -->


            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-1 flex  items-center " style="height: 70px">


                <div class="inline-flex p-2" >
                    @if (in_array(22, session()->get('permissions')))
                        <button wire:click="setView(6)" class="mr-4 flex text-center items-center @if($this->selected == 6) very-light-shade @else bg-gray-100  @endif @if($this->selected == 6) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">



                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>


                        Users
                    </button>
                    @endif
                        @if (in_array(23, session()->get('permissions')))
                            <button wire:click="setView(2)" class="mr-4 flex text-center items-center @if($this->selected == 2) very-light-shade @else bg-gray-100  @endif @if($this->selected == 2) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                                Roles
                            </button>
                        @endif
                            @if (in_array(25, session()->get('permissions')))
                            <button wire:click="setView(1)" class="mr-4 flex text-center items-center @if($this->selected == 1) very-light-shade @else bg-gray-100  @endif @if($this->selected == 1) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>

                        User Profile
                    </button>
                    @endif





                </div>



            </div>





            <!-- Right: Actions -->


        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <div class="tab-pane fade " id="tabs-homeJustify"
                 role="tabpanel" aria-labelledby="tabs-home-tabJustify">
                <div class="mt-2"></div>
                <div class="w-full flex items-center justify-center">
                    <div wire:loading wire:target="setView">
                        <div class="h-96 m-auto flex items-center justify-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                        </div>
                    </div>
                </div>



                <div wire:loading.remove wire:target="setView">
                    @switch($this->selected)
                        @case('1')
                            <livewire:settings.profile/>
                            @break
                        @case('2')
                            <livewire:settings.user-groups/>
                            @break
                        @case('3')
                            <livewire:settings.create-user/>
                            @break
                        @case('4')
                            <livewire:settings.roles/>
                            @break
                        @case('5')
                            <livewire:settings.delete-user/>
                            @break
                        @case('6')
                            <button wire:click="createNewUser" wire:loading.attr="disabled" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">New User</button>

                            <livewire:settings.users/>
                            @break

                        @default
                            <livewire:settings.users/>
                    @endswitch
                </div>

            </div>



        </div>


    </div>



    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showCreateNewUser">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">








            <div>
                @if (session()->has('message'))

                    @if (session('alert-class') == 'alert-success')
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">The process is completed</p>
                                    <p class="text-sm">{{ session('message') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                    <div class="w-full bg-white  p-4">

                        <div class="w-full">
                            <div class="mb-4">
                                <h5 >
                                    CREATE USER
                                </h5>
                            </div>


                            <div >
                                <div class="mb-4">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <input id="name" type="text" class="mt-1 block w-full " wire:model="name" autocomplete="name" />
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>


                                </div>

                                <div class="mb-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="email" value="{{ __('E-Mail Address') }}" />
                                        <input id="email" type="email" class="mt-1 block w-full " wire:model="email" required />
                                        <x-jet-input-error for="email" class="mt-2" />
                                    </div>


                                </div>

                                <div class="mb-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                                        <input id="phone_number" type="phone_number" class="mt-1 block w-full " wire:model="phone_number" required />
                                        <x-jet-input-error for="phone_number" class="mt-2" />
                                    </div>

                                </div>


                                <div class="form-group col-span-6 sm:col-span-4 mb-4">

                                    <x-jet-label for="department" value="{{ __('Select role') }}" />

                                    <select id="department" wire:model="department" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                                        <option value="" selected>{{$this->departmentName}}</option>

                                        @foreach($this->departmentList as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>

                                        @endforeach
                                    </select>
                                    @error('department')
                                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                        <p>Please select a role first.</p>
                                    </div>
                                    @enderror

                                </div>





                            </div>
                        </div>




                    </div>



            </div>



        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showCreateNewUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove>
            <x-jet-button class="ml-3"
                          wire:click="createUser"
                          wire:loading.attr="disabled">
                {{ __('Create user') }}
            </x-jet-button>
            </div>
            <div wire:loading>
            <x-jet-button class="ml-3 "  >
                <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
                Please wait...
            </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>



    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showDeleteUser">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">








            <div>
                @if (session()->has('message'))

                    @if (session('alert-class') == 'alert-success')
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">The process is completed</p>
                                    <p class="text-sm">{{ session('message') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('alert-class') == 'alert-warning')
                        <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">Error</p>
                                    <p class="text-sm">{{ session('message') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="flex w-full">
                    <!-- message container -->


                    <div class="w-full p-4 ">




                        @if($this->userSelected)




                            <p  class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">USER SELECTED</p>
                            <div class="flex items-center mb-2 text-sm spacing-sm text-slate-600 mt-2" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p>{{ App\Models\User::where('id', $this->userSelected)->value('name') }}</p>

                            </div>

                            <div class="mt-4 w-full">
                                <p for="userSelected" class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SELECT ACTION</p>

                                <div class="flex gap-4 items-center text-center">
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="DELETED" /> Delete
                                </div>



                            </div>



                            <p for="password" class="block mb-1 mt-4 text-sm capitalize text-slate-400 dark:text-white ">ENTER PASSWORD TO CONFIRM</p>
                            <input wire:model.defer="password" id="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                            <x-jet-input-error for="current_password" class="mt-2" />


                        @endif
                    </div>

                </div>


                <div class="mt-8"></div>






            </div>


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="confirmPassword" >
                <x-jet-button class="ml-3"
                              wire:click="confirmPassword"
                              wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="confirmPassword">
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>




    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showEditUser">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">











            <div>
                @if (session()->has('message'))

                    @if (session('alert-class') == 'alert-success')
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">The process is completed</p>
                                    <p class="text-sm">{{ session('message') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif


                    <div class="bg-white p-4">

                        <div class="mb-4">
                            <h5 >
                                ASSIGN NEW ROLE TO USER : {{\App\Models\User::where('id',$this->pendinguser)->value('name')}}
                            </h5>
                        </div>




                        @if($this->pendinguser)

                                <div class="form-group col-span-6 sm:col-span-4 mb-4">

                                    <x-jet-label for="department" value="{{ __('User Role') }}" />

                                    <select id="department" wire:model="department" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                                        <option value="" selected>{{$this->department}}</option>

                                        @foreach($this->departmentList as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>

                                        @endforeach
                                    </select>
                                    @error('department')
                                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                        <p>Please select a department first.</p>
                                    </div>
                                    @enderror

                                </div>

                        @endif

                    </div>
            </div>

















        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showEditUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="saveRole" >
                <x-jet-button class="ml-3"
                              wire:click="saveRole"
                              wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="saveRole">
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>


</div>


