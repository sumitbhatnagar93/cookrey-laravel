/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

/**
 * Datatable
 */
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

/**
 * Preloader
 */

import Vue from 'vue';
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
// Init plugin
Vue.use(Loading);

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

Vue.component('home-component', require('./components/homeComponent.vue').default);
Vue.component('home-banner',require('./components/global/home-banner.vue').default);
Vue.component('footer-component',require('./components/global/footerComponent.vue').default);
Vue.component('search-component',require('./components/global/searchComponent.vue').default);
Vue.component('account-sidebar',require('./components/global/account-sidebar').default);
Vue.component('tab-menu',require('./components/global/tabMenu.vue').default);
Vue.component('order-receipt',require('./components/global/order-receipt').default);
Vue.component('order-confirm',require('./components/order-confirmation').default);
Vue.component('account',require('./components/Account').default);
Vue.component('account-profile',require('./components/account-profile').default);
Vue.component('account-order',require('./components/account-order').default);
Vue.component('account-subscription',require('./components/account-subscription').default);
Vue.component('single-subscription',require('./components/single-subscription').default);
Vue.component('vendor-single-subscription',require('./components/vendor/single-subscription').default);
/**
 * Vendor related templates
 */
Vue.component('update-product', require('./components/vendor/update-product.vue').default);
Vue.component('add-service', require('./components/vendor/AddFoodService.vue').default);
Vue.component('cookrey-vendors', require('./components/vendor/AllVendors.vue').default);
Vue.component('cookrey-vendors-web', require('./components/vendorComponent.vue').default);
Vue.component('single-vendor-web', require('./components/singleVendorComponent.vue').default);

//vendor account components
Vue.component('vendor',require('./components/vendor/Vendor').default);
Vue.component('vendor-sidebar', require('./components/vendor/vendor-sidebar.vue').default);
Vue.component('vendor-single-product', require('./components/vendor/vendor-single-product.vue').default);
Vue.component('vendor-profile', require('./components/vendor/vendor-profile.vue').default);
Vue.component('vendor-products', require('./components/vendor/vendor-products.vue').default);
Vue.component('vendor-orders', require('./components/vendor/vendor-orders.vue').default);
Vue.component('vendor-subscriptions', require('./components/vendor/vendor-subscriptions.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

import moment from 'moment';
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('LL')
    }
})
