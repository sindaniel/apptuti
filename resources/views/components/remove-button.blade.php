@props(['item', 'route', 'title'])


<button 
    type="button" 
    id="deleteProductButton"
    data-drawer-target="drawer-delete-product-default"
    data-drawer-show="drawer-delete-product-default"
    aria-controls="drawer-delete-product-default" 
    data-drawer-placement="right"
    class="flex space-x-2 items-center bg-white hover:bg-red-700 border border-red-700 text-red-700 bg-white-700 hover:text-white focus:ring-0 focus:ring-red-300 font-medium rounded text-sm px-3 py-2.5 text-center">
    <x-heroicon-o-trash class="w-4 h-4"/>
    <span>Eliminar</span>
</button>






