<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200" style="height: 116px;">

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                    <div>
                        REPORTS GENERATOR
                    </div>

                </div>



            </div>




        </div>



        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">



            <!-- Left: Avatars -->
            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-2 flex  gap-2 items-center " style="height: 100px">

                <div class="ml-2">
                    <label for="category" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        Start Date
                    </label>


                    <div class="relative ">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide wire:model="startDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                </div>


                <div class="">
                    <label for="category" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        End Date
                    </label>


                    <div class="relative ">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide wire:model="endDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                </div>

                <div>
                    <label for="nodes" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        Internal nodes
                    </label>
                    <select wire:model.bounce="nodes" name="nodes" id="nodes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="All">All </option>
                        @foreach(\App\Models\NodesList::where('NODE_TYPE','INTERNAL_NODE')->whereNot('NODE_NAME', 'POSTILION')->get() as $node)
                        <option selected value="{{$node->NODE_NAME}}">{{$node->NODE_NAME}}</option>
                        @endforeach
                    </select>
                    @error('nodes')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>node is mandatory.</p>
                    </div>
                    @enderror
                </div>

                <div>
                    <label for="processorNodes" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        Processor Nodes
                    </label>
                    <select wire:model.bounce="processorNodes" name="processorNodes" id="processorNodes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="All">All </option>
                        @foreach(\App\Models\NodesList::where('NODE_TYPE','PROCESSOR_NODE')->get() as $node)
                        <option selected value="{{$node->NODE_NAME}}">{{$node->NODE_NAME}}</option>
                        @endforeach
                    </select>
                    @error('processorNodes')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>node is mandatory.</p>
                    </div>
                    @enderror
                </div>


                <div class="hidden">
                    <label for="services" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        Service
                    </label>
                    <select wire:model.bounce="services" name="services" id="services" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="All">All</option>
                        @foreach(\App\Models\servicesModel::get() as $service)
                        <option selected value="{{$service->NAME}}">{{$service->NAME}}</option>
                        @endforeach
                    </select>
                    @error('services')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>NewService is mandatory.</p>
                    </div>
                    @enderror
                </div>

                <div class="hidden">
                    <label for="channels" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        Channel
                    </label>
                    <select wire:model.bounce="channels" name="channels" id="channels" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="All">All</option>
                        @foreach(\App\Models\ChannelsModel::get() as $channel)
                        <option selected value="{{$channel->NAME}}">{{$channel->NAME}}</option>
                        @endforeach
                    </select>
                    @error('channels')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>channel is mandatory.</p>
                    </div>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">
                        Non / Matching / Resolved
                    </label>
                    <select wire:model.bounce="type" name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="All">All</option>
                        <option value="NULL">Non Matching</option>
                        <option value="PASSED">Matching</option>
                        <option value="RESOLVED">Resolved</option>
                    </select>
                    @error('result')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>result is mandatory.</p>
                    </div>
                    @enderror
                </div>

                <script>
                    flatpickr('[datepicker]', {
                        dateFormat: "Y-m-d"
                        , autoHide: true
                        , allowInput: true
                        , minDate: "2000-01-01"
                        , maxDate: new Date().fp_incr(14)
                    });

                </script>




            </div>



        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <div class="w-full border-b border-gray-200 dark:border-gray-700">

            </div>


            <div class="w-full flex items-center justify-center p-4">
                <div wire:loading wire:target="setView">
                    <div class="h-96 m-auto flex items-center justify-center">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                    </div>
                </div>
            </div>
            <div wire:loading.remove wire:target="setView">
                <livewire:reports-report />
            </div>



        </div>


    </div>







    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showResolveModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">











            <div>
                @if (session()->has('message'))

                @if (session('alert-class') == 'alert-success')
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" /></svg></div>
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
                        <h5>
                            RESOLVE NON MATCHING TRANSACTION WITH THIRDPART RN: {{\App\Models\Transactions::where('ID',$this->transactionToReview)->value('DB_TABLE_REFERENCE')}}
                        </h5>
                        <h5>
                            DESCRIPTION: {{\App\Models\Transactions::where('id',$this->transactionToReview)->value('PROCESSOR_TABLE_DESCRIPTION')}}
                        </h5>
                        <h5>
                            OF DATE: {{\App\Models\Transactions::where('id',$this->transactionToReview)->value('VALUE_DATE')}}
                        </h5>
                    </div>




                    @if($this->transactionToReview)

                    <div class="form-group col-span-6 sm:col-span-4 mb-4">



                        <textarea wire:model.defer="comments" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write reasons..."></textarea>

                        @error('comments')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Please write reasons.</p>
                        </div>
                        @enderror

                    </div>

                    @endif

                </div>
            </div>

















        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showResolveModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="saveResolution">
                <x-jet-button class="ml-3" wire:click="saveResolution" wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="saveResolution">
                <x-jet-button class="ml-3 ">
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>


</div>
