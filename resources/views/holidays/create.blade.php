@extends('layouts.admin')


@section('content')
{{ Aire::open()->route('holidays.store')->enctype('multipart/form-data')}}
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Crear festivo</h1>
    </div>

    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>

            <div class="grid grid-cols-6 gap-6">


                {{ Aire::input('name', "Nombre")->groupClass('col-span-6') }}

                {{ Aire::input('date', "Festivo")->readonly()->groupClass('col-span-6')->setAttribute('datepicker', true)->setAttribute('datepicker-autohide', true)->setAttribute('datepicker-format', 'yyyy-mm-dd') }}
                

                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">
                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Crear')->variant()->submit() }}
                        <a href="{{ route('holidays.index') }}">Cancelar</a>
                    </p>
                </div>
            </div>


        </div>
    </div>

   
</div>
{{ Aire::close() }}



@endsection
