<div>

    <div>
        <!-- Sidebar backdrop (mobile only) -->
        <div
            class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200 "
            :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
            aria-hidden="true"
            x-cloak

        ></div>

        <!-- Sidebar -->
        <div
            id="sidebar"
            class=" flex flex-col absolute z-40 left-0 top-0 lg:static
            lg:left-auto lg:top-auto lg:translate-x-0 h-screen
            overflow-y-scroll lg:overflow-y-auto no-scrollbar
            w-74 lg:w-30 lg:sidebar-expanded:!w-74 2xl:!w-74
            shrink-0 bg-white p-4 transition-all duration-200 ease-in-out border-r-2 border-gray-100"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
            @click.outside="sidebarOpen = false"
            @keydown.escape.window="sidebarOpen = false"
            x-cloak="lg"
        >

            <!-- Sidebar header -->
            <div class="flex justify-between mb-4 pr-3 sm:px-2 ">



                <!-- Close button -->
                <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                    </svg>
                </button>

                     <!-- Logo -->
                <a class="block  flex items-center -mt-4" href="{{ route('CyberPoint-Pro') }}">
                    <img class="" src="{{ asset('images/nbc.png') }}"
                         height="10" width="140" alt="logo" /> <!-- Set height to desired size, e.g. 30 pixels -->
                </a>


            </div>

            <!-- Links -->
            <div class="space-y-8">
                <!-- Pages group -->
                <div>
                    <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">

                        <span class="lg:hidden lg:sidebar-expanded:block 2xl:block"></span>
                    </h3>
                    <ul class="mt-3">



                        <!-- Dashboard -->
                        <li id="reloadAll" class="px-3 py-2 rounded-lg mb-2 @if($this->tab_id == 0) very-light-shade @else  @endif cursor-pointer "  onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#333333';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                                <div wire:click="menuItemClicked(0)" wire:loading.attr="disabled"  class="flex items-center justify-between block text-slate-200 hover:text-white truncate transition duration-150">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="menuItemClicked(0)">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6 spin">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                            </svg>


                                        </div>
                                        <div wire:loading.remove wire:target="menuItemClicked(0)">
                                        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current @if($this->tab_id == 0) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }}@endif" d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                            <path class="fill-current @if($this->tab_id == 0){{ 'text-indigo-600' }}@else{{ 'text-slate-600' }}@endif" d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                            <path class="fill-current @if($this->tab_id == 0){{ 'text-indigo-200' }}@else{{ 'text-slate-400' }}@endif" d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                        </svg>
                                        </div>
                                        <span class="text-sm @if($this->tab_id == 0) text-dark-shade font-bold  @else  text-gray-400 font-semibold   @endif  ml-3 ">Dashboard</span>
                                    </div>
                                    <!-- Icon -->
                                    <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">

                                    </div>
                                </div>


                        </li>

                        @foreach($this->menuItems as $item)

                                @if($item == '10' || $item == '11' || $item == '13')
                                @continue
                                @endif

                            <li  class="px-3 py-2 rounded-lg mb-4 last:mb-0 @if($this->tab_id == $item) very-light-shade @else  @endif cursor-pointer " onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#333333';" onmouseout="this.style.backgroundColor=''; this.style.color='';" >

                                <div wire:click="menuItemClicked({{$item}})" wire:loading.attr="disabled" class="flex items-center justify-between text-slate-200 hover:text-white truncate transition duration-150">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="menuItemClicked({{$item}})">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6 spin">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                            </svg>


                                        </div>

                                        <div wire:loading.remove wire:target="menuItemClicked({{$item}})">
                                        @if($item == "1" )

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path class="fill-current @if($this->tab_id == $item) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>

                                        @endif

                                        @if($item == "2" )


                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>

                                        @endif

                                        @if($item == "3" )


                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 stroke-gray-400" width="24" height="24" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  d="m20.749 12 1.104-1.908a1 1 0 0 0-.365-1.366l-1.91-1.104v-2.2a1 1 0 0 0-1-1h-2.199l-1.103-1.909a1.008 1.008 0 0 0-.607-.466.993.993 0 0 0-.759.1L12 3.251l-1.91-1.105a1 1 0 0 0-1.366.366L7.62 4.422H5.421a1 1 0 0 0-1 1v2.199l-1.91 1.104a.998.998 0 0 0-.365 1.367L3.25 12l-1.104 1.908a1.004 1.004 0 0 0 .364 1.367l1.91 1.104v2.199a1 1 0 0 0 1 1h2.2l1.104 1.91a1.01 1.01 0 0 0 .866.5c.174 0 .347-.046.501-.135l1.908-1.104 1.91 1.104a1.001 1.001 0 0 0 1.366-.365l1.103-1.91h2.199a1 1 0 0 0 1-1v-2.199l1.91-1.104a1 1 0 0 0 .365-1.367L20.749 12zM9.499 6.99a1.5 1.5 0 1 1-.001 3.001 1.5 1.5 0 0 1 .001-3.001zm.3 9.6-1.6-1.199 6-8 1.6 1.199-6 8zm4.7.4a1.5 1.5 0 1 1 .001-3.001 1.5 1.5 0 0 1-.001 3.001z"></path>
                                                </svg>

                                            @endif
                                        @if($item == "4" )


                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                                </svg>


                                            @endif

                                        @if($item == "5" )


                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  stroke-linecap="round" stroke-linejoin="round" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3" />
                                                </svg>


                                            @endif

                                        @if($item == "6" )

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>

                                            @endif
                                        @if($item == "7" )

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2  @if( $tab_id == 8 ) stroke-blue-400 font-semibold @else stroke-gray-400 @endif " fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="24" height="24">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  d="M19 2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.806 5 19s.55-.988 1.012-1H21V4c0-1.103-.897-2-2-2zm0 14H5V5c0-.806.55-.988 1-1h13v12z"></path>
                                                </svg>
                                        @endif

                                        @if($item == "8" )


                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>


                                            @endif

                                             @if($item == "9" )


                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 @if( $tab_id == 10 ) stroke-blue-400 @else stroke-gray-400 @endif " fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 11a3 3 0 0 0-3 3H7a3 3 0 0 0-3-3V9a3 3 0 0 0 3-3h10a3 3 0 0 0 3 3v6z">

                                                    </path>
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"   d="M12 8c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">

                                                    </path>
                                                </svg>


                                            @endif

                                             @if($item == "10" )


                                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline-flex items-center justify-center h-6 w-6 text-lg @if( $tab_id == 15 ) text-blue-400 font-semibold @else text-gray-400 @endif ">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>



                                            @endif

                                             @if($item == "11" )


                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline-flex items-center justify-center h-6 w-6 text-lg @if( $tab_id == 15 ) text-blue-400 font-semibold @else text-gray-400 @endif ">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                </svg>



                                            @endif

                                             @if($item == "12" )


                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2 @if( $tab_id == 11 ) stroke-blue-400 @else stroke-gray-400 @endif ">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"  stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                                </svg>



                                            @endif

                                             @if($item == "13" )



                                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline-flex items-center justify-center h-6 w-6 text-lg @if( $tab_id == 14 ) text-blue-400 font-semibold @else text-gray-400 @endif ">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>


                                            @endif
                                             @if($item == "14" )



                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 @if( $tab_id == 12 ) stroke-blue-400 @else stroke-gray-400 @endif " fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"   d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h7v14H4zm9 0V5h7l.001 14H13z">

                                                    </path>
                                                    <path d="M15 7h3v2h-3zm0 4h3v2h-3z"></path>
                                                </svg>


                                            @endif
                                             @if($item == "15" )



                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2 @if( $tab_id == 13 ) stroke-blue-400 @else stroke-gray-400 @endif ">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>


                                            @endif
                                        </div>

                                        <span class="text-sm @if($this->tab_id == $item) text-blue-600 font-bold  @else  text-gray-400 font-semibold  @endif ml-3 ">{{ \App\Models\menus::where('ID', $item)->first()->menu_name }}</span>
                                    </div>
                                    <!-- Icon -->
                                    <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">

                                    </div>
                                </div>


                            </li>

                       @endforeach



                    </ul>
                </div>

            </div>

            <!-- Expand / collapse button -->
            <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
                <div class="px-3 py-2">
                    <button @click="sidebarExpanded = !sidebarExpanded">
                        <span class="sr-only">Expand / collapse sidebar</span>
                        <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                            <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                            <path class="text-slate-600" d="M3 23H1V1h2z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>
