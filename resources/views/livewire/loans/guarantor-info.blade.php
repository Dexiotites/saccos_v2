
<div>


    <div class="w-full">
        <!-- message container -->

        <div class="w-full h-full grid justify-items-center">

            <div class="flex justify-center px-4 pt-4 pb-4">




                <input wire:model.bounce="member_number" type="text" id="first_name" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900
                            bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4
                            focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600
                            dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700
                         dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Guarantor Number" @disabled(Session::get('disableInputs'))>



                <div class="flex justify-end w-auto" >
                    <div wire:loading wire:target="set" >
                        <button class="ml-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900
                            bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4
                            focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600
                            dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700
                         dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
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
                    <div wire:loading.remove wire:target="set" >
                        <button wire:click="set" class="ml-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900
                            bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4
                            focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600
                            dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700
                         dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @disabled(Session::get('disableInputs'))>
                            <p class="text-gray-700">Set</p>
                        </button>

                    </div>
                </div>




            </div>



            @foreach($this->member as $currentMember)
                <div class="w-fit m-auto grid justify-items-center">
                    <div class="w-fit text-center m-4" >

                        <div style="display: flex; justify-content: center;">
                            <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                 src="{{$currentMember->profile_photo_path}}"
                                 alt="{{$currentMember->first_name}}"/>
                        </div>

                        <p class="text-2xl mt-4 border-b-2 border-b-blue-400 ">{{$currentMember->first_name}} {{$currentMember->middle_name}} {{$currentMember->last_name}}</p>
                        <p class="m-4">{{$currentMember->address}}</p>
                    </div>
                    <div class="w-fit bg-gray-200 rounded-lg pl-2 pr-2 pt-2 pb-2 mb-2 ml-2 mr-2">
                        <!-- message container -->

                        <div>

                            <div class="flex">

                                <div class="container mx-auto ">
                                    <div class="flex flex-col w-full" >

                                        <div class="grid gap-2 grid-cols-1 sm:grid-cols-2 mb-2">


                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >


                                                <table>

                                                    <tbody class="bg-white">
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Gender</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->gender}}
                                                            </p>
                                                        </td>

                                                    </tr>
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Marital status</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->marital_status}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Date of birth</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->date_of_birth}}
                                                            </p>
                                                        </td>

                                                    </tr>


                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Mobile phone number</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->mobile_phone_number}}
                                                            </p>
                                                        </td>

                                                    </tr>


                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Email</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->email}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Membership Number</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->membership_number}}
                                                            </p>
                                                        </td>

                                                    </tr>





                                                    </tbody>
                                                </table>


                                            </div>


                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >


                                                <table>

                                                    <tbody class="bg-white">
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Membership Type</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->membership_type}}
                                                            </p>
                                                        </td>

                                                    </tr>
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Business Name</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{$currentMember->business_name}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Incorporation Number</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$currentMember->incorporation_number}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Address</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{$currentMember->address}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Street</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{$currentMember->street}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Notes</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{$currentMember->notes}}
                                                            </p>
                                                        </td>

                                                    </tr>


                                                    </tbody>
                                                </table>


                                            </div>



                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-1 w-full">

                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >


                                                <div class="flex justify-between items-center w-full">
                                                    <div class="flex items-center">

                                                        <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">Member Shares

                                                        </p>


                                                    </div>

                                                </div>



                                                <table class="w-full" >
                                                    @foreach(App\Models\AccountsModel::where('member_number',$this->member_number)->where('product_number','11')->get() as $account)

                                                        <tr >
                                                            <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                                <p> {{App\Models\sub_products::where('product_id','11')->where('sub_product_id',$account->sub_product_number)->value('sub_product_name')}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  text-slate-400 dark:text-white">

                                                                <p>{{strtolower($account -> account_number)}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-l font-bold font-semibold spacing-sm  text-black dark:text-white text-right">

                                                                <p>{{number_format($account->balance,2)}} TZS</p>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                    <tr >
                                                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                                Member Savings
                                                            </p>
                                                        </td>


                                                    </tr>
                                                    @foreach(App\Models\AccountsModel::where('member_number',$this->member_number)->where('product_number','12')->get() as $account)

                                                        <tr >
                                                            <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                                <p> {{App\Models\sub_products::where('product_id','12')->where('sub_product_id',$account->sub_product_number)->value('sub_product_name')}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  text-slate-400 dark:text-white">

                                                                <p> {{strtolower($account -> account_number)}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-l font-bold font-semibold spacing-sm  text-black dark:text-white text-right">

                                                                <p> {{number_format($account->balance,2)}} TZS</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr >
                                                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                                Member Deposits
                                                            </p>
                                                        </td>


                                                    </tr>

                                                    @foreach(App\Models\AccountsModel::where('member_number',$this->member_number)->where('product_number','13')->get() as $account)

                                                        <tr >
                                                            <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                                <p> {{App\Models\sub_products::where('product_id','13')->where('sub_product_id',$account->sub_product_number)->value('sub_product_name')}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  text-slate-400 dark:text-white">

                                                                <p> {{strtolower($account -> account_number)}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-l font-bold font-semibold spacing-sm  text-black dark:text-white text-right">

                                                                <p>  {{number_format($account->balance,2)}} TZS</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr >
                                                        <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                                Member Loans
                                                            </p>
                                                        </td>


                                                    </tr>


                                                    @foreach(App\Models\AccountsModel::where('member_number',$this->member_number)->where('product_number','14')->get() as $account)

                                                        <tr >
                                                            <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                                <p>  {{App\Models\sub_products::where('product_id','14')->where('sub_product_id',$account->sub_product_number)->value('sub_product_name')}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  text-slate-400 dark:text-white">

                                                                <p> {{strtolower($account -> account_number)}}</p>
                                                            </td>
                                                            <td class="pl-2 mt-2 text-l font-bold font-semibold spacing-sm  text-black dark:text-white text-right">

                                                                <p> {{number_format($account->balance,2)}} TZS </p>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </table>
                                            </div>




                                        </div>




                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>




    </div>

</div>

