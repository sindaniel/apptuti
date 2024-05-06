@extends('layouts.page')



@section('head')
    @include('elements.seo', ['title'=>'Registro' ])
@endsection

@section('content')
<section class="w-full xl:py-14 py-10 xl:px-96 px-0">
       
        <h1 class='text-2xl font-bold mb-5'>Registro</h1>
        {{ Aire::open()->route('complete')}}
            
            <div class='grid xl:grid-cols-1 grid-cols-1 gap-5'>
                {{ Aire::input('document', 'Documento')->helpText('Nit sin dígito de verificación')->groupClass('mb-0') }}    
            </div>

            <div class="flex items-center  mt-4">
                

                <x-primary-button >
                    Registrarme
                </x-primary-button>
            </div>
        {{ Aire::close() }}
       
</section>
@endsection


@section('scripts')
    
<script>
    $(function(){
        $('#states').change(function(){
            const state = $(this).val()
            
            const url = `{{ route('cities.index') }}?state=${state}`

            axios.get(url).then(function(response){
                console.log(response.data)
                const cities = response.data

                $('#cities').empty()

                cities.forEach(city => {
                    $('#cities').append(`<option value="${city.id}">${city.name}</option>`)
                });

            })

        })
    })
</script>

@endsection