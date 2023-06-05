@props(['item', 'route', 'title'])

<div id="drawer-delete-product-default"
    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white"
    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label"
        class="inline-flex items-center text-sm font-bold text-gray-500 uppercase ">Eliminar {{ $title }}
    </h5>
    <button type="button" data-drawer-dismiss="drawer-delete-product-default"
        aria-controls="drawer-delete-product-default"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <svg class="w-10 h-10 mt-8 mb-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="mb-6 text-lg text-gray-500 ">¿Está seguro de que desea eliminar este {{ $title }}?</h3>
  
    <div class="flex">
        {{ Aire::open()->route($route, $item) }}
            {{ Aire::button('Si, estoy seguro')->variant()->red() }}
        {{ Aire::close() }}


        <button href="#"
            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center "
            type="button" data-drawer-dismiss="drawer-delete-product-default"
        aria-controls="drawer-delete-product-default">
            No, cancelar
        </button>

    </div>
    
</div>