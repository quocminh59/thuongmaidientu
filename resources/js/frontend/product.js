import Vue from 'vue';
import axios from 'axios';
import Cart from './cart.vue';
import base from './baseurl';

const cart = new Vue({
    el: '#product',
    components: {
        Cart
    },
    data() {
        return {
            test: "Check xem co hoat dong khong"
        };
    },
    methods: {
       addCart: function() {
           axios.get(`${base}/addcart/1`).then(() => {
               alert("Đã thêm sản phẩm vào giỏ hàng");
               document.location.reload();
           })
       }
    }
});