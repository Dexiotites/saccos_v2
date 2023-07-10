<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SaccosManagementSystem') }}</title>

        <!-- Styles -->
        @livewireStyles


        <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('build/assets/app-0b078e59.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/flowbite.min.css') }}" type="text/css">




        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>




    </head>
    <body
        class="font-inter antialiased bg-slate-100 text-slate-600"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"
    >


        <script>
            if (localStorage.getItem('sidebar-expanded') == 'true') {
                document.querySelector('body').classList.add('sidebar-expanded');
            } else {
                document.querySelector('body').classList.remove('sidebar-expanded');
            }
        </script>

        <!-- Page wrapper -->
        <div class="flex h-screen overflow-hidden">

            <livewire:sidebar.sidebar/>

            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if($attributes['background']){{ $attributes['background'] }}@endif" x-ref="contentarea">

                <x-app.header />

                <main>
                    {{ $slot }}
                </main>

            </div>

        </div>

        @livewireScripts
        <script src="{{ asset('build/assets/app-7b02b2b6.js') }}"></script>
        <script src="{{ asset('assets/js/tw-elements.umd.min.js') }}"></script>
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
        <script>
            $('#reloadAll').click(function() {
                location.reload();
            });
        </script>





    </body>
</html>
