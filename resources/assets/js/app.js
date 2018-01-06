
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('customers', require('./components/CustomerComponent.vue'));

Vue.component('users', require('./components/UserComponent.vue'));

Vue.component('category', require('./components/CategoryComponent.vue'));

Vue.component('subcategory', require('./components/subCategoryComponent.vue'));

Vue.component('products', require('./components/productComponent.vue'));

Vue.component('taxrules', require('./components/taxRulesComponent.vue'));

Vue.component('discount', require('./components/discountComponent.vue'));

Vue.component('tables', require('./components/tablesComponent.vue'));

Vue.component('managerole', require('./components/manageRoleComponent.vue'));

Vue.component('login', require('./components/loginComponent.vue'));

Vue.component('order', require('./components/orderComponent.vue'));
/*Vue.component('pagination', require('laravel-vue-pagination'));*/

const app = new Vue({
    el: '#app'
});
