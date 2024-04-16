@extends('layouts.admin')


@section('content')

<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">{{$user->name}}</h1>
    </div>


    <div>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
        <h3 class="mb-4 text-xl font-semibold ">Documentos</h3>
        <ul>
            <li>
                <a href="{{asset('storage/'.$user->document_front)}}" target="_blank" class="flex  items-center hover:text-blue-500">
                    <span>Cédula (Delantera)</span>
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 "/> 
                </a>
            </li>
            <li>
                <a href="{{asset('storage/'.$user->document_back)}}" target="_blank" class="flex  items-center hover:text-blue-500">
                    <span>Cédula (Reverso)</span>
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 "/> 
                </a>
            </li>
                <li>
                <a href="{{asset('storage/'.$user->company_document)}}" target="_blank" class="flex  items-center hover:text-blue-500">
                    <span>Cámara de Comercio</span>
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 "/> 
                </a>

            </li>
        </ul>
        </div>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Integración</h3>
            @if(!$user->code)
                {{ Aire::open()->route('users.code', $user)->bind($user)}}
                    {{ Aire::input('code', "Código Customer")->helpText('Código de cliente en el sistema, necesario para poder comprar 901703447    ') }}
                    {{ Aire::submit('Actualizar')->variant()->submit() }}
                {{ Aire::close() }}
            @else
                
                <ul>
                    <li class="">
                        <span>CustRuteroID:</span>
                        <strong>{{$user->code}}</strong>
                    </li>
                    <li class="">
                        <span>Zona:</span>
                        <strong>{{$user->zone}}</strong>
                    </li>
                    <li class="">
                        <span>Día:</span>
                        <strong>{{$user->day}}</strong>
                    </li>
                    <li class="">
                        <span>Ruta:</span>
                        <strong>{{$user->route}}</strong>
                    </li>
                </ul>
            
            @endif
        </div>

        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Contraseña</h3>
          
            {{ Aire::open()->route('users.password', $user)}}
                {{ Aire::password('password', 'Contraseña')->groupClass('mb-5') }}
                {{ Aire::password('password_confirmation', 'Confirme Contraseña')->groupClass('mb-5') }}
                {{ Aire::submit('Actualizar')->variant()->submit() }}
            {{ Aire::close() }}
        
        </div>


    </div>

    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>
            {{ Aire::open()->route('users.update', $user)->bind($user)}}
                <div class="grid grid-cols-2 gap-5">

                    {{ Aire::input('name', 'Nombre')->groupClass('mb-0') }}
                    {{ Aire::email('email', 'Correo electrónico')->groupClass('mb-0') }}
                    
                    {{ Aire::select(['Cédula de ciudadanía', 'NIT'], 'city_id', 'Tipo de documento')->value(1)->groupClass('mb-0') }}
                    {{ Aire::input('document', 'Documento')->groupClass('mb-0') }}
                    
                    {{ Aire::select($states, 'state_id', 'Departamento')->value($user->state_id)->id('states')->groupClass('mb-0') }}
                    {{ Aire::select($cities, 'city_id', 'Ciudad')->value($user->city_id)->id('cities')->groupClass('mb-0') }}

                    {{ Aire::input('company', 'Nombre de la empresa')->groupClass('mb-0') }}
                    {{ Aire::input('address', 'Dirección')->groupClass('mb-0') }}

                    {{ Aire::input('area', 'Barrio')->groupClass('mb-0') }}
                    {{ Aire::input('phone', 'Teléfono')->groupClass('mb-0') }}

                    {{ Aire::input('mobile', 'Celular')->groupClass('mb-0') }}
                    <div></div>

                      
                    <div class="flex space-x-5">
                        {{Aire::radioGroup(['No', 'Si'], 'has_whatsapp', 'Tiene whatsapp')->groupClass('radio-group col-span-2')}}
                        {{Aire::radioGroup(['No', 'Si'], 'visit_by_tronex', 'Lo visitan de la compañía Tronex')->groupClass('radio-group col-span-2')}}

                    </div>
            
                </div>

                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">

                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Actualizar')->variant()->submit() }}
                        <a href="{{ route('users.index') }}">Cancelar</a>
                    </p>               
                </div>
            {{ Aire::close() }}
        </div>
    </div>

   

   
</div>



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