@extends('layouts.page')


@section('content')
<section class="container mx-auto max-w-xl">
       
        <h1 class='text-2xl font-bold mb-5'>Completar registro</h1>
        {{ Aire::open()->route('register')->post()->enctype('multipart/form-data')}}
            
            <div class='grid grid-cols-1 gap-5'>
                {{ Aire::hidden('document')->value(request()->document)}}
                {{ Aire::input('email', 'Email')->groupClass('mb-0') }}
                {{ Aire::input('phone', 'Celular')->groupClass('mb-0') }}

                {{ Aire::password('password', 'Contraseña')->groupClass('mb-0') }}
                {{ Aire::password('password_confirmation', 'Confirme Contraseña')->groupClass('mb-0') }}
             



        
                
            </div>

            <div class="flex items-center  mt-4">
                

                <x-primary-button >
                    Registrarme
                </x-primary-button>
            </div>
        {{ Aire::close() }}
       
</section>
@endsection




@section('scripts')
    
<script>
   const submitButton = document.querySelector('button[type="submit"]');

    submitButton.addEventListener('click', function() {
        submitButton.disabled = true;
        submitButton.innerHTML = 'Registrando...';

        //submit the form
        submitButton.closest('form').submit();
    });
</script>

@endsection.
3
