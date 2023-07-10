
<div>



<style>
    /* Accordion container styles */
.accordion {
    width: 100%;
  }

  /* Accordion item styles */
  .accordion-item {
    margin-bottom: 1rem;
  }

  /* Accordion toggle styles */
  .accordion-toggle {
    display: none;
  }

  /* Accordion title styles */
  .accordion-title {
    cursor: pointer;
    padding: 0.75rem 1rem;
    background-color: #edf2f7;
    color: #2d3748;
  }

  /* Accordion content styles */
  .accordion-content {
    padding: 1rem;
    background-color: #f7fafc;
    color: #4a5568;
  }

  /* Accordion content hidden by default */
  .accordion-toggle:not(:checked) ~ .accordion-content {
    display: none;
  }

</style>






<div class="p-4">
    <!-- Welcome banner -->
    <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

        <!-- Content -->
        <div class="">
            <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                <div>

                    <table class="min-w-full text-center text-sm font-light">
                        <thead>
                            <tr>
                                <th>PRODUCTS MANAGEMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="whitespace-nowrap font-medium text-left">Active Products</td>
                                <td class="whitespace-nowrap text-left">{{ $this->activeProductsCount }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap font-medium text-left">Inactive Products</td>
                                <td class="whitespace-nowrap text-left">{{ $this->inactiveProductsCount }}</td>
                            </tr>
                        </tbody>
                    </table>


                </div>







            </div>



        </div>




    </div>



    <!-- Dashboard actions -->
    <div class="flex w-full mb-4 gap-2">

        <!-- Left: Avatars -->


        <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-1 flex  items-center " style="height: 70px">


            <div class="inline-flex p-2" >



                    @if (in_array(23, session()->get('permissions')))
                        <button wire:click="menuItemClicked(1) " class="mr-4 flex text-center items-center @if($this->tab_id == 1) very-light-shade @else bg-gray-100  @endif @if($this->tab_id == 1) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            Shares
                        </button>
                    @endif

                    @if (in_array(23, session()->get('permissions')))
                    <button wire:click="menuItemClicked(2)" class="mr-4 flex text-center items-center @if($this->tab_id == 2) very-light-shade @else bg-gray-100  @endif @if($this->tab_id == 2) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        Savings
                    </button>
                @endif

                @if (in_array(23, session()->get('permissions')))
                <button wire:click="menuItemClicked(3)" class="mr-4 flex text-center items-center @if($this->tab_id == 3) very-light-shade @else bg-gray-100  @endif @if($this->tab_id == 3) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>

                    Deposits
                </button>
            @endif

            @if (in_array(23, session()->get('permissions')))
            <button wire:click="menuItemClicked(4)" class="mr-4 flex text-center items-center @if($this->tab_id == 4) very-light-shade @else bg-gray-100  @endif @if($this->tab_id == 4) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>

                Loans
            </button>
            @endif




            </div>



        </div>





        <!-- Right: Actions -->


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





            </div>

        @if($this->tab_id == 1 )
            <livewire:products-management.shares/>
        @endif
        @if($this->tab_id == 2 )
            <livewire:products-management.savings/>
        @endif
        @if($this->tab_id == 3 )
            <livewire:products-management.deposits/>
        @endif
        @if($this->tab_id == 4 )
            <livewire:products-management.loans/>
        @endif

        </div>


    </div>




















</div>

