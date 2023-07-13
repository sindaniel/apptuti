<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head')
</head>



<body class="antialiased">


    <main class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 ">
          <a  class="flex items-center justify-center text-2xl font-semibold lg:mb-2 ">
              <img src="{{ asset('img/tuti.png') }}" class="mr-4 h-20" alt="">
          </a>
          <!-- Card -->
          <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">


            <x-alert />

            @yield('content')
              
          </div>
      </div>
      
      </main>
      


    @yield('scripts')
</body>


</html>
