
<div>
    <div class="h-16 border flex justify-between items-center w-full px-5 py-2 shadow-sm mb-4">

        <div class="flex items-center space-x-5" hidden>

            <svg xmlns="http://www.w3.org/2000/svg" wire:click="back" class="cursor-pointer h-12 bg-slate-50 rounded-full stroke-blue-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" wire:click="back" class="cursor-pointer h-12 bg-slate-50 rounded-full stroke-red-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

        </div>

        <div wire:loading wire:target="back" >

                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                    </svg>
                    <p>Please wait...</p>
                </div>

        </div>

        <div wire:loading.remove wire:target="back" >
            <p class="font-semibold ml-3 text-slate-600">Add new user to : {{Session::get('branchNameInView')}}</p>

        </div>

    </div>

    <div class="lg:w-3/3">
        <!-- message container -->
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


        <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">




            <form wire:submit.prevent="save">


                    <div class="flex justify-center m-8">
                        <div class="max-w-2xl rounded-lg shadow-sm bg-gray-50">
                            <div class="m-4">

                                <section class="bg-white-300 flex flex-col items-center justify-center">
                                    @if ($photo)
                                        <img class="object-fill w-3/5 " src="{{ $photo->temporaryUrl() }}">
                                    @endif
                                </section>




                                <div class="flex items-center justify-center w-full">



                                    <label class="flex flex-col w-full h-19 hover:bg-gray-100 hover:border-gray-300">
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
                                                    Attach member image</p>

                                            </div>

                                        </div>
                                        <input type="file" class="opacity-0" wire:model="photo"/>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>



                @error('photo') <span class="error">{{ $message }}</span> @enderror


            </form>


            <div class="flex items-stretch">

                <div class="w-1/2 mr-2" >

                    <x-jet-label for="membership_type" value="{{ __('Membership Type') }}" />
                    <select wire:model.defer="membership_type" name="membership_type" id="membership_type" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Select</option>
                        <option value="Individual">Individual</option>
                        <option value="Group">Group</option>
                        <option value="Business">Business</option>

                    </select>
                    @error('membership_type')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Membership type is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="business_name" value="{{ __('Business Name') }}" />
                    <x-jet-input id="business_name" type="text" name="business_name" class="mt-1 block w-full" wire:model.defer="business_name" autofocus />
                    @error('business_name')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>The business name is mandatory and should be more than two characters.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                    <x-jet-input id="first_name" type="text" name="first_name" class="mt-1 block w-full" wire:model.defer="first_name" autofocus />
                    @error('first_name')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>The first name is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                    <x-jet-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autofocus />
                    @error('middle_name')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>The middle name is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror

                    <div class="mt-2"></div>
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-jet-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autofocus />
                    @error('last_name')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>The last name is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror

                    <div class="mt-2"></div>


                    <x-jet-label for="incorporation_number" value="{{ __('Incorporation Number') }}" />
                    <x-jet-input id="incorporation_number" name="incorporation_number" type="text" class="mt-1 block w-full" wire:model.defer="incorporation_number" autofocus />
                    @error('incorporation_number')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Incorporation number is mandatory, it should be more than three characters and unique.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>


                    <x-jet-label for="address" value="{{ __('Address') }}" />
                    <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" wire:model.defer="address" autofocus />
                    @error('address')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Address is mandatory, it should be more than three characters and unique.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="street" value="{{ __('Street') }}" />
                    <x-jet-input id="street" name="street" type="text" class="mt-1 block w-full" wire:model.defer="street" autofocus />
                    @error('street')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Street is mandatory, it should be more than three characters and unique.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>


                </div>


                <div class="w-1/2 ml-2" >

                    <x-jet-label for="gender" value="{{ __('Gender') }}" />
                    <select wire:model.defer="gender" name="gender" id="gender" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Select</option>
                        <option  value="Male">Male</option>
                        <option  value="Female">Female</option>
                        <option  value="Other">Other</option>

                    </select>
                    @error('gender')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Gender is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="marital_status" value="{{ __('Marital status') }}" />
                    <select wire:model.defer="marital_status" name="marital_status" id="marital_status" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Select</option>
                        <option  value="Married">Married</option>
                        <option  value="Single">Single</option>
                        <option  value="Divorced">Divorced</option>
                        <option  value="Widow">Widow</option>

                    </select>
                    @error('marital_status')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Marital status is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="date_of_birth" value="{{ __('Date of birth') }}" />
                    <x-jet-input id="date_of_birth" type="date" name="date_of_birth" class="mt-1 w-full" wire:model.defer="date_of_birth" autofocus />
                    @error('date_of_birth')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Date of birth is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="phone_number" value="{{ __('Phone number') }}" />
                    <x-jet-input id="phone_number" type="text" name="phone_number" class="mt-1 w-full" wire:model.defer="phone_number" autofocus />
                    @error('phone_number')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Phone number is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="mobile_phone_number" value="{{ __('Mobile phone number') }}" />
                    <x-jet-input id="mobile_phone_number" name="mobile_phone_number" type="text" class="mt-1 block w-full" wire:model.defer="mobile_phone_number" autofocus />
                    @error('mobile_phone_number')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Mobile phone number is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror

                    <div class="mt-2"></div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" name="email" type="text" class="mt-1 block w-full" wire:model.defer="email" autofocus />
                    @error('email')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Email is mandatory and should be more than three characters.</p>
                    </div>
                    @enderror

                    <div class="mt-2"></div>

                    <x-jet-label for="membership_number" value="{{ __('Membership Number') }}" />
                    <x-jet-input id="membership_number" name="membership_number" type="text" class="mt-1 block w-full" wire:model.defer="membership_number" autofocus />
                    @error('membership_number')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>The membership number is mandatory, it should be more than three characters and unique.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>


                    <x-jet-label for="notes" value="{{ __('Notes') }}" />
                    <textarea id="notes" name="notes" wire:model.defer="notes" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
                    @error('notes')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Notes is mandatory, it should be more than three characters and unique.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>



                </div>



            </div>


            <div class="flex justify-end w-auto" >
                <div wire:loading wire:target="save" >
                    <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400" disabled>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                            </svg>
                            <p>Please wait...</p>
                        </div>
                    </button>
                </div>

            </div>


            <div class="flex justify-end w-auto" >
                <div wire:loading.remove wire:target="save" >
                    <button wire:click="save" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                        Add Branch
                    </button>

                </div>
            </div>

        </div>


    </div>
</div>

