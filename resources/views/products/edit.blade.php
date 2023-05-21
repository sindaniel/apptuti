@extends('layouts.admin')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')

{{ Aire::open()->route('products.update', $product)->bind($product)->enctype('multipart/form-data')}}
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <div class=" flex justify-between items-center ">
            <h1 class=" font-semibold text-xl text-gray-900 sm:text-2xl">{{ $product->name }}</h1>

            <a class="flex items-center space-x-2 hover:text-blue-500" target="_blank" href="{{ route('product', $product->slug) }}">
                <span>Ver</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                  </svg>  
            </a>
        </div>
    </div>

  

    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>

            <div class="grid grid-cols-6 gap-6">


                {{ Aire::input('name', "Nombre")->groupClass('col-span-3') }}
                {{ Aire::input('slug', "Slug")->groupClass('col-span-3') }}
                 {{ Aire::input('sku', "SKU")->groupClass('col-span-3') }}

                {{ Aire::input('price', "Precio")->groupClass('col-span-3') }}
                {{ Aire::input('delivery_days', "Tiempo de entrega")->helpText('Días')->groupClass('col-span-3') }}

                {{ Aire::input('quantity_min', "Cantidad mínima")->groupClass('col-span-3') }}
                {{ Aire::input('quantity_max', "Cantidad maxima")->helpText('Si esta en cero no hay límite')->groupClass('col-span-3') }}

                {{Aire::select($variations, 'variation_id', "Variación")->groupClass('col-span-3')}}
                
                {{  Aire::range('discount', 'Descuento %')->id('discount')->value(old('discount', $product->discount))->min(0)->max(100)->step(1)->groupClass('col-span-6')}}

                {{  Aire::range('step', 'Steps')->data('sufix', '')->id('step')->value(old('step', $product->step))->min(0)->max(100)->step(1)->groupClass('col-span-6')->helpText('Salto de cantidad para el precio')}}
                
                

                {{ Aire::textarea('description', "Descripción")->id('description')->rows(5)->groupClass('col-span-6') }}
                {{ Aire::textarea('short_description', "Descripción corta")->id('sort_description')->rows(5)->groupClass('col-span-6') }}



                <div>
                    {{ Aire::hidden('active')->value(0)}}
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input @checked($product->active) type="checkbox" name='active' value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all0 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 ">Activo</span>
                    </label>
                </div>

              
            </div>


        </div>
    </div>

    <div class="col-span-1">

{{--        
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Marca</h3>
            <div id='app'></div>
          
        </div> --}}


        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Marca</h3>
            <div class="grid grid-cols-1 gap-3">
                {{Aire::select($brands, 'brand_id')}}
            </div>
        </div>

                                                    
        <x-product-categories relation='categories' :product="$product" :items="$categories" title="Categorías"  />
        <x-product-attributes relation='labels' :product="$product" :items="$labels" title="Etiquetas" />
     

        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Impuesto</h3>
            <div class="grid grid-cols-1 gap-3">
                {{Aire::select($taxes, 'tax_id')}}
            </div>
        </div>




        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Productos relacionados</h3>
            <div class="grid grid-cols-1 gap-3">
                


                <select class="js-example-basic-single" multiple name="related">
                    
                </select>
            
                    
            </div>
        </div>



        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">
                <p class="flex space-x-2 items-center">
                    {{ Aire::submit('Actualizar')->variant()->submit() }}
                    <a href="{{ route('products.index') }}">Cancelar</a>
                </p>
                <x-remove-button />     
            </div>
        </div>


        


    </div>

   
</div>



@if( $product->variation)
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Variaciones - {{ $product->variation->name }}</h1>
    </div>

    <div class="col-span-2">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
         
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3"></th>
                            <th scope="col" class="px-4 py-3">Nombre</th>
                            <th scope="col" class="px-4 py-3 ">Precio</th>
                            <th scope="col" class="px-4 py-3">Imagen</th>
                  
                            <th scope="col" class="px-4 py-3">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->items as $item)
                        <tr class="border-b">
                            <td class="w-4 px-4 py-3 ">
                                <div class="flex items-center">
                                    {{ Aire::hidden("variations[".$item->pivot->variation_item_id."][enabled]")->value(0)}}
                                    <input
                                        @checked($item->pivot->enabled) name='{{ "variations[".$item->pivot->variation_item_id."][enabled]" }}' type="checkbox" value='1'  class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="px-4 py-3 font-medium text-gray-900">
                                {{ $item->name }}   
                            </td>
                            <td class="px-4 py-3 max-w-[5rem]">
                                {{ Aire::input("variations[".$item->pivot->variation_item_id."][price]")
                                    ->value(old("variations[".$item->pivot->variation_item_id."][price]", $item->pivot->price))
                                    ->groupClass('mb-0')
                                }}
                            </td>

                          
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        
        </div>
    </div> 
</div>
@endif



<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <div class="col-span-2 justify-between  items-center space-x-2 flex">
                <p class="flex space-x-2 items-center">
                    {{ Aire::submit('Actualizar')->variant()->submit() }}
                    <a href="{{ route('categories.index') }}">Cancelar</a>
                </p>
                <x-remove-button />  
               
            </div>
        </div>
    </div> 
</div>





{{ Aire::close() }}




<x-remove-drawer title="Producto" route='products.destroy' :item='$product' />


@endsection



@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

$(document).ready(function() {
        

        $('.js-example-basic-single').select2({
         
            ajax: {
                url: '{{ route('products.search') }}',
                data: function (params) {
                    var query = {
                        q: params.term,
                        product_id: {{ $product->id }}
                    } 
                    return query;
                },
                processResults: function(data) {
                    return {results: data};
                }
            },
        })
        
        .on('select2:unselecting', function (e) {
            
            axios.post('{{ route('products.removeRelated', $product) }}', {
                related_id: e.params.args.data.id
            })
        })
        .on('select2:select', function (e) {
            if(!e.params.data.quiet){
                axios.post('{{ route('products.addRelated', $product) }}', {
                    related_id: e.params.data.id
                })
            }

        
        })

        @foreach ($product->related as $related)
            $(".js-example-basic-single").select2("trigger", "select", {data: {quiet:true, id: {{ $related->id }}, text: '{{ $related->name }}' }, });    
        @endforeach
        
      

   

});


    // var config = {
    //     valueField: 'url',
	// 	labelField: 'name',
	// 	searchField: 'name',
	// 	load: function(query, callback) {
    //         console.log(query)
    //         //var url = 'https://api.github.com/search/repositories?q=' + encodeURIComponent(query);
    //         var url = '{{ route('products.search') }}';
    //         fetch(url)
    //             .then(response => response.json())
    //             .then(json => {
    //                 callback(json);
    //             }).catch(()=>{
    //                 callback();
    //             });

    //     },

    //     render: {
    //      option: function(item, escape) {
    //         return `<div class="py-2 d-flex">
    //                  <div class="mb-1">
    //                     <span class="h5">
    //                        ${ escape(item.name) }
    //                     </span>
    //                  </div>
    //                  <div class="ms-auto">${ escape(item.type.join(', ')) }</div>
    //               </div>`;
    //      }
    //   },
        
    //     // options: [
    //     //     { value: "opt1", text: "Option 1" },
    //     //     { value: "opt2", text: "Option 2" },
    //     // ],
    //     // valueField: 'id',
    //     // labelField: 'name',
    //     // searchField: ['name']
    // };
    // new TomSelect('#tom-select-it',config);
    </script>


    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  	
    <script>
    new FroalaEditor('#description', {
        height: 200
    });		

    // new FroalaEditor('#sort_description', {
    //     height: 200
    // });		
    </script>	
@endsection