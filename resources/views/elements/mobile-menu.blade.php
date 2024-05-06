<div class="flex xl:hidden">
    <div class="fixed bg-white w-full h-full z-50" id='mobileMenu' style="display: none">
        <header class="border-b py-2 px-5">
            <div class="flex justify-between items-center">
                <img src="{{ asset('img/tuti.png') }}" class="h-14 mr-3" />
                <button class="text-2xl" id="closeMobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
        </header>
        <section class="p-5">
            <div class="mb-5">
                <form action="{{route('search')}}" class="relative">
                    <input placeholder="Busqueda" value='{{request()->q}}' name='q' type="text" class='bg-[#e8e7e5] border-0 rounded w-full'>
                    <svg class=" absolute right-2 top-2 text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>    
                </form>
            </div>

            <ul class="text-xl space-y-4">
                <li>
                    <a   href="{{route('form')}}">Quiero ser cliente</a>
                </li>
                
                <li><a href="#">Preguntas frecuentes</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Políticas de privacidad</a></li>
                <li><a href="#">Términos y condiciones</a></li>
                <li><a href="#">Contáctanos</a></li>


            </ul>

        </section>
    </div>
</div>