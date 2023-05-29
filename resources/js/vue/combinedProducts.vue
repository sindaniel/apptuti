<template>
    <div class="grid grid-cols-1  xl:grid-cols-3 xl:gap-4 ">
        <div class="mb-4 col-span-full  grid grid-cols-2">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Productos combinados</h1>

            <select  name="" id="" class='shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm  focus:ring-primary-500 focus:border-primary-500 block w-full  p-2 text-base rounded-sm'>
                <option value="">Seleccione</option>
                <option value="">Seleccione</option>
            </select>
        
        </div>
    </div>

</template>

<script>

   export default {
    data () {
      return {
        selected: null,
        options: ['list', 'of', 'options']
      }
    },
    mounted() {

        console.log(window.products)
    },
  
    
}
</script>


<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">


