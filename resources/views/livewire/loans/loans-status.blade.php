
<div>
@if(Session::get('currentloanMember'))


    <div class="w-full" >




        <nav class="bg-gray-800 rounded-lg pl-2 pr-2 shadow-2xl">

                <div class="relative flex h-16 items-center justify-between">

                    <div class="flex flex-1 items-center justify-between">
                        <div class="flex flex-shrink-0 items-start">

                            <div class="flex items-center justify-between">
                                <div wire:loading wire:target="menuItemClicked" >
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                        </svg>
                                        <p>Please wait...</p>
                                    </div>

                                </div>
                                <div wire:loading.remove wire:target="menuItemClicked">

                                    <div class="flex items-center justify-between">
                                        <div>
                                            <button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">

                                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                            </button>
                                        </div>
                                        <p class="font-semibold ml-3 text-slate-600">{{App\Models\Members::where('membership_number',Session::get('currentloanMember'))->value('first_name').' '.App\Models\Members::where('membership_number',Session::get('currentloanMember'))->value('middle_name').' '.App\Models\Members::where('membership_number',Session::get('currentloanMember'))->value('last_name')}}</p>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="flex">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default:"text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="#" wire:click="showTab('member')" class=" @if($this->activeTab == 'member') bg-gray-900 @endif  guarantor text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Member</a>
                                <a href="#" wire:click="showTab('guarantor')" class=" @if($this->activeTab == 'guarantor') bg-gray-900 @endif   text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Guarantors</a>
                                <a href="#" wire:click="showTab('business')" class=" @if($this->activeTab == 'business') bg-gray-900 @endif  text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Business Information</a>

                                <a href="#" wire:click="showTab('collateral')" class=" @if($this->activeTab == 'collateral') bg-gray-900 @endif  text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Collateral Information</a>
                                <a href="#" wire:click="showTab('assessment')" class=" @if($this->activeTab == 'assessment') bg-gray-900 @endif  text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Assessment</a>
                            </div>

                            <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">

                                <svg wire:click="close" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                        </div>
                    </div>

                </div>

        </nav>








        <div class="w-full rounded-lg pl-1 pr-1 pt-1 pb-1 m-1">


            <div class="bg-white">
                    @if ($activeTab === 'member')
                        <livewire:loans.member-info/>
                    @endif
                    @if ($activeTab === 'guarantor')
                        <livewire:loans.guarantor-info/>
                     @endif
                     @if ($activeTab === 'business')
                        <livewire:loans.business-data/>
                     @endif
                     @if ($activeTab === 'collateral')
                        <livewire:loans.collateral-info/>
                     @endif
                     @if ($activeTab === 'assessment')
                        <livewire:loans.assessment/>
                    @endif

            </div>
          </div>




    </div>


@else


    <div class="w-full" >
        <div class="w-fit bg-gray-200 rounded-lg pl-1 pr-1 pt-1 pb-1 m-1">
            <livewire:loans.loans-table/>
        </div>
    </div>

@endif




<script>
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-pane');

    tabLinks.forEach((tabLink) => {
      tabLink.addEventListener('click', (event) => {
        event.preventDefault();
        const target = event.target.getAttribute('href').substring(1);
        tabLinks.forEach((link) => link.classList.remove('active'));
        tabContents.forEach((content) => content.classList.remove('show', 'active'));
        event.target.classList.add('active');
        document.getElementById(target).classList.add('show', 'active');
      });
    });
  </script>


</div>
