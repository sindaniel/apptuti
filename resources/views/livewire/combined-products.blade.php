<div>

    <div class="grid grid-cols-1  xl:grid-cols-3 xl:gap-4 ">
        <div class="mb-4 col-span-full  grid grid-cols-2">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Productos combinados</h1>

            <select wire:change.debounce.200ms="add" wire:model='selectedProduct' name="" id="" class='shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm  focus:ring-primary-500 focus:border-primary-500 block w-full  p-2 text-base rounded-sm'>
                <option value="">Seleccione</option>
                @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
            </select>
        
        </div>

        <div class="col-span-3">
            <div class="bg-white  relative overflow-hidden">
            
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                             
                                <th scope="col" class="px-4 py-3">Nombre</th>
                                <th scope="col" class="px-4 py-3 ">Variación</th>
                                <th scope="col" class="px-4 py-3 ">Precio</th>
                            
                                <th scope="col" class="px-4 py-3">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($combinations as $key => $product)
                            <tr class="border-b">
                                <td class="w-4 px-4 py-3 whitespace-nowrap">
                                    {{$product->name}} {{ $product->id }}
                                </td>
                                <td class="w-4 px-4 py-3">
                                    @if($product->items->count())
                                        {{Aire::select($product->items->pluck('price_label', 'id'))
                                         ->setAttribute('wire:model', 'combinations.'.$key.'.variation_item_id')
                                        ->setAttribute('wire:key', 'combinations.'.$key.'.variation_item_id')
                                       // ->setAttribute('wire:value', 'combined.attribute.'.$product->id)  
                                       
                                        ->groupClass('w-48')}}
                                    @endif
                                </td>
                                <td class="w-4 px-4 py-3">
                                    {{ Aire::input('trtrtrt')
                                        ->groupClass('col-span-3 w-48')
                                         ->setAttribute('wire:change', 'u')
                                        // ->setAttribute('wire:change.debounce.200m', 'combinations.'.$key.'.pivot.price')
                                        ->value($product->pivot->price)
                                     }}
                                 
                             
                                </td>
                             
                           
                            </tr>
                        @endforeach
                            
                        </tbody>
                    </table>

                    <button type="button" wire:click='update'>Actualizar</button>
                </div>
            
            </div>
        </div> 
    </div>
    
   

   

  

</div>