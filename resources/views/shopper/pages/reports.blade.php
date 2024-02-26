@extends('layouts.shopper')





@section('content')
    
    <section class="px-2 mb-5">
        <h1 class="text-secondary text-xl mb-5">Reporte de Ventas</h1>

        

       <div class="flex  justify-center">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                    Hoy
                </button>
                <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                    Semana
                </button>
                <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                    Personalizar
                </button>
            </div>

        </div>

       
        <div class="flex justify-center space-y-4 mt-5 flex-col items-center">
            <h2 class=" text-gray-500">Lunes 28 de Agosto - 2023</h2>

       
                <div class="bg-blue2 items-center flex-col px-20 rounded flex justify-center py-5">
                    <h2 class="text-gray-500 font-bold">Total Ventas</h2>
                    <h3 class="text-blue1 text-2xl">$ 827.000</h3>
                </div>


                <div class="bg-blue2 items-center flex-col px-20 rounded flex justify-center py-5">
                    <h2 class="text-gray-500 font-bold">Total Pedidos</h2>
                    <h3 class="text-blue1 text-2xl">45</h3>
                </div>
         
        </div>


    </section>
   


 

@endsection


