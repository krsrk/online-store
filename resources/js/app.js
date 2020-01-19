
require('./bootstrap');
import router from './plugins/router'
import vuetify from './plugins/vuetify'





Vue.component('example-component', require('./components/web/HomeComponent').default);

//product IMPORT
Vue.component('product-index', require('./components/dashboard/products/IndexProductComponent').default);
Vue.component('product-post', require('./components/dashboard/products/postProductComponent').default);

//USER IMPORT
Vue.component('user-index', require('./components/dashboard/users/IndexUsers').default);


// ORDERS IMPORT
Vue.component('order-index', require('./components/dashboard/orders/IndexOrders').default);

//Home IMPORT
Vue.component('home-index',require('./components/web/HomeComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    router
});
