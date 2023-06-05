<div class="col-span-6">
    <div class="grid grid-cols-6 gap-6">
        {{ Aire::select(['Normal', 'Combinado'], 'is_combined', 'Tipo de producto')
        ->setAttribute('wire:model', 'type')
        ->groupClass('col-span-3') }}
    
    @if(!$type)
        {{Aire::select($variations, 'variation_id', "Variación")->groupClass('col-span-3')}}
    @endif
    
        
    </div>
</div>


