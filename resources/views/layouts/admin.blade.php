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

    @include('elements.admin.header')
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">

        @include('elements.admin.aside')

        <div id="main-content" class="relative h-screen w-full overflow-y-auto  lg:ml-64">
            <main class="pt-[4.5rem]">
               
                <x-alert />
               
         
                @yield('content')
                     
            </main>
            @include('elements.admin.footer')

        </div>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
    @yield('scripts')
</body>


</html>
