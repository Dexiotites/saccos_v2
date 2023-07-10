<div class="w-full p-2" >
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


    <div class="bg-gray-100 rounded rounded-lg shadow-sm ">







        <div class="flex gap-2 pt-2 pl-2 pr-2 pb-2">

            <div class="w-1/3 bg-white rounded px-6 rounded-lg shadow-sm   pt-4 pb-4 " >

                <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Client Name</p>
                <input type="text" id="name" name="name"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700
                    dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       wire:model.lazy="name"  required>
                @error('name')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>The name is mandatory and should be more than two characters.</p>
                </div>
                @enderror
                <div class="mt-2"></div>



                @foreach($this->channelsList as $channel)
                    <div class="bg-gray-100 rounded rounded-lg shadow-sm p-2 mt-2">

                        <div class="flex items-center text-sm font-semibold spacing-sm text-slate-600" >
                            {{App\Models\ChannelsModel::where('ID',$channel)->value('NAME')}}
                        </div>

                        <div class="mt-2"></div>

                        <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            DB_TABLE_CLIENT_IDENTIFIER
                        </p>

                        <div class="mt-1"></div>

                        <div class="flex">
                            <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700
                    dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   wire:model.lazy="DB_TABLE_CLIENT_IDENTIFIER"  required>
                            @error('DB_TABLE_CLIENT_IDENTIFIER')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>DB_TABLE_SERVICE_IDENTIFIER is mandatory and should be more than two characters.</p>
                            </div>
                            @enderror

                            <div>
                                <div class="flex justify-end w-auto" >
                                    <div wire:loading wire:target="set" >
                                        <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400" disabled>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>
                                                <p>Wait...</p>
                                            </div>
                                        </button>
                                    </div>

                                </div>


                                <div class="flex justify-end w-auto" >
                                    <div wire:loading.remove wire:target="set" >
                                        <button wire:click="set" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                            <p class="text-white">Set</p>
                                        </button>

                                    </div>
                                </div>
                            </div>

                        </div>






                    </div>
                @endforeach



                <div class="w-full flex items-stretch mt-4">

                    <div class="w-full" >

                        <select wire:model.bounce="NewChannel" name="NewChannel" id="NewChannel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">ADD A CHANNEL</option>
                            @foreach($this->channels as $channel)
                                <option selected value="{{$channel->ID}}">{{$channel->NAME}}</option>
                            @endforeach

                        </select>
                        @error('category')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Branch is mandatory.</p>
                        </div>
                        @enderror


                    </div>


                    <div class="w-1/2 ml-2" >


                    </div>



                </div>



                <hr class="border-b-0 my-6"/>

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
                            <p class="text-white">Save Client</p>
                        </button>

                    </div>
                </div>


            </div>


            <div class="w-2/3 bg-white rounded px-6 rounded-lg shadow-sm  pt-4 pb-4  " >




            </div>



        </div>




    </div>


</div>
