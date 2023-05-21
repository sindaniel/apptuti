@extends('layouts.admin')


@section('content')

<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Agregar elementos</h1>
    </div>

    <div class="col-span-2">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            {{ Aire::open()->route('variations.items.store', $variation)}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                   
                        <div class="relative w-full">
                            {{ Aire::input('item_name')->placeholder('Nuevo item') }}
                           
                        </div>
                       
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="submit" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Agregar item
                    </button>
                  
                </div>
            </div>
            {{ Aire::close() }}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nombre</th>
                  
                            <th scope="col" class="px-4 py-3">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($variation->items as $item)
                        <tr class="border-b">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a data-value='{{ $item->name }}' href="{{ route('variations.items.update', [$variation,$item]) }}" class="editItem hover:text-blue-500">
                                    {{ $item->name }}
                                </a>
                            </th>
                          
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="dropdown{{ $item->id }}-button" data-dropdown-toggle="dropdown{{ $item->id }}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="dropdown{{ $item->id }}-dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown{{ $item->id }}-button">
                                        <li>
                                            <a data-value='{{ $item->name }}'  href="{{ route('variations.items.update', [$variation,$item]) }}" class="block py-2 px-4 hover:bg-gray-100 editItem">Editar</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Eliminar</a>
                                        </li>
                                    </ul>
                                  
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        
        </div>
    </div>

    {{ Aire::open()->addClass('col-span-1')->route('variations.update', $variation)->bind($variation)->enctype('multipart/form-data')}}
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>

            <div class="grid grid-cols-6 gap-6">

                {{ Aire::input('name', "Nombre")->groupClass('col-span-6') }}
                
                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">

                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Actualizar')->variant()->submit() }}
                        <a href="{{ route('variations.index') }}">Cancelar</a>
                    </p>  

                    <x-remove-button />  
                    
                </div>
            </div>

        </div>
    {{ Aire::close() }}


   
</div>

<div id="drawer-edit-item"  
class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white"
tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true" >
    <h5 id="drawer-js-label"  class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 "><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>Actualizar</h5>
    <button id="closeDrawer" type="button" aria-controls="drawer-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center" >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          
       <span class="sr-only">Close menu</span>
    </button>
    <form action="" method="POST" id='editVariationItemForm' class="mb-6">
        @csrf
        @method('PUT')
        <div class="mb-6">
           <label for="title"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
           <input type="text" id='editVariationItem' name='name' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  required>
        </div>
       
        
        <button type="submit" class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2   focus:outline-none "> Actualizar</button>
     </form>
    </div>
 </div>




<x-remove-drawer title="Variación" route='variations.destroy' :item='$variation' />


@endsection


@section('scripts')
    

 <script>
 

    const $targetEl = document.getElementById('drawer-edit-item');

    const drawer = new Drawer($targetEl, { placement: 'right'});

    $('.editItem').click(function(e){
        e.preventDefault();
        const urlForm = $(this).attr('href')
        const value = $(this).data('value')
        $('#editVariationItemForm').attr('action', urlForm)
        $('#editVariationItem').val(value)
        drawer.show();
    })

    $('#closeDrawer').click(function(e){
        drawer.hide();
    })
    
 </script>

@endsection