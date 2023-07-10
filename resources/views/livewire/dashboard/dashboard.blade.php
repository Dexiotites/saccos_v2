<div class="bg-white h-full w-full bg-fixed " style="height:90vh;">

    <div class="p-4 h-full w-full ">


        <div class="w-full h-full grid justify-items-center">

            <div class="w-fit m-auto grid justify-items-center">
                <div class="w-fit text-center m-2">
                    <p class="text-2xl mt-2 border-b-2 border-b-blue-400 ">{{App\Models\institutions::where('institution_id', '1001')->value('name')}}</p>
                    <p class="m-4">{{App\Models\institutions::where('institution_id', Session::get('institution'))->value('region')}}
                        , {{App\Models\institutions::where('institution_id', Session::get('institution'))->value('wilaya')}}</p>
                </div>
                <div class="w-fit bg-gray-200 rounded-lg pl-2 pr-2 pt-1 pb-1 ">
                    <!-- message container -->

                    <div>

                        <div class="flex">

                            <div class="container mx-auto ">



                                @if(Session::get('userRole') == 'Teller')

                                    <div class="flex flex-col w-full">
                                        <div class="w-full flex space-x-1">

                                            <div class="w-1/2 metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72">

                                                <div>
                                                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                        Deposit Cash

                                                    </p>
                                                    <div>
                                                        @if (session()->has('message1'))

                                                            @if (session('alert-class') == 'alert-success')
                                                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                                                                     role="alert">
                                                                    <div class="flex">
                                                                        <div class="py-1">
                                                                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 20 20">
                                                                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                                                            </svg>
                                                                        </div>
                                                                        <div>
                                                                            <p class="font-bold">The process is
                                                                                completed</p>
                                                                            <p class="text-sm">{{ session('message') }} </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <hr class="boder-b-0 my-4"/>

                                                    <div class="">

                                                        <p for="bank"
                                                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                            Select Bank</p>
                                                        <select wire:model.bounce="bank" name="bank" id="bank"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option selected value="">Select</option>
                                                            @foreach(App\Models\AccountsModel::where('sub_product_number', '91')->get() as $bank)
                                                                <option value="{{$bank->account_number}}">{{$bank->account_name}}
                                                                    - {{$bank->account_number}}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('member')
                                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                            <p>Branch is mandatory.</p>
                                                        </div>
                                                        @enderror
                                                        <div class="mt-2"></div>


                                                        <p for="reference_number"
                                                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                            Enter Reference Number</p>

                                                        <x-jet-input id="reference_number" type="text"
                                                                     name="reference_number" class="mt-1 block w-full"
                                                                     wire:model.bounce="reference_number" autofocus/>
                                                        @error('reference_number')
                                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                            <p>Reference Number is mandatory and should be more than two
                                                                characters.</p>
                                                        </div>
                                                        @enderror
                                                        <div class="mt-2"></div>

                                                        <p for="member"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                            Select Member</p>
                                                        <select wire:model.bounce="member" name="member" id="member"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option selected value="">Select</option>
                                                            <option selected value="new">New Member</option>
                                                            @foreach(App\Models\Members::all() as $members)
                                                                <option value="{{$members->membership_number}}">{{$members->first_name}} {{$members->middle_name}} {{$members->last_name}}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('member')
                                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                            <p>Branch is mandatory.</p>
                                                        </div>
                                                        @enderror
                                                        <div class="mt-2"></div>

                                                        @if($this->member)

                                                            @if($this->member=='new')

                                                                <p for="member"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                                    Select Deposit Type</p>
                                                                <select wire:model.bounce="depositType" name="depositType" id="depositType"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                    <option selected value="">Select</option>
                                                                    <option selected value="RegistrationFee">Registration Fee</option>
                                                                    <option selected value="MandatoryShares">Mandatory Shares</option>

                                                                </select>
                                                                @error('depositType')
                                                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                                    <p>Deposit Type is mandatory.</p>
                                                                </div>
                                                                @enderror
                                                                <div class="mt-2"></div>

                                                                @if($this->depositType=='RegistrationFee')
                                                                    <p for="registrationFee"
                                                                       class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                        Amount</p>
                                                                    <x-jet-input disabled id="registrationFee" type="number" name="registrationFee"
                                                                                 class="mt-1 block w-full placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                                                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                                                                  invalid:border-pink-500 invalid:text-pink-600
                                                                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                                                                                 wire:model.bounce="registrationFee" />
                                                                @endif
                                                                @if($this->depositType=='MandatoryShares')
                                                                    <p for="amount"
                                                                       class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                        Amount</p>
                                                                    <x-jet-input disabled id="initial_shares_value" type="number" name="initial_shares_value"
                                                                                 class="mt-1 block w-full placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                                                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                                                                  invalid:border-pink-500 invalid:text-pink-600
                                                                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                                                                                 wire:model.bounce="initial_shares_value" />
                                                                @endif

                                                                <div class="mt-2"></div>

                                                                <p for="new_member_deposit_notes"
                                                                   class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                    Enter Notes</p>
                                                                <x-jet-input id="new_member_deposit_notes" type="text" name="new_member_deposit_notes"
                                                                             class="mt-1 block w-full" wire:model.bounce="new_member_deposit_notes"
                                                                             />
                                                                @error('new_member_deposit_notes')
                                                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                                    <p>Notes is mandatory and should be more than two
                                                                        characters.</p>
                                                                </div>
                                                                @enderror


                                                            @else

                                                            <p for="member"
                                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                                Saving Accounts</p>


                                                            <table class="w-full">

                                                                @foreach(App\Models\AccountsModel::where('member_number',$this->member)->where(function($q) {$q->where('product_number', '=', '12')->orWhere('product_number', '=', '13');})->get() as $account)
                                                                    @php
                                                                        $this->account_number = $account->account_number;
                                                                    @endphp

                                                                    <tr>
                                                                        <td class="text-left">
                                                                            <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">
                                                                                {{strtolower(App\Models\sub_products::where('sub_product_id',$account->sub_product_number)->value('sub_product_name')) }}
                                                                            </p>
                                                                        </td>
                                                                        <td class="pl-4 text-right"><p
                                                                                    class="block text-sm font-medium text-red-500 dark:text-gray-400">{{$account->account_number}}</p>
                                                                        </td>
                                                                        <td class="text-right">


                                                                            <div wire:loading
                                                                                 wire:target="setAccount({{$account->account_number}})">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     class="animate-spin  h-9 w-9 stroke-gray-400 rounded-full p-2"
                                                                                     fill="white" viewBox="0 0 24 24"
                                                                                     stroke="currentColor" stroke-width="2">
                                                                                    <path stroke-linecap="round"
                                                                                          stroke-linejoin="round"
                                                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                                                </svg>
                                                                            </div>

                                                                            @if($this->accountSelected == $account->account_number)
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2"
                                                                                     fill="none" viewBox="0 0 24 24"
                                                                                     stroke="currentColor" stroke-width="2">
                                                                                    <path stroke-linecap="round"
                                                                                          stroke-linejoin="round"
                                                                                          d="M5 13l4 4L19 7"/>
                                                                                </svg>
                                                                            @else
                                                                                <div wire:loading.remove
                                                                                     wire:target="setAccount({{$account->account_number}})">
                                                                                    <svg wire:click="setAccount({{$account->account_number}})"
                                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                                         class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                                                                                         fill="none" viewBox="0 0 24 24"
                                                                                         stroke="currentColor"
                                                                                         stroke-width="2">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              d="M12 4v16m8-8H4"/>
                                                                                    </svg>
                                                                                </div>
                                                                            @endif

                                                                        </td>
                                                                    </tr>

                                                                @endforeach


                                                            </table>

                                                            @endif

                                                            <div class="mt-2"></div>
                                                        @endif


                                                        <div class="mt-2"></div>


                                                        @if($this->accountSelected)

                                                            <p for="amount"
                                                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                Enter Amount</p>
                                                            <x-jet-input id="amount" type="number" name="amount"
                                                                         class="mt-1 block w-full"
                                                                         wire:model.bounce="amount" autofocus/>
                                                            @error('amount')
                                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                                <p>Amount is mandatory and should be more than two
                                                                    characters.</p>
                                                            </div>
                                                            @enderror
                                                            <div class="mt-2"></div>

                                                            <p for="notes"
                                                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                Enter Notes</p>
                                                            <x-jet-input id="notes" type="text" name="notes"
                                                                         class="mt-1 block w-full" wire:model.bounce="notes"
                                                                         autofocus/>
                                                            @error('notes')
                                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                                <p>Notes is mandatory and should be more than two
                                                                    characters.</p>
                                                            </div>
                                                            @enderror
                                                        @endif

                                                        <div class="mt-2"></div>


                                                    </div>

                                                    <hr class="border-b-0 my-6"/>

                                                    <div class="flex justify-end w-auto">
                                                        <div wire:loading wire:target="process">
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

                                                    </div>


                                                    <div class="flex justify-end w-auto">
                                                        <div wire:loading.remove wire:target="process">
                                                            <button wire:click="process"
                                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                                <p class="text-white">Deposit</p>
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="w-1/2 metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72">
                                                <div>
                                                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                        Withdraw Cash

                                                    </p>
                                                    <div>
                                                        @if (session()->has('message2'))

                                                            @if (session('alert-class') == 'alert-success')
                                                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                                                                     role="alert">
                                                                    <div class="flex">
                                                                        <div class="py-1">
                                                                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 20 20">
                                                                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                                                            </svg>
                                                                        </div>
                                                                        <div>
                                                                            <p class="font-bold">The process is
                                                                                completed</p>
                                                                            <p class="text-sm">{{ session('message') }} </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <hr class="boder-b-0 my-4"/>

                                                    <div class="">

                                                        <p for="bank1"
                                                           class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                            Select Bank</p>
                                                        <select wire:model.bounce="bank1" name="bank1" id="bank1"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option selected value="">Select</option>
                                                            @foreach(App\Models\AccountsModel::where('sub_product_number', '91')->get() as $bank)
                                                                <option value="{{$bank->account_number}}">{{$bank->account_name}}
                                                                    - {{$bank->account_number}}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('member')
                                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                            <p>Branch is mandatory.</p>
                                                        </div>
                                                        @enderror
                                                        <div class="mt-2"></div>


                                                        <p for="member1"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                            Select Member</p>
                                                        <select wire:model.bounce="member1" name="member1" id="member1"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option selected value="">Select</option>
                                                            @foreach(App\Models\Members::all() as $members)
                                                                <option value="{{$members->membership_number}}">{{$members->first_name}} {{$members->middle_name}} {{$members->last_name}}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('member1')
                                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                            <p>Branch is mandatory.</p>
                                                        </div>
                                                        @enderror
                                                        <div class="mt-2"></div>

                                                        @if($this->member1)

                                                            <p for="member"
                                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                                Saving Accounts</p>


                                                            <table class="w-full">

                                                                @foreach(App\Models\AccountsModel::where('member_number',$this->member1)->where('product_number', '=', '13')->get() as $account1)
                                                                    @php
                                                                        $this->account_number1 = $account1->account_number;
                                                                    @endphp

                                                                    <tr>
                                                                        <td class="text-left">
                                                                            <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">
                                                                                {{strtolower(App\Models\sub_products::where('sub_product_id',$account1->sub_product_number)->value('sub_product_name')) }}
                                                                            </p>
                                                                        </td>
                                                                        <td class="pl-4 text-right"><p
                                                                                    class="block text-sm font-medium text-red-500 dark:text-gray-400">{{$account1->account_number}}</p>
                                                                        </td>
                                                                        <td class="text-right">


                                                                            <div wire:loading
                                                                                 wire:target="setAccount1({{$account1->account_number}})">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     class="animate-spin  h-9 w-9 stroke-gray-400 rounded-full p-2"
                                                                                     fill="white" viewBox="0 0 24 24"
                                                                                     stroke="currentColor" stroke-width="2">
                                                                                    <path stroke-linecap="round"
                                                                                          stroke-linejoin="round"
                                                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                                                </svg>
                                                                            </div>

                                                                            @if($this->accountSelected1 == $account1->account_number)
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2"
                                                                                     fill="none" viewBox="0 0 24 24"
                                                                                     stroke="currentColor" stroke-width="2">
                                                                                    <path stroke-linecap="round"
                                                                                          stroke-linejoin="round"
                                                                                          d="M5 13l4 4L19 7"/>
                                                                                </svg>
                                                                            @else
                                                                                <div wire:loading.remove
                                                                                     wire:target="setAccount1({{$account1->account_number}})">
                                                                                    <svg wire:click="setAccount1({{$account1->account_number}})"
                                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                                         class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                                                                                         fill="none" viewBox="0 0 24 24"
                                                                                         stroke="currentColor"
                                                                                         stroke-width="2">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              d="M12 4v16m8-8H4"/>
                                                                                    </svg>
                                                                                </div>
                                                                            @endif

                                                                        </td>
                                                                    </tr>

                                                                @endforeach


                                                            </table>



                                                            <div class="mt-2"></div>
                                                        @endif


                                                        <div class="mt-2"></div>


                                                        @if($this->accountSelected1)

                                                            <p for="amount1"
                                                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                Enter Amount'</p>
                                                            <x-jet-input id="amount1" type="number" name="amount1"
                                                                         class="mt-1 block w-full"
                                                                         wire:model.bounce="amount1" autofocus/>
                                                            @error('amount1')
                                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                                <p>Amount is mandatory and should be more than two
                                                                    characters.</p>
                                                            </div>
                                                            @enderror
                                                            <div class="mt-2"></div>


                                                            <p for="notes1"
                                                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                                                Enter Notes'</p>
                                                            <x-jet-input id="notes1" type="text" name="notes1"
                                                                         class="mt-1 block w-full"
                                                                         wire:model.bounce="notes1" autofocus/>
                                                            @error('notes')
                                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                                <p>Notes is mandatory and should be more than two
                                                                    characters.</p>
                                                            </div>
                                                            @enderror
                                                        @endif

                                                        <div class="mt-2"></div>


                                                    </div>

                                                    <hr class="border-b-0 my-6"/>

                                                    <div class="flex justify-end w-auto">
                                                        <div wire:loading wire:target="process1">
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

                                                    </div>


                                                    <div class="flex justify-end w-auto">
                                                        <div wire:loading.remove wire:target="process1">
                                                            <button wire:click="process1"
                                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                                <p class="text-white">Withdraw</p>
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                        </div>
                                        <div class="w-full flex space-x-1">

                                            <div class="w-1/2 metric-card  dark:bg-gray-900 border @if($this->item == 7) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72">

                                                <div class="flex justify-between items-center w-full">
                                                    <div class="flex items-center">
                                                        <div wire:loading wire:target="visit(7)">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="animate-spin  h-5 w-5 mr-2 stroke-gray-400"
                                                                     fill="white" viewBox="0 0 24 24" stroke="currentColor"
                                                                     stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                                </svg>


                                                                <p>Please wait...</p>
                                                            </div>

                                                        </div>
                                                        <div wire:loading.remove wire:target="visit(7)">


                                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                                Total Deposits

                                                            </p>

                                                        </div>

                                                    </div>
                                                    <div class="flex items-center space-x-5">

                                                        <svg wire:click="visit(7)" xmlns="http://www.w3.org/2000/svg"
                                                             class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                             stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>


                                                    </div>
                                                </div>


                                                <table class="w-full">

                                                    <tr>
                                                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  text-left">
                                                            <p>At {{date("Y-m-d H:i:s")}}</p>
                                                        </td>
                                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-xl text-slate-400 dark:text-white text-right">
                                                            <p>7,900,000 TZS</p>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>


                                            <div class="w-1/2  metric-card  dark:bg-gray-900 border @if($this->item == 4) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 ">

                                                <div class="flex justify-between items-center w-full">
                                                    <div class="flex items-center">
                                                        <div wire:loading wire:target="visit(4)">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="animate-spin  h-5 w-5 mr-2 stroke-gray-400"
                                                                     fill="white" viewBox="0 0 24 24" stroke="currentColor"
                                                                     stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                                </svg>


                                                                <p>Please wait...</p>
                                                            </div>

                                                        </div>
                                                        <div wire:loading.remove wire:target="visit(4)">


                                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                                Total Withdrawals

                                                            </p>

                                                        </div>

                                                    </div>
                                                    <div class="flex items-center space-x-5">

                                                        <svg wire:click="visit(4)" xmlns="http://www.w3.org/2000/svg"
                                                             class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                             stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>


                                                    </div>
                                                </div>


                                                <table class="w-full">

                                                    <tr>
                                                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  text-left">
                                                            <p>At {{date("Y-m-d H:i:s")}}</p>
                                                        </td>
                                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-xl text-slate-400 dark:text-white text-right">
                                                            <p>900,000 TZS</p>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>


                                    </div>

                                @else
                                    <div>
                                        <div class="rounded shadow-xl overflow-hidden w-full md:flex my-1 bg-white flex justify-between">
                                            <h3 class="text-lg font-semibold leading-tight text-gray-800 m-4"> Receivables</h3>



                                            <div class="flex items-center justify-between mr-4">


                                                <div class="flex items-center space-x-5 ml-5" >

                                                    <div wire:loading wire:target="deleteBranch" >


                                                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                        </svg>

                                                    </div>

                                                    <div wire:loading.remove wire:target="deleteBranch" >

                                                        <svg xmlns="http://www.w3.org/2000/svg" wire:click="AddUser()"
                                                             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             class="h-9 bg-slate-50 rounded-full stroke-slate-400 p-2 cursor-pointer">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                        </svg>



                                                    </div>


                                                    <div wire:loading wire:target="deleteBranchv" >


                                                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                        </svg>

                                                    </div>

                                                    <div wire:loading.remove wire:target="deleteBranchv" >


                                                        <svg xmlns="http://www.w3.org/2000/svg" wire:click="deleteBranchv()"
                                                             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             class="h-9 bg-slate-50 rounded-full stroke-slate-400 p-2 cursor-pointer">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>



                                                    </div>





                                                </div>



                                            </div>




                                        </div>


                                        @foreach(App\Models\AccountsModel::where('sub_product_number', '91')->get() as $extAccount)

                                            @php
                                                $amountLoop = [];

                                                $date = date('F Y');//Current Month Year
                                                while (strtotime($date) <= strtotime(date('Y-m') . '-' . date('t', strtotime($date)))) {

                                                    $amount = App\Models\general_ledger::where('beneficiary_sub_product_id', '91')
                                                    ->where('record_on_account_number',$extAccount->account_number)
                                                    ->whereDate('created_at',$date)->sum('credit');

                                                    $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));//Adds 1 day onto current date

                                                    $amountLoop[] = $amount;
                                                }

                                                $this->deposits = $amountLoop;

                                                $mirror_balance = App\Models\AccountsModel::where('account_number', $extAccount->mirror_account)->value('balance');

                                                $difference = $mirror_balance + $extAccount->balance;

                                                if($difference == 0){
                                                    $reconStatus = 'Success';

                                                }else{
                                                   $reconStatus = 'Failed';
                                                }
                                            @endphp

                                            <div class="rounded shadow-xl overflow-hidden w-full md:flex my-1"
                                                 x-data='{stockTicker:stockTicker(
                                         {!! json_encode($this->days) !!},
                                         {!! json_encode($this->deposits) !!},
                                         {!! json_encode($extAccount->account_name) !!},
                                         {!! json_encode($extAccount->account_number) !!},
                                         {!! json_encode($extAccount->balance) !!},
                                         {!! json_encode($extAccount->mirror_account) !!},
                                         {!! json_encode($mirror_balance) !!},
                                         {!! json_encode($difference) !!},
                                         {!! json_encode($reconStatus) !!}
                                         )}'
                                                 x-init="stockTicker.renderChart('chart{{$extAccount->id}}')">
                                                <div class="flex w-full md:w-1/2 px-5 pb-4 pt-8 bg-indigo-500 text-white items-center">
                                                    <canvas id="chart{{$extAccount->id}}" class="w-full"></canvas>
                                                </div>
                                                <div class="flex w-full md:w-1/2 p-10 bg-white text-gray-600 items-center">
                                                    <div class="w-full">
                                                        <h3 class="text-lg font-semibold leading-tight text-gray-800"
                                                            x-text="stockTicker.stockFullName"></h3>
                                                        <h6 class="text-sm leading-tight mb-2"><span
                                                                    x-text="stockTicker.stockShortName"></span></h6>
                                                        <div class="flex w-full items-end mb-6">
                                                    <span class="block leading-none text-2xl text-gray-800"
                                                          x-text="nf.format(stockTicker.price.current)">0</span>
                                                            <span class="block leading-5 text-2xl ml-4 text-green-500"
                                                            > TZS</span>
                                                        </div>
                                                        <div class="flex w-full text-xs">
                                                            <div class="flex w-5/12">
                                                                <div class="flex-1 pr-3 text-left font-semibold">Mirror Account</div>
                                                                <div class="flex-1 px-3 text-right"
                                                                     x-text="stockTicker.price.open">0
                                                                </div>
                                                            </div>
                                                            <div class="flex w-7/12">
                                                                <div class="flex-1 px-3 text-left font-semibold">Mirror Account Balance
                                                                </div>
                                                                <div class="flex-1 pl-3 text-right"
                                                                     x-text="nf.format(stockTicker.price.cap)">0
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex w-full text-xs">
                                                            <div class="flex w-5/12">
                                                                <div class="flex-1 pr-3 text-left font-semibold">Difference</div>
                                                                <div class="px-3 text-right"
                                                                     x-text="nf.format(stockTicker.price.high)">0
                                                                </div>
                                                            </div>
                                                            <div class="flex w-7/12">
                                                                <div class="flex-1 px-3 text-left font-semibold">Reconciliation Status</div>
                                                                <div class="pl-3 text-right"
                                                                >{{$reconStatus}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex w-full text-xs">
                                                            <div class="flex w-5/12">
                                                                <div class="flex-1 pr-3 text-left font-semibold"></div>
                                                                <div class="px-3 text-right"
                                                                     x-text="stockTicker.price.low.toFixed(3)">
                                                                </div>
                                                            </div>
                                                            <div class="flex w-7/12">
                                                                <div class="flex-1 px-3 text-left font-semibold">

                                                                </div>
                                                                <div class="pl-3 text-right"
                                                                     x-text="`${stockTicker.price.dividend}`">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach


                                    </div>

                                @endif


                            </div>


                        </div>

                    </div>

                </div>
            </div>


        </div>

    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    let nf = new Intl.NumberFormat('en-US');
    Number.prototype.m_formatter = function () {
        return this > 999999 ? (this / 1000000).toFixed(1) + 'M' : this
    };
    let stockTicker = function (
        labels,
        data,
        stockFullName,
        stockShortName,
        currentBalance,
        mirror_account,
        mirror_balance,
        difference,
        reconStatus
    ) {
        return {
            stockFullName: stockFullName,
            stockShortName: stockShortName,
            price: {
                current: currentBalance,
                open: mirror_account,
                low: '',
                high: difference,
                cap: mirror_balance,
                ratio: reconStatus,
                dividend: ''
            },
            chartData: {
                labels: labels,
                data: data,
            },
            renderChart: function (divid) {

                //alert(xx);

                let c = false;

                Chart.helpers.each(Chart.instances, function (instance) {
                    if (instance.chart.canvas.id == divid) {
                        c = instance;
                    }
                });

                if (c) {
                    c.destroy();
                }

                let ctx = document.getElementById(divid).getContext('2d');

                let chart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: this.chartData.labels,
                        datasets: [
                            {
                                label: '',
                                backgroundColor: "rgba(255, 255, 255, 0.1)",
                                borderColor: "rgba(255, 255, 255, 1)",
                                pointBackgroundColor: "rgba(255, 255, 255, 1)",
                                data: this.chartData.data,
                            },
                        ],
                    },
                    layout: {
                        padding: {
                            right: 10
                        }
                    },
                    options: {
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: "rgba(255, 255, 255, 1)",
                                },
                                gridLines: {
                                    display: false,
                                },
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: "rgba(255, 255, 255, 1)",
                                },
                                gridLines: {
                                    color: "rgba(255, 255, 255, .2)",
                                    borderDash: [5, 5],
                                    zeroLineColor: "rgba(255, 255, 255, .2)",
                                    zeroLineBorderDash: [5, 5]
                                },
                            }]
                        }
                    }
                });
            }
        }
    }
</script>



