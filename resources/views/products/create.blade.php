@extends('layouts.admin')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
@endsection


@section('content')
{{ Aire::open()->route('products.store')->enctype('multipart/form-data')}}
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Crear Producto</h1>
    </div>

    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>

            <div class="grid grid-cols-6 gap-6">


                {{ Aire::input('name', "Nombre")->groupClass('col-span-3') }}
                 {{ Aire::input('sku', "SKU")->groupClass('col-span-3') }}

                {{ Aire::input('price', "Precio")->groupClass('col-span-3') }}
                {{ Aire::input('delivery_days', "Tiempo de entrega")->helpText('Días')->groupClass('col-span-3') }}

                {{ Aire::input('quantity_min', "Cantidad mínima")->groupClass('col-span-3') }}
                {{ Aire::input('quantity_max', "Cantidad maxima")->helpText('Si esta en cero no hay límite')->groupClass('col-span-3') }}
                
                {{  Aire::range('discount', 'Descuento %')->id('discount')->value(old('discount', 0))->min(0)->max(100)->step(1)->groupClass('col-span-6')}}

                {{  Aire::range('step', 'Steps')->data('sufix', '')->id('step')->value(old('step', 0))->min(0)->max(100)->step(1)->groupClass('col-span-6')->helpText('Salto de cantidad para el precio')}}
              

                {{ Aire::textarea('description', "Descripción")->id('description')->rows(5)->groupClass('col-span-6') }}
                {{ Aire::textarea('short_description', "Descripción corta")->id('sort_description')->rows(5)->groupClass('col-span-6') }}



                
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name='active' value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all0 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 ">Activo</span>
                </label>
  
            

                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">
                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Crear')->variant()->submit() }}
                        <a href="{{ route('products.index') }}">Cancelar</a>
                    </p>
                </div>
            </div>


        </div>
    </div>

    <div class="col-span-1">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Marcas</h3>
            <div class="grid grid-cols-2 gap-3">
                @foreach ($brands as $brand) 
                    <div class="flex items-center cursor-pointer">
                        <input id="brand{{ $brand->id }}" name="brands[]" type="checkbox" value="{{ $brand->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-0 ">
                        <label for="brand{{ $brand->id }}" class="ml-2 text-sm font-medium text-gray-900 ">{{ $brand->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Impuesto</h3>
            <div class="grid grid-cols-1 gap-3">
                {{Aire::select($taxes, 'tax_id')}}
            </div>
        </div>

    </div>

   
</div>
{{ Aire::close() }}



@endsection



@section('scripts')
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