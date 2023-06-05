@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>'Marcas', 
        'description'=> 'Marcas'
        ])
@endsection



@section('content')
    <h1 class="text-2xl font-bold mb-2">Proveedores</h1>
<div class="w-full">
    <div class="grid grid-cols-4 gap-4">
@foreach ($brands as $brand)
    
  
            <div class="flex justify-start border p-2 rounded ">
                <a href="{{ route('brand', $brand->slug) }}">{{ $brand->name }}</a>
            </div>
      

@endforeach
</div>
</div>


@endsection