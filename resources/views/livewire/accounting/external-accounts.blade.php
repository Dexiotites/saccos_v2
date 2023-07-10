
<div class="w-4/6 flex">

    <div class="w-full">
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


            <div class="flex items-stretch">

                <div class="w-1/2 mr-2" >

                    <label for="bank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Bank</label>
                    <select wire:model.bounce="bank" name="bank" id="bank" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Select</option>
                        @foreach(App\Models\Banks::all() as $banks)
                            <option value="{{$banks->bank_number}}">{{$banks->bank_name}}</option>
                        @endforeach

                    </select>
                    @error('bank')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Branch is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    @if($this->bank)
                        <div class="flex justify-between">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Existing accounts</label>
                            <div>
                                @foreach(App\Models\AccountsModel::where('member_number',$this->member)->where('product_number','9')->get() as $account)
                                    @php
                                        $this->account_number = $account->account_number;
                                    @endphp
                                    <p class="block mb-2 text-sm font-medium text-red-500 dark:text-gray-400">{{$account->account_number}}</p>
                                @endforeach
                            </div>


                        </div>

                        <div class="mt-2"></div>
                    @endif
                    <x-jet-label for="account_number" value="{{ __('Enter Account Number') }}" />
                    <x-jet-input id="account_number" type="account_number" name="account_number" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model.bounce="account_number" autofocus />
                    @error('account_number')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Account Number is mandatory and should be more than two characters.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <label for="mirror_account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Internal Mirror Account</label>
                    <select wire:model.bounce="mirror_account" name="mirror_account" id="mirror_account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Select</option>
                        @foreach(App\Models\AccountsModel::where('sub_product_number','104')->get() as $product)
                            <option value="{{$product->account_number}}">{{$product->account_name}} - {{$product->account_number}}</option>
                        @endforeach

                    </select>
                    @error('mirror_account')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Branch is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>


                </div>


                <div class="w-1/2 ml-2" >


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
                        Save Account
                    </button>

                </div>
            </div>

        </div>



        <div class="mt-4 bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">

            @foreach(App\Models\AccountsModel::where('sub_product_number', '91')->get() as $branch)


                <div class="flex items-center justify-between ">

                    <div class="flex-1 pl-2">
                        <div class="text-gray-700 font-semibold">
                            {{$branch->account_name}}
                        </div>
                        <div class="flex justify-between text-gray-600 font-thin">
                            <div>
                                Account Number : {{$branch->account_number}}
                            </div>
                            <div class="text-blue-400">{{$branch->balance}} TZS</div>
                            <div>
                                Mirror Account Number : {{$branch->mirror_account}}
                            </div>

                        </div>
                    </div>





                </div>

                <hr class="border-b-0 my-4"/>
            @endforeach

        </div>




    </div>

</div>

