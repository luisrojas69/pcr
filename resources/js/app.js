
require('./bootstrap');

window.Vue = require('vue');


Vue.component('vehicles', require('./components/ListVehiclesComponent.vue').default); //Tabla de Vehiculos
Vue.component('form-vehicle', require('./components/FormVehicle.vue').default); //Tabla de Vehiculos

const app = new Vue({
    el: '#app',
});
