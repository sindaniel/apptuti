@extends('layouts.admin')


@section('content')
{{ Aire::open()->route('labels.update', $label)->bind($label)->enctype('multipart/form-data')}}
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Editar etiqueta</h1>
    </div>

    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>

            <div class="grid grid-cols-6 gap-6">

                {{ Aire::input('name', "Nombre")->groupClass('col-span-3') }}
                {{ Aire::input('slug', "Slug")->groupClass('col-span-3') }}
                {{ Aire::textarea('description', "Descripción")->rows(5)->groupClass('col-span-6') }}

                <div>
                    {{ Aire::hidden('active')->value(0)}}
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input @checked($label->active) type="checkbox" name='active' value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all0 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 ">Activo</span>
                    </label>

                </div>
                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">

                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Actualizar')->variant()->submit() }}
                        <a href="{{ route('labels.index') }}">Cancelar</a>
                    </p>


                    
                    <x-remove-button />  
                   
                </div>
            </div>

        </div>
    </div>

    <div class="col-span-full xl:col-auto">
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Imagenes</h3>

            <div class="mb-3 text-center">
                <img src="{{ asset('storage/'.$label->image) }}" alt="" class="w-48 inline-block">
            </div>
            {{ Aire::file('image_file', 'Imagen') }}

          
        </div>
    </div>

   
</div>
{{ Aire::close() }}


<x-remove-drawer title="Etiqueta" route='labels.destroy' :item='$label' />



@endsection
