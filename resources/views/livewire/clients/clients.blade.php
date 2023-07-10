<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <!-- Background illustration -->
            <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                        <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                        <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                            <stop stop-color="#A5B4FC" offset="0%" />
                            <stop stop-color="#27AAE2" offset="100%" />
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#4338CA" offset="0%" />
                            <stop stop-color="#27AAE2" stop-opacity="0" offset="100%" />
                        </linearGradient>
                    </defs>
                    <g fill="none" fill-rule="evenodd">
                        <g transform="rotate(64 36.592 105.604)">
                            <mask id="welcome-d" fill="#fff">
                                <use xlink:href="#welcome-a" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                        </g>
                        <g transform="rotate(-51 91.324 -105.372)">
                            <mask id="welcome-f" fill="#fff">
                                <use xlink:href="#welcome-e" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                        <g transform="rotate(44 61.546 392.623)">
                            <mask id="welcome-h" fill="#fff">
                                <use xlink:href="#welcome-g" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                    </g>
                </svg>


            </div>

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="orange"
                         class="p-2 mr-2 rounded-full h-9 bg-slate-50 stroke-slate-800">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <div>
                        CLIENTS STATUS
                        <div class="flex items-center text-sm font-semibold text-red-600 spacing-sm">
                            Available Clients - {{$this->totalClients}} clients
                        </div>
                        <div class="flex items-center text-sm font-semibold text-red-600 spacing-sm">
                            Inactive Clients - {{$this->inActiveClients}} clients
                        </div>

                    </div>

                </div>



            </div>




        </div>



        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">

            <!-- Left: Avatars -->
            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-2 flex  items-center">


                <div class="inline-flex rounded-2xl m-auto flex w-full" role="group" style="height: 50px; width: 100%;">
                    <button wire:click="setView(1)" type="button" class=" @if($this->selected == 1) bg-blue-100 text-blue-700 @else text-gray-500 bg-transparent @endif
                    w-1/4 inline-flex items-center px-2 py-2
                    text-sm font-medium
                    border border-gray-300 rounded-l-lg hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-200
                    focus:bg-blue-100 focus:text-blue-700 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-blue-100
                    dark:focus:bg-blue-100" style="text-transform: uppercase;">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        Clients List
                    </button>
                    <button wire:click="setView(2)" type="button" class="@if($this->selected == 2) bg-blue-100 text-blue-700 @else text-gray-500 bg-transparent @endif
                    w-1/4 inline-flex items-center px-2 py-2
                    text-sm font-medium
                    border border-gray-300 hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-200
                    focus:bg-blue-100 focus:text-blue-700 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-blue-100
                    dark:focus:bg-blue-100" style="text-transform: uppercase;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                        Add A Client
                    </button>
                    <button wire:click="setView(3)"  type="button" class=" @if($this->selected == 3) bg-blue-100 text-blue-700 @else text-gray-500 bg-transparent @endif
                    w-1/4 inline-flex items-center px-2 py-2
                    text-sm font-medium
                    border border-gray-300 hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-200
                    focus:bg-blue-100 focus:text-blue-700 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-blue-100
                    dark:focus:bg-blue-100" style="text-transform: uppercase;">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>


                        Edit A Client
                    </button>
                    <button wire:click="setView(4)"  type="button" class="@if($this->selected == 4) bg-blue-100 text-blue-700 @else text-gray-500 bg-transparent @endif
                    w-1/4 inline-flex items-center px-2 py-2
                    text-sm font-medium
                    border border-gray-300 rounded-r-lg hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-200
                    focus:bg-blue-100 focus:text-blue-700 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-blue-100
                    dark:focus:bg-blue-100" style="text-transform: uppercase;">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>


                        Delete A Client
                    </button>
                </div>

            </div>



        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <div class="tab-pane fade " id="tabs-homeJustify"
                 role="tabpanel" aria-labelledby="tabs-home-tabJustify">
                <div class="mt-2"></div>
                <div class="w-full flex items-center justify-center">
                    <div wire:loading wire:target="setView">
                        <div class="h-96 m-auto flex items-center justify-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                        </div>
                    </div>
                </div>
                <div wire:loading.remove wire:target="setView">
                    @switch($this->selected)
                        @case('1')
                            <livewire:clients.clients-table/>
                            @break
                        @case('2')
                            <livewire:clients.add-client/>
                            @break
                        @case('3')
                            <livewire:clients.edit-client/>
                            @break
                        @case('4')
                            <livewire:clients.delete-client/>
                            @break

                        @default
                            <livewire:clients.clients-table/>
                    @endswitch
                </div>

            </div>



        </div>


    </div>

</div>


