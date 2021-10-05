import Vue from 'vue';
import axios from 'axios';
import VueSession from 'vue-session';
import base from './../admin/baseurl';
import PanelCart from './Product/panelcart.vue';
import Cart from './Cart/cart.vue';
import Checkout from './Cart/Checkout/checkout.vue';
import Payment from './Cart/Payment/payment.vue';

Vue.use(VueSession)

const product = new Vue({
    el: '#product',
    components: {PanelCart, Cart, Checkout, Payment},
    data() {
        return {
            numberCart: 0,
            type: 'cart',
        };
    },
    methods: {
       addCart: function(id) {
           axios.post(`${base}/addcart/${id}`).then(() => {
            this.$refs.panelcart.ajaxCart(id);
           })
       },
       updateNumberCart: function(value) {
           this.numberCart = value;
       }
    }
});