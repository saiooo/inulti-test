import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const Bundles = require('./components/Bundles.vue');
const Products = require('./components/Products.vue');

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/laravel/inulti/bundles',
            name: 'bundles',
            component: Bundles
        },
        {
            path: '/laravel/inulti/products',
            name: 'products',
            component: Products
        }
    ]
});

router.replace('/laravel/inulti/bundles');


export default router