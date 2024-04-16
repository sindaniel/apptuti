@if($status == 0)
    <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800'>
        Pendiente
    </span>
@endif

@if($status == 1)
    <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800'>
        Procesada
    </span>
@endif
   


@if($status == 2)
    <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-800'>
        Error 
    </span>
@endif


@if($status == 3)
    <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-800'>
        Error webservice
    </span>
@endif