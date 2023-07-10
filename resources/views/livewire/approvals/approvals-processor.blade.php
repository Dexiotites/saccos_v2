<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200" style="height: 116px;">

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                    <div>
                        APPROVALS MANAGEMENT
                        <div class="flex items-center text-sm font-semibold text-red-600 spacing-sm">
                            Awaiting approval - {{$this->pendingApprovals}} requests
                        </div>


                    </div>

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








                <div class="bg-white p-2">

                    <div class="bg-gray-100 rounded rounded-lg shadow-sm  p-2">

                        <livewire:approvals.approvals-table/>

                    </div>
                </div>










            </div>



        </div>


    </div>

</div>




