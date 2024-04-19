@extends('layouts.page')



@section('content')
<div class="xl:px-96 px-0">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        Ingreso
    </h2>
    <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
        @csrf

        {{ Aire::input('email', 'Email') }}
        {{ Aire::password('password', 'Contraseña') }}

        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 ">
            </div>
            <div class="ml-2 text-sm">
            <label for="remember" class="font-medium text-gray-900 ">Recordarme</label>
            </div>
            <a href="{{ route('password.request') }}" class="ml-auto text-sm text-blue-700 hover:underline ">Olvido su contraseña?</a>
        </div>

        
        {{ Aire::submit('Ingresar')->addClass('font-bold')->variant()->submit() }}
        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login to your account</button>
    
    </form>
</div>
@endsection
