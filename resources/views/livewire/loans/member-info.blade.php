
<div>


    <div class="w-full">
        <!-- message container -->

        <div class="w-full h-full grid justify-items-center">
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
