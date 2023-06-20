import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'


require('./bootstrap');

window.Vue = require('vue').default;


/* Vue.component('example-component', require('./components/ExampleComponent.vue').default); */

Vue.component('navbar', require('./components/Navbar.vue').default);

Vue.component('articles', require('./components/Articles.vue').default);

Vue.component('foot', require('./components/Footer.vue').default);

const app = new Vue({
    el: '#app',
});
