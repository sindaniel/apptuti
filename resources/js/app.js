import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start(); 


// import { createApp } from 'vue'

// import App from './vue/App.vue'
// const app = createApp(App)
// app.mount('#app')


// import Example from './vue/ExampleComponent.vue'
// const example = createApp(Example)
// example.mount('#example')


// import Vue from 'vue';

// //register component
// Vue.component('example',require('./vue/ExampleComponent.vue').default);




// import Vue from 'vue';
// import MyComponent from './vue/ExampleComponent.vue';
// Vue.component('my-component', MyComponent);



// const app = new Vue({
//     el: '#app'
// });



//import { createApp } from 'vue'
//import MyComponent from './vue/ExampleComponent.vue'
// createApp(MyComponent).mount('#app')



const sidebar = document.getElementById('sidebar');

if (sidebar) {
    const toggleSidebarMobile = (sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose) => {
        sidebar.classList.toggle('hidden');
        sidebarBackdrop.classList.toggle('hidden');
        toggleSidebarMobileHamburger.classList.toggle('hidden');
        toggleSidebarMobileClose.classList.toggle('hidden');
    }
    
    const toggleSidebarMobileEl = document.getElementById('toggleSidebarMobile');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const toggleSidebarMobileHamburger = document.getElementById('toggleSidebarMobileHamburger');
    const toggleSidebarMobileClose = document.getElementById('toggleSidebarMobileClose');
   
    
    toggleSidebarMobileEl.addEventListener('click', () => {
        toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
    });
    
    sidebarBackdrop.addEventListener('click', () => {
        toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
    });
}
