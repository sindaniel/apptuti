<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>




@if($attributes->get('type') == 'range')
    <div class="grid grid-cols-12">
        <div class="col-span-11">
            <input {{ $attributes->except('class') }} class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
        </div>
        <div class="col-span-1 flex justify-center">
            <output id="{{ $attributes->get('id') }}_bubble">{{ $attributes->get('value') }}</output>
        </div>
    </div>

    
    
    <script defer>
        var range{{ $attributes->get('id') }} = document.getElementById('{{ $attributes->get('id') }}')
        var bubble{{ $attributes->get('id') }} = document.getElementById('{{ $attributes->get('id') }}_bubble')

      //  console.log(range{{ $attributes->get('id') }}.dataset.sufix)
        var sufix{{ $attributes->get('id') }} =  range{{ $attributes->get('id') }}.dataset.sufix === undefined ? '%' : range{{ $attributes->get('id') }}.dataset.sufix

        range{{ $attributes->get('id') }}.addEventListener("input", () => {
            
            const val = range{{ $attributes->get('id') }}.value;
            const min = range{{ $attributes->get('id') }}.min ? range{{ $attributes->get('id') }}.min : 0;
            const max = range{{ $attributes->get('id') }}.max ? range{{ $attributes->get('id') }}.max : 100;
            const newVal = Number(((val - min) * 100) / (max - min));
       
            bubble{{ $attributes->get('id') }}.innerHTML = `${val} ${sufix{{ $attributes->get('id') }}}`;

          
         

        });
      
    </script>
    
@elseif($attributes->get('type') == 'file')

<input {{ $attributes->except('class') }} class='block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none' />

@else
<div>
    <input {{ $attributes }} />
   
</div>
    
@endif
