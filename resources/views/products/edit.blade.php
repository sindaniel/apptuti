@extends('layouts.admin')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')
{{ Aire::open()->route('products.update', $product)->bind($product)->enctype('multipart/form-data')}}
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Actualizar Producto</h1>
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
                
                {{  Aire::range('discount', 'Descuento %')->id('discount')->value(old('discount', 0))->min(0)->max(100)->step(1)->groupClass('col-span-6')}}

                {{  Aire::range('step', 'Steps')->data('sufix', '')->id('step')->value(old('step', 0))->min(0)->max(100)->step(1)->groupClass('col-span-6')->helpText('Salto de cantidad para el precio')}}
              

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

    <div class="col-span-1">


        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Productos relacionados</h3>
            <div class="grid grid-cols-1 gap-3">
                {{-- <input id="tom-select-it" /> --}}

          
                <select class="js-example-basic-single" multiple name="related">
                    {{-- <option selected value="1">Test</option> --}}
                </select>
            
                    
            </div>
        </div>



      
        <x-product-attributes relation='brands' :product="$product" :items="$brands" title="Marcas" />
        <x-product-attributes relation='categories' :product="$product" :items="$categories" title="Categorías"  />
        <x-product-attributes relation='labels' :product="$product" :items="$labels" title="Etiquetas" />
     

        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Impuesto</h3>
            <div class="grid grid-cols-1 gap-3">
                {{Aire::select($taxes, 'tax_id')}}
            </div>
        </div>



        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <p class="flex space-x-2 justify-between items-center">
                {{ Aire::submit('Actualizar')->variant()->submit() }}
                <x-remove-button />  
            </p>
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

    new FroalaEditor('#sort_description', {
        height: 200
    });		
    </script>	
@endsection