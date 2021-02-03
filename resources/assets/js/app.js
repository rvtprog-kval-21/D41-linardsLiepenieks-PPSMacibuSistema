/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../js/bootstrap');



window.Vue = require('vue');
window.axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import Vue from 'vue';
import VueCodemirror from 'vue-codemirror';
import 'codemirror/lib/codemirror.css';
Vue.use(VueCodemirror, /* {
  options: { theme: 'base16-dark', ... },
  events: ['scroll', ...]
} */);

import LoadScript from 'vue-plugin-load-script';

Vue.use(LoadScript);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('../../js/components/ExampleComponent.vue').default);
Vue.component('add-test', require('../../js/components/AddTest.vue').default);
Vue.component('codemirror', require('../../js/components/CodeMirror.vue').default);
Vue.component('banner-edit', require('../../js/components/BannerEdit.vue').default);
Vue.component('add-tag', require('../../js/components/AddTag.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//import '../../public/js/codemirror.js';

const app = new Vue({
    el: '#app',


});
