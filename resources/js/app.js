/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
require('./bootstrap');
global.bsCustomFileInput = require('bs-custom-file-input');
require('datatables.net-bs4');
require('select2');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.component('attribution', require('./components/AttributionComponent.vue').default);
