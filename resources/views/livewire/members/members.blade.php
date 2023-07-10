
<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                    <div>

                        <table class="min-w-full text-center text-sm font-light">
                            <thead>
                                <tr>
                                    <th>MEMBERS MANAGEMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="whitespace-nowrap font-medium text-left">Active Members</td>
                                    <td class="whitespace-nowrap text-left">{{ $this->activeMembersCount }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap font-medium text-left">Inactive Members</td>
                                    <td class="whitespace-nowrap text-left">{{ $this->inactiveMembersCount }}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>







                </div>



            </div>




        </div>



        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">

            <!-- Left: Avatars -->


            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-1 flex  items-center " style="height: 70px">


                <div class="inline-flex p-2" >

                        @if (in_array(23, session()->get('permissions')))
                            <button wire:click="showAddMemberModal(2)" class="mr-4 flex text-center items-center @if($this->selected == 2) very-light-shade @else bg-gray-100  @endif @if($this->selected == 2) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                                New Member
                            </button>
                        @endif






                </div>



            </div>





            <!-- Right: Actions -->


        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <livewire:members.members-table/>



        </div>


    </div>










<!-- Log Out Other Devices Confirmation Modal -->
<x-jet-dialog-modal wire:model="showCreateNewMember">
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
                                CREATE Member
                            </h5>
                        </div>


                        <div class="col-span-6 sm:col-span-4 mb-4">


                            <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Member Name</p>
                            <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" wire:model.defer="name" autofocus />
                            @error('name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The name is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Region</p>
                            <x-jet-input id="region" name="region" type="text" class="mt-1 block w-full" wire:model.defer="region" autofocus />
                            @error('region')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The region is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="wilaya" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Wilaya</p>
                            <x-jet-input id="wilaya" name="wilaya" type="text" class="mt-1 block w-full" wire:model.defer="wilaya" autofocus />
                            @error('wilaya')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The wilaya is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="membershipNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Membership Number</p>
                            <x-jet-input id="membershipNumber" name="membershipNumber" type="text" class="mt-1 block w-full" wire:model.defer="membershipNumber" autofocus />
                            @error('membershipNumber')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The membership number is mandatory, it should be more than three characters and unique.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="parentMember" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Parent Member</p>
                            <select wire:model.bounce="parentMember" name="parentMember" id="parentMember" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Select</option>
                                @foreach(App\Models\MembersModel::all() as $Member)
                                <option value="{{$Member->id}}">{{$Member->name}}</option>
                                @endforeach

                            </select>
                            @error('parentMember')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The Parent Member is mandatory.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                        </div>






                    </div>




                </div>



        </div>



    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showCreateNewMember')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove>
        <x-jet-button class="ml-3"
                      wire:click="submit"
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
<x-jet-dialog-modal wire:model="showDeleteMember">
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




                    @if($this->MemberSelected)




                        <p  class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">Member SELECTED</p>
                        <div class="flex items-center mb-2 text-sm spacing-sm text-slate-600 mt-2" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <p>{{ App\Models\MembersModel::where('id', $this->MemberSelected)->value('first_name') }}</p>

                        </div>

                        <div class="mt-4 w-full">
                            <p for="MemberSelected" class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SELECT ACTION</p>

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
        <x-jet-secondary-button wire:click="$toggle('showDeleteMember')" wire:loading.attr="disabled">
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
<x-jet-dialog-modal wire:model="showEditMember">
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
                            EDIT MEMBER : {{$this->pendingMembername}}
                        </h5>
                    </div>



                    @if($this->Member)





                    <div>



                        <div class="justify-center">


                            <section class=" w-full bg-white-300 flex flex-col items-center justify-center">
                                @if ($this->photo)
                                    <img class="object-fill w-5/5 rounded-l-lg" src="{{ $photo->temporaryUrl() }}">
                                @else

                                    <img src="{{ $this->profile_photo_path }}" alt="Image">
                                @endif

                            </section>




                            <div class="  w-full  flex items-center justify-center hover:bg-gray-100 hover:border-gray-300">



                                <label class="flex flex-col w-full h-19 cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-7">

                                        <div wire:loading wire:target="photo" class="" >

                                            <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>
                                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                                        </div>

                                        <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                Select new image</p>

                                        </div>

                                    </div>



                                    <input type="file" class="opacity-0" wire:model="photo"/>




                                </label>
                            </div>



                                @error('photo') <span class="error">{{ $message }}</span> @enderror


                        </div>



                        <x-jet-section-border />
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                            <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" autocomplete="first_name" />

                            <x-jet-input-error for="first_name" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                            <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autocomplete="middle_name" />
                            <x-jet-input-error for="middle_name" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autocomplete="last_name" />
                            <x-jet-input-error for="last_name" class="mt-2" />
                        </div>


                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="incorporation_number" value="{{ __('Incorporation Number') }}" />
                            <x-jet-input id="incorporation_number" type="text" class="mt-1 block w-full" wire:model.defer="incorporation_number" />
                            <x-jet-input-error for="incorporation_number" class="mt-2" />
                        </div>




                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="business_name" value="{{ __('Business Name') }}" />

                            <x-jet-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" wire:model.defer="business_name" />
                            @error('business_name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Business Name is mandatory, it should be more than three characters.</p>
                            </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="phone_number" value="{{ __('Incorporation Number') }}" />
                            <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="phone_number" />
                            <x-jet-input-error for="phone_number" class="mt-2" />
                        </div>



                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="mobile_phone_number" value="{{ __('Mobile Phone Number') }}" />
                            <x-jet-input id="mobile_phone_number" type="text" class="mt-1 block w-full" wire:model.defer="mobile_phone_number" />
                            <x-jet-input-error for="mobile_phone_number" class="mt-2" />
                        </div>



                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>


                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="date_of_birth" value="{{ __('Date Of Birth') }}" />
                            <x-jet-input id="date_of_birth" type="date" class="mt-1 block w-full" wire:model.defer="date_of_birth" />
                            <x-jet-input-error for="date_of_birth" class="mt-2" />
                        </div>



                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="gender" value="{{ __('Gender') }}" />
                            <select wire:model.defer="gender" name="gender" id="gender" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>

                            </select>
                            @error('gender')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Gender is mandatory.</p>
                            </div>
                            @enderror

                        </div>


                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="marital_status" value="{{ __('Marital Status') }}" />
                            <select wire:model.defer="marital_status" name="marital_status" id="marital_status" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option  value="Married">Married</option>
                                <option  value="Single">Single</option>
                                <option  value="Divorced">Divorced</option>
                                <option  value="Widow">Widow</option>

                            </select>
                            @error('marital_status')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Marital Status is mandatory.</p>
                            </div>
                            @enderror

                        </div>


                        <div class="col-span-6 sm:col-span-4">

                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ __('By changing the branch of the member, you are transferring the member from the previous branch to newly selected branch. A new Account will be created for this member .') }}
                                </p>
                            </div>
                        </div>
                        <br>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Branch</label>
                            <select wire:model.bounce="branch" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                @foreach(App\Models\BranchesModel::all() as $branch)
                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach

                            </select>
                            @error('branch')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Branch is mandatory.</p>
                            </div>
                            @enderror

                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Membership Type</label>
                            <select wire:model.bounce="membership_type" name="membership_type" id="membership_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="Individual">Individual</option>
                                <option value="Group">Group</option>
                                <option value="Business">Business</option>


                            </select>
                            @error('membership_type')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Membership Type is mandatory.</p>
                            </div>
                            @enderror

                        </div>


                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="street" value="{{ __('Street') }}" />
                            <x-jet-input id="street" name="street" type="text" class="mt-1 block w-full" wire:model.defer="street" />
                            @error('street')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Street is mandatory, it should be more than three characters and unique.</p>
                            </div>
                            @enderror
                        </div>



                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="address" value="{{ __('Residential Address') }}" />
                            <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" wire:model.defer="address" />
                            @error('address')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Address is mandatory, it should be more than three characters.</p>
                            </div>
                            @enderror
                        </div>


                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="notes" value="{{ __('Notes') }}" />
                            <textarea id="notes" name="notes" wire:model.defer="notes" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
                            @error('notes')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Notes is mandatory, it should be more than three characters.</p>
                            </div>
                            @enderror
                        </div>






                    </div>








                    @endif

                </div>
        </div>



    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditMember')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove wire:target="updateMember" >
            <x-jet-button class="ml-3"
                          wire:click="updateMember"
                          wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-jet-button>
        </div>
        <div wire:loading wire:target="updateMember">
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
<x-jet-dialog-modal wire:model="showAddMember">
    <x-slot name="title">

    </x-slot>

    <x-slot name="content">











        <div>


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
            </div>


            <div class="justify-center">


                <section class=" w-full bg-white-300 flex flex-col items-center justify-center">
                    @if ($this->photo)
                        <img class="object-fill w-5/5 rounded-l-lg" src="{{ $photo->temporaryUrl() }}">
                    @else
                        @if ($this->profile_photo_path)
                            <img class="object-fill w-5/5 rounded-l-lg" src="{{$this->profile_photo_path}}">
                        @else

                        @endif

                    @endif
                </section>




                <div class="  w-full  flex items-center justify-center hover:bg-gray-100 hover:border-gray-300">



                    <label class="flex flex-col w-full h-19 cursor-pointer">
                        <div class="flex flex-col items-center justify-center pt-7">

                            <div wire:loading wire:target="photo" class="" >

                                <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                            </div>

                            <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Select new image</p>

                            </div>

                        </div>



                        <input type="file" class="opacity-0" wire:model="photo"/>




                    </label>
                </div>



                    @error('photo') <span class="error">{{ $message }}</span> @enderror


            </div>



            <x-jet-section-border />
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" autocomplete="first_name" />

                <x-jet-input-error for="first_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autocomplete="middle_name" />
                <x-jet-input-error for="middle_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autocomplete="last_name" />
                <x-jet-input-error for="last_name" class="mt-2" />
            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="incorporation_number" value="{{ __('Incorporation Number') }}" />
                <x-jet-input id="incorporation_number" type="text" class="mt-1 block w-full" wire:model.defer="incorporation_number" />
                <x-jet-input-error for="incorporation_number" class="mt-2" />
            </div>




            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="business_name" value="{{ __('Business Name') }}" />

                <x-jet-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" wire:model.defer="business_name" />
                @error('business_name')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Business Name is mandatory, it should be more than three characters.</p>
                </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone_number" value="{{ __('Incorporation Number') }}" />
                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="phone_number" />
                <x-jet-input-error for="phone_number" class="mt-2" />
            </div>



            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="mobile_phone_number" value="{{ __('Mobile Phone Number') }}" />
                <x-jet-input id="mobile_phone_number" type="text" class="mt-1 block w-full" wire:model.defer="mobile_phone_number" />
                <x-jet-input-error for="mobile_phone_number" class="mt-2" />
            </div>



            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="date_of_birth" value="{{ __('Date Of Birth') }}" />
                <x-jet-input id="date_of_birth" type="date" class="mt-1 block w-full" wire:model.defer="date_of_birth" />
                <x-jet-input-error for="date_of_birth" class="mt-2" />
            </div>



            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <select wire:model.defer="gender" name="gender" id="gender" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>

                </select>
                @error('gender')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Gender is mandatory.</p>
                </div>
                @enderror

            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="marital_status" value="{{ __('Marital Status') }}" />
                <select wire:model.defer="marital_status" name="marital_status" id="marital_status" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option  value="Married">Married</option>
                    <option  value="Single">Single</option>
                    <option  value="Divorced">Divorced</option>
                    <option  value="Widow">Widow</option>

                </select>
                @error('marital_status')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Marital Status is mandatory.</p>
                </div>
                @enderror

            </div>


            <div class="col-span-6 sm:col-span-4">

                <div class="mt-3 max-w-xl text-sm text-gray-600">
                    <p>
                        {{ __('By changing the branch of the member, you are transferring the member from the previous branch to newly selected branch. A new Account will be created for this member .') }}
                    </p>
                </div>
            </div>
            <br>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Branch</label>
                <select wire:model.bounce="branch" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @foreach(App\Models\BranchesModel::all() as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach

                </select>
                @error('branch')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Branch is mandatory.</p>
                </div>
                @enderror

            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Membership Type</label>
                <select wire:model.bounce="membership_type" name="membership_type" id="membership_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="Individual">Individual</option>
                    <option value="Group">Group</option>
                    <option value="Business">Business</option>


                </select>
                @error('membership_type')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Membership Type is mandatory.</p>
                </div>
                @enderror

            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="street" value="{{ __('Street') }}" />
                <x-jet-input id="street" name="street" type="text" class="mt-1 block w-full" wire:model.defer="street" />
                @error('street')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Street is mandatory, it should be more than three characters and unique.</p>
                </div>
                @enderror
            </div>



            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="address" value="{{ __('Residential Address') }}" />
                <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" wire:model.defer="address" />
                @error('address')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Address is mandatory, it should be more than three characters.</p>
                </div>
                @enderror
            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                <textarea id="notes" name="notes" wire:model.defer="notes" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
                @error('notes')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Notes is mandatory, it should be more than three characters.</p>
                </div>
                @enderror
            </div>






        </div>





    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showAddMember')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove wire:target="addMember" >
            <x-jet-button class="ml-3"
                          wire:click="addMember"
                          wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-jet-button>
        </div>
        <div wire:loading wire:target="addMember">
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




