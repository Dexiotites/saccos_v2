<div class="w-2/3">
    <div>



        <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">

            @foreach($this->approvals as $approval)


                <div class="flex items-center justify-between ">

                    <div class="flex-1 pl-2">
                        <p class="text-gray-700 font-semibold">
                            {{App\Models\User::where('id',$approval->user_id)->value('name')}}
                            {{$approval->process_description}}.
                        </p>


                        @if( $approval->process_code == '12')
                            @foreach(App\Models\Members::where('id',$approval->process_id)->get() as $member)
                                <div class="w-full flex">

                                    <div class="w-3/4">
                                        <p class="text-gray-700 font-semibold">
                                            Member Name : {{ $member->first_name }} {{$member->middle_name  }} {{$member->last_name  }} {{$member->business_name}}

                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Membership Type : {{$member->membership_type}}
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Membership Number : {{$member->membership_number}}
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Branch : {{App\Models\Branches::where(
                                                'id',
                                                $member->branch
                                                )->value('name')}}
                                        </p>
                                    </div>

                                    <div class="w-1/4">
                                        <div style="display: flex; justify-content: center;">
                                            <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                                 src="https://zima.services/pamojacbs/storage/app/photos/{{$member->profile_photo_path}}"
                                                 alt="{{$member->first_name}}"/>
                                        </div>
                                    </div>


                                </div>



                                @foreach(App\Models\AccountsModel::where('member_number',$member->membership_number)->get() as $accounts)

                                    <div class="flex-1">


                                        <p class="text-gray-600 font-thin">
                                            Account Product : {{App\Models\sub_products::where('sub_product_id',$accounts->sub_product_number)->value('sub_product_name')}}
                                        </p>
                                        <p class="text-gray-600 font-thin">
                                            Account Number : {{$accounts->account_number}}
                                        </p>
                                    </div>



                                @endforeach





                                <div class="w-full md:flex mt-2 flex justify-end" >

                                    <div class="flex mr-4" >
                                        <div wire:loading wire:target="reject({{$member->id}},'{{$approval->id}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="reject({{$member->id}},'{{$approval->id}}')">
                                            <button wire:click="reject({{$member->id}},'{{$approval->id}}')"
                                                    class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                                <p class="text-white">Reject</p>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="flex">
                                        <div wire:loading wire:target="clear({{$approval->id}})">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="clear({{$approval->id}})">
                                            <button wire:click="clear({{$approval->id}})"
                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                <p class="text-white">Clear</p>
                                            </button>

                                        </div>

                                    </div>


                                </div>

                            @endforeach
                        @endif



                    </div>




                </div>

                <hr class="boder-b-0 my-4"/>
            @endforeach

        </div>
    </div>
</div>
