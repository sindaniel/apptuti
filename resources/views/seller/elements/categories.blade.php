

    <section class='p-3'>
        <div class="bg-secondary rounded p-3 text-white">
            <form action="" class="flex flex-col space-y-2">
                <label for="">Categorías</label>
                {{Aire::select(['Pilas', 'Pegamentos'], 'category_id')}}
            </form>
        </div>

    </section>