import Vue from "vue";
import routes from "./router/router";

require("./bootstrap");

import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Index', require('./components/admin/IndexComponent').default);



const app = new Vue({
    el: "#app",
    router: routes
});
