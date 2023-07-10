
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


    <div class="w-full bg-gray-100 p-2 rounded-2xl shadow-md shadow-gray-200">


            <div class="w-full bg-white rounded-2xl shadow-md shadow-gray-200 p-4">

                <div class="w-1/3">
                    <div class="mb-4">
                        <h5 >
                            CREATE USER
                        </h5>
                    </div>


                    <form wire:submit.prevent="create">
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
                                <input id="phone_number" type="phone_number" class="mt-1 block w-full " wire:model.debounce.500ms="phone_number" required />
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


                        @if($this->showRoles)

                            <div class="flex items-end justify-end">



                                <button type="submit" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                    Set Roles
                                </button>
                            </div>
                        @else

                            <div class="flex items-end justify-end">



                                <button type="submit" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                    Create User
                                </button>
                            </div>
                        @endif


                    </form>
                </div>




            </div>



    </div>





</div>










