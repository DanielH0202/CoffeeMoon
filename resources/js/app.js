import vuetify from './vuetify'


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('alimentos-component', require('./components/alimentosComponent.vue').default);
Vue.component('alimentos-cliente-component', require('./components/alimentosClienteComponent.vue').default);
Vue.component('clientes-component', require('./components/clientesComponent.vue').default);
Vue.component('repartidores-component', require('./components/repartidoresComponent.vue').default);
Vue.component('pedidos-component', require('./components/pedidosComponent.vue').default);
Vue.component('encuestas-component', require('./components/encuestasComponent.vue').default);
Vue.component('pagos-component', require('./components/pagosComponent.vue').default);
Vue.component('carrito-component', require('./components/carritoComponent.vue').default);
Vue.component('pedidos-repartidor-component', require('./components/pedidosRepartidorComponent.vue').default);
Vue.component('pedidos-cliente-component', require('./components/pedidosClienteComponent.vue').default);
Vue.component('pedidos-negocio-component', require('./components/pedidosNegocioComponent.vue').default);
Vue.component('pedidos-actual-component', require('./components/pedidoActualComponent.vue').default);
Vue.component('reservas-component', require('./components/ReservasComponent.vue').default);
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$userT = document.querySelector("meta[name='userag']").getAttribute('content');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app_uttec',
    vuetify,
});
