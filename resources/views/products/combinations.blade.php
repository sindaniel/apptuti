<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 " id='combined'>
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Productos Combinados    </h1>
    </div>

   
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            
            {{ Aire::open()->route('products.combinations.store', $product)}}
            <div class="flex justify-between">
                {{ Aire::select($products, 'product_id')->setAttribute('onchange',"this.form.submit()") }}
            </div>
            {{ Aire::close() }}

            {{-- ese 1 es para usar el resource  --}}
            {{ Aire::open()->route('products.combinations.update', [$product, 1])}}
            <div class="relative overflow-x-auto my-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Variación
                            </th>
                            <th scope="col" class="px-6 py-3">
                                
                            </th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->combinations as $combination)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $combination->name }}
                                    
                                </th>
                                
                                <td class="px-6 py-4">
                                    {{ Aire::input('combined['.$combination->id.'][price]')
                                    ->groupClass('col-span-3 w-48')->value($combination->pivot->price)
                                    }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($combination->items->count())
                                        {{Aire::select($combination->items->pluck('price_label', 'id'), 'combined['.$combination->id.'][variation_item_id]')->value($combination->pivot->variation_item_id)->groupClass('w-48')}}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('products.remove_combination', [$product, $combination->id]) }}" class='text-red-500  bottom-1 hover:opacity-50 shadow'>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                          </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div> 
            {{ Aire::submit('Actualizar')->variant()->submit() }}
            {{ Aire::close() }}

       
        </div>
    </div>
   
</div>