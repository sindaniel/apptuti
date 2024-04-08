@extends('layouts.page')


@section('content')
<section class="w-full">
       
        <h1 class='text-2xl font-bold mb-5'>Registro</h1>
        {{ Aire::open()->route('register')->post()->enctype('multipart/form-data')}}
            
            <div class='grid xl:grid-cols-2 grid-cols-1 gap-5'>
                {{ Aire::input('name', 'Nombre')->groupClass('mb-0') }}
                {{ Aire::email('email', 'Correo electrónico')->groupClass('mb-0') }}
                
                {{ Aire::select(['Cédula de ciudadanía', 'NIT'], 'city_id', 'Tipo de documento')->value(1)->groupClass('mb-0') }}
                {{ Aire::input('document', 'Documento')->groupClass('mb-0') }}
                
                {{ Aire::select($states, 'state_id', 'Departamento')->value(1)->id('states')->groupClass('mb-0') }}
                {{ Aire::select($cities, 'city_id', 'Ciudad')->value(1)->id('cities')->groupClass('mb-0') }}

                {{ Aire::input('company', 'Nombre de la empresa')->groupClass('mb-0') }}
                {{ Aire::input('address', 'Dirección')->groupClass('mb-0') }}

                {{ Aire::input('area', 'Barrio')->groupClass('mb-0') }}
                {{ Aire::input('phone', 'Teléfono')->groupClass('mb-0') }}

                
                {{ Aire::input('mobile', 'Celular')->groupClass('mb-0') }}

                <div></div>

                {{ Aire::password('password', 'Contraseña')->groupClass('mb-0') }}
                {{ Aire::password('password_confirmation', 'Confirme Contraseña')->groupClass('mb-0') }}


                {{ Aire::file('document_front', 'Cédula (Delantera)')->groupClass('mb-0 col-span-2')->required() }}
                {{ Aire::file('document_back', 'Cédula (Reverso)')->groupClass('mb-0 col-span-2')->required() }}
                {{ Aire::file('company_document', 'Cámara de Comercio')->groupClass('mb-0 col-span-2')->required() }}
                
                {{Aire::radioGroup(['No', 'Si'], 'has_whatsapp', 'Tiene whatsapp')->groupClass('radio-group col-span-2')}}
                {{Aire::radioGroup(['No', 'Si'], 'visit_by_tronex', 'Lo visitan de la compañía Tronex')->groupClass('radio-group col-span-2')}}

                <label class="flex items-center" for="terms">
                    <input type="checkbox" value="1" class="pr-2" name="terms"  id="terms">
                    <a href='{{route('terms')}}' target="_blank" required class="ml-2 flex-1 text-sm font-medium text-blue-500 hover:text-blue-700 ">
                        Autorización de tratamiento de datos
                    </a>
                </label>

                <div></div>



        
                
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        {{ Aire::close() }}
       
</section>
@endsection


@section('scripts')
    
<script>
    $(function(){
        $('#states').change(function(){
            const state = $(this).val()
            
            const url = `{{ route('cities.index') }}?state=${state}`

            axios.get(url).then(function(response){
                console.log(response.data)
                const cities = response.data

                $('#cities').empty()

                cities.forEach(city => {
                    $('#cities').append(`<option value="${city.id}">${city.name}</option>`)
                });

            })

        })
    })
</script>

@endsection