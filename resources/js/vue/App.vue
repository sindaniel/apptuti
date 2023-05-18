<template>
    
    <div>
        <VueMultiselect
  v-model="taggingSelected"
  :options="taggingOptions"
  :multiple="true"
  :taggable="true"
  @tag="addTag"
  tag-placeholder="Add this as new tag"
  placeholder="Type to search or add tag"
  label="name"
  track-by="code"
/>
  </div>
    
  </template>
  
  <script>
   import VueMultiselect from 'vue-multiselect'


  export default {
   components: { VueMultiselect },
    data () {
        return {
        selected: null,
        options: ['list', 'of', 'options']
        }
    }
  }
  </script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
