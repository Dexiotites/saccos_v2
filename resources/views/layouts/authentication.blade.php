<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SaccosManagementSystem') }}</title>

        @livewireStyles


        <link rel="stylesheet" href="{{ asset('build/assets/app-0b078e59.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/flowbite.min.css') }}" type="text/css">


        <style>

            @import url(//fonts.googleapis.com/css?family=Lato:300:400);

            .bodyGradient {
                position:relative;
                text-align:center;
                background: linear-gradient(to bottom left, #2D3A89 0%, rgba(84, 58, 183, 1) 50%, rgba(0, 172, 193, 1) 100%);
                color:white;
            }

            .waves {
                position:relative;
                width: 100%;
                height:15vh;
                margin-bottom:-7px; /*Fix for safari gap*/
                min-height:100px;
                max-height:150px;
            }



            /* Animation */

            .parallax > use {
                animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
            }
            .parallax > use:nth-child(1) {
                animation-delay: -2s;
                animation-duration: 7s;
            }
            .parallax > use:nth-child(2) {
                animation-delay: -3s;
                animation-duration: 10s;
            }
            .parallax > use:nth-child(3) {
                animation-delay: -4s;
                animation-duration: 13s;
            }
            .parallax > use:nth-child(4) {
                animation-delay: -5s;
                animation-duration: 20s;
            }
            @keyframes move-forever {
                0% {
                    transform: translate3d(-90px,0,0);
                }
                100% {
                    transform: translate3d(85px,0,0);
                }
            }
            /*Shrinking for mobile*/
            @media (max-width: 768px) {
                .waves {
                    height:40px;
                    min-height:40px;
                }
                .content {
                    height:30vh;
                }
                h1 {
                    font-size:24px;
                }
            }
        </style>
    </head>
    <body class="font-inter antialiased bg-slate-100 text-slate-600">






        <main class="bg-white">

            <div class="relative flex">

                <!-- Content -->
                <div class="w-full md:w-1/2">

                    <div class="min-h-screen h-full flex flex-col after:flex-1 justify-end">

                        <!-- Header -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                                <!-- Logo -->
                                <a class="block mt-10 flex items-center" href="{{ route('CyberPoint-Pro') }}">
                                    <img class="mt-4" src="{{ asset('images/nbc.png') }}"
                                         height="180" width="180" alt="Authentication decoration" />

                                </a>
                            </div>
                        </div>



                    </div>

                </div>



            </div>








            <div class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center" style="background-colorx: red;">
                <div id="xx" class="max-w-sm px-4 py-8 bg-gray-100 self-center rounded-xl shadow-md shadow-gray-200 " style="margin: 0 auto; width: 400px">
                    <div class="text-center w-full">
                    <span class="mt-4 mb-4 font-bold text-lg text-slate-600 self-center text-center">SACCOS MANAGEMENT SYSTEM</span>
                    </div>
                    <div class="mt-4"> </div>
                    {{ $slot }}
                </div>

                <div class="fixed left-0 right-0 bottom-0">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="parallax">
                            <use xlink:href="#gentle-wave" x="48" y="0" fill="#2D3A89" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(45, 58, 137, 0.7)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(45, 58, 137, 0.5)" />
                            <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(45, 58, 137, 0.3)" />
                            <use xlink:href="#gentle-wave" x="48" y="9" fill="rgba(255, 0, 0, 0.2)" />
                        </g>
                    </svg>
                </div>
            </div>











        </main>




        @livewireScripts
    </body>
</html>
