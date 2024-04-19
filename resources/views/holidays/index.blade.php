@extends('layouts.admin')


@section('content')



<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl ">Festivos</h1>
        </div>
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 ">
            <form id='form' action="" class='flex space-x-2'>
                {{ Aire::select([0=>'Todos', 1=>'Festivo', 2=>'Sábado'], 'type_id')->id("type_id")->value(request()->type_id, 0 ) }}
            </form>
            <a href="{{ route('holidays.create') }}"
                class="text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 ">
                Nueva fecha
            </a>
        </div>
    </div>
</div>
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed ">
                    <thead class="bg-gray-100">
                        <tr>
                           
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Nombre
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Fecha
                            </th>
                          
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase "></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @foreach ($holidays as $holiday)
                        <tr class="hover:bg-gray-100">
                            
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                <a class="flex flex-col text-gray-900  hover:text-blue-500" href="{{ route('holidays.edit', $holiday) }}">
                                    <span class="text-base font-semibold ">
                                        {{ $holiday->type }}
                                    </span>
                                </a>
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                <div class="flex flex-col">
                                    <span>{{ $holiday->date->toDateString() }}</span>
                                    <small class='text-gray-500'> {{ $holiday->day }}</small>
                                </div>
                            </td>
                          

                            <td class="p-4 space-x-2 whitespace-nowrap text-end">

                                {{ Aire::open()->route('holidays.destroy', $holiday)}}
                                <button class="inline-flex space-x-2 items-center bg-white hover:bg-red-700 border border-red-700 text-red-700 bg-white-700 hover:text-white focus:ring-0 focus:ring-red-300 font-medium rounded text-xs px-2 py-1.5 text-center" onclick="return confirm('Esta seguro?');">Eliminar</button>
                                {{ Aire::close() }}
                                
                              
                            </td>
                        </tr>

                        @endforeach
            


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


{{ $holidays->links() }} 











@endsection



@section('scripts')
    
<script src="{{ asset('js/jquery.js') }}" ></script>
<script>

    $(document).ready(function(){
        $('#type_id').on('change', function(){
            $('#form').submit();
        })
    })

</script>


@endsection
