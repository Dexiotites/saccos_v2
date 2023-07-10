<div class="grid grid-cols-8 grid-rows-1" >


    <!-- sidebar 2 -->
    <div class="row-span-1 col-span-1 bg-slate-50 border-r flex flex-col">

        <div class="h-16 border-b flex justify-between items-center w-full px-5 py-2 shadow-sm bg-white">
            <div class="flex items-center">

                <p class="font-semibold ml-3 text-slate-600">Human Resources</p>
            </div>
            <div class="flex items-center space-x-5">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-slate-400" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>



            </div>
        </div>

        <div class="h-full">

            <div wire:click="menuItemClicked(1)"
                 class="@if( $tab_id == 1 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center   cursor-pointer border-l-4  hover:bg-slate-100">

                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Employees
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Employees List</p>
                </div>
            </div>


            <div wire:click="menuItemClicked(2)"
                 class="@if( $tab_id == 2 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">New Employee Registration
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Register new employee</p>
                </div>
            </div>

            <div wire:click="menuItemClicked(3)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Departments
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Departments Management</p>
                </div>
            </div>

            <div wire:click="menuItemClicked(4)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Performance tracking
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Performance tracking</p>
                </div>
            </div>

            <div wire:click="menuItemClicked(5)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">PayRoll
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >PayRoll Management</p>
                </div>
            </div>

            <div wire:click="menuItemClicked(6)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Job Applications
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >New applications Management</p>
                </div>
            </div>

            <div wire:click="menuItemClicked(7)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Training
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Employee training plan</p>
                </div>
            </div>

            <div wire:click="menuItemClicked(8)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Staff loans
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Manage Staff loans</p>
                </div>
            </div>
            <!-- else -->

            <div wire:click="menuItemClicked(8)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Staff Benefits
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Manage Staff Benefits</p>
                </div>
            </div>
            <!-- else -->

            <div wire:click="menuItemClicked(8)"
                 class="@if( $tab_id == 3 ) border-l-blue-400 border-t border-b  bg-white @else border-l-transparent @endif
                        px-5 py-4   flex items-center cursor-pointer border-l-4 hover:bg-slate-100">
                <div class="">
                    <p  class="text-xs font-semibold text-slate-600 m-0 p-0">Taxes and contributions
                    </p>
                    <p class="text-xs text-slate-400 -mt-0.5 font-semibold" >Manage Staff Taxes/Contributions</p>
                </div>
            </div>
            <!-- else -->


        </div>



    </div>

    <div class="row-span-1 col-span-7 flex flex-col">
        <div class="h-16 border-b flex justify-between items-center w-full px-5 py-2 shadow-sm">
            <div class="flex items-center">
                <div wire:loading wire:target="menuItemClicked" >
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                        </svg>
                        <p>Please wait...</p>
                    </div>

                </div>
                <div wire:loading.remove wire:target="menuItemClicked">


                    <p class="font-semibold ml-3 text-slate-600">{{$this->title}}</p>

                </div>

            </div>
            <div class="flex items-center space-x-5" hidden>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-slate-400" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg>

            </div>
        </div>



        <div class="flex justify-center pt-4 pb-4" >

            @if($this->tab_id == 1 )
                <livewire:h-r.employees-list/>
            @endif

            @if($this->tab_id == 2 )
                <livewire:h-r.new-employee/>
            @endif

            @if($this->tab_id == 3 )
                <livewire:h-r.new-savings-account/>
            @endif
        </div>


    </div>






</div>
