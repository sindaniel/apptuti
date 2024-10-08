@props(['items', 'title', 'product' => null, 'relation'])

<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
    <h3 class="mb-4 text-xl font-semibold ">{{ $title }}</h3>
    <div class="grid grid-cols-2 gap-3">
        @foreach ($items as $item) 
            <div class="flex flex-col  cursor-pointer">
                <div class="flex items-center space-x-2">
                    <input  
                    @if($product)
                        @checked($product[$relation]->contains($item->id))
                    @endif
                    id="{{ $relation }}{{ $item->id }}" 
                    name="{{ $relation }}[]"
                    type="checkbox" 
                    value="{{ $item->id }}"
                    @class([
                        'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-0 cursor-pointer ', 
                        'opacity-50' => !$item->active])
                    >
                    <label   @if (!$item->active) data-tooltip-target="tooltip-default{{ $item->id }}"  @endif    for="{{ $relation }}{{ $item->id }}"  @class([
                        ' text-sm font-medium  cursor-pointer',
                        'text-gray-900' => $item->active,
                        'text-gray-400' => !$item->active
                        ])>
                        {{ $item->name }}
                    </label>
                    @if (!$item->active)
                        <div id="tooltip-default{{ $item->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Item desactivado
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    @endif   
                </div>
                <div class="flex flex-col space-y-2 mt-2 cursor-pointer ml-4">
                    @foreach ($item->children as $item)
                        <div class="flex items-center space-x-2">
                                        
                        <input  
                        @if($product)
                            @checked($product[$relation]->contains($item->id))
                        @endif
                        id="{{ $relation }}{{ $item->id }}" 
                        name="{{ $relation }}[]"
                        type="checkbox" 
                        value="{{ $item->id }}"
                        @class([
                            'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-0 cursor-pointer ', 
                            'opacity-50' => !$item->active])
                        >
                        <label   @if (!$item->active) data-tooltip-target="tooltip-default{{ $item->id }}"  @endif    for="{{ $relation }}{{ $item->id }}"  @class([
                            'text-sm font-medium  cursor-pointer',
                            'text-gray-900' => $item->active,
                            'text-gray-400' => !$item->active
                            ])>
                            {{ $item->name }}
                        </label>
                        @if (!$item->active)
                            <div id="tooltip-default{{ $item->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                Item desactivado
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        @endif   
                        </div>


                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
