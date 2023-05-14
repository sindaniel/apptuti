@props(['item', 'route', 'title'])


<button 
    type="button" 
    id="deleteProductButton"
    data-drawer-target="drawer-delete-product-default"
    data-drawer-show="drawer-delete-product-default"
    aria-controls="drawer-delete-product-default" 
    data-drawer-placement="right"
    class="flex space-x-2 items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 text-center">
    <x-heroicon-o-trash class="w-4 h-4"/>
    <span>Eliminar producto</span>
</button>





