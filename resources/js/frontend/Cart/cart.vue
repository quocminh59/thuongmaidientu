<template>
    <div>
        <div class="wrap-cart" v-if="type == 'cart'">
            <div class="cart">
                <div class="cart-header">
                    <input 
                        type="checkbox" 
                        name="ckDellAll" 
                        class="sp-0" 
                        v-model="cart.status"
                        @click= "toggleParent()"
                    >
                    <span class="sp-1">Tất cả ({{ cart.totalQuantity }}) sản phẩm</span>
                    <span class="sp-2">Đơn giá</span>
                    <span class="sp-3">Số lượng</span>
                    <span class="sp-4">Thành tiền</span>
                    <a class="sp-5" @click="deleteAll()">
                        <i class="fal fa-trash-alt"></i>
                    </a>
                </div>
                <div class="cart-main">
                    <div 
                        class="cart-item"
                        v-for="(item, index) in cart.products"
                        :key="index" 
                    >
                        <input 
                            type="checkbox" 
                            :value="item.productInfo.id" 
                            v-model="checked" 
                            :id="'chkItem'+index"
                            @click="toggleItem(item.productInfo.id)"
                        >
                        <img :src="base + item.productInfo.feature_image" alt="">
                        <a href="">
                            {{ item.productInfo.name }}
                        </a>
                        <div class="price">
                            <strong>{{ format(item.productInfo.lastprice) }} đ</strong>
                            <span>{{ format(item.productInfo.price) }} đ</span>
                        </div>
                        <div class="number-input">
                            <button class="minus" @click= "minus(index)"></button>
                            <input class="quantity" :id="index" name="quantity" :value="item.quantity" type="number">
                            <button class="plus" @click= "plus(index)"></button>
                        </div>
                        <div class="total">
                        {{ format(item.price) }}
                        </div>
                        <div class="del-item">
                            <a href=""><i class="fal fa-trash-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order">
                <div class="order-header">
                    <input type="text" name="code" placeholder="Mã giảm giá/ quà tặng">
                    <button>Áp dụng</button>
                </div>
                <div class="order-main">
                    <div class="module">
                        <span>Tạm tính</span>
                        <span>{{ format(cart.totalPrice) }}</span>
                    </div>
                    <div class="module">
                        <span>Giảm giá</span>
                        <span>0</span>
                    </div>
                    <div class="module md-last">
                        <span>Thành tiền</span>
                        <strong>{{ format(cart.totalPrice) }}</strong>
                    </div>
                    <p>(Đã bao gồm VAT nếu có)</p>
                </div>
                <div class="btn btn-danger btn-order" @click="redirectCheckout()">Tiến hành đặt hàng</div>
            </div>
        </div>
        <checkout v-if="type == 'checkout'" :data="cart" ref="chk"></checkout>
    </div>    
</template>
<script>
import base from '../../admin/baseurl';
import Checkout from './Checkout/checkout.vue'
export default {
    props: ['data'],
    components:{Checkout},
    data() {
        return {
            base: base,
            count: 0,
            cart: this.data,
            checked: [],
            parentChecked: this.data.status,
            type: 'cart'
        };
    },
    mounted() {
        if(this.cart.status == false) {
            Object.values(this.cart.products).forEach(item => {
                if(item.status == true) {
                    this.checked.push(item.productInfo.id);
                } 
            })
        }
        else {
            this.checkAll();
        }
    },
    methods: {
        format: function(value) {
           value =  new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
           return value;
        },
        minus: function(key) {
            if(document.getElementById(key).value > 1) {
                document.getElementById(key).value--;
                var quantity = document.getElementById(key).value;
                axios.post(`${base}/updatecart/${key}/${quantity}`)
                .then(() => {
                    this.cart.totalQuantity--;
                    this.cart.products[key].quantity--;
                    this.cart.products[key].price -= this.cart.products[key].productInfo.lastprice;
                    this.cart.totalPrice -= this.cart.products[key].productInfo.lastprice;
                    this.$root.$refs.panelcart.changeNumberCart(this.cart.totalQuantity);
                    alert("Giỏ hàng đã cập nhật");
                })
            }
        },
        plus: function(key) {
            document.getElementById(key).value++;
            var quantity = document.getElementById(key).value;
            axios.post(`${base}/updatecart/${key}/${quantity}`)
            .then(() => {
                this.cart.products[key].quantity++;
                this.cart.products[key].price += this.cart.products[key].productInfo.lastprice;
                if(this.cart.products[key].status == true) {
                    this.cart.totalQuantity++;
                    this.cart.totalPrice += this.cart.products[key].productInfo.lastprice;
                    this.$root.$refs.panelcart.changeNumberCart(this.cart.totalQuantity);
                }
                alert("Giỏ hàng đã cập nhật");
            })
        },
        unCheckAll: function() {
            this.checked = [];
            this.cart.status = false;
            Object.values(this.cart.products).forEach(item => {
                item.status = false;   
            });
        },
        checkAll: function() {
            Object.values(this.cart.products).forEach(item => {
                this.checked.push(item.productInfo.id);
                item.status = true;    
            })
            this.cart.status = true;
        },
        toggleParent: function() {
            if(this.cart.status == true) {
                this.unCheckAll();
                axios.post(`${base}/virtualdellall`)
                .then(() => {
                    this.cart.totalQuantity = 0;
                    this.cart.totalPrice = 0;
                })
            }
            else {
                this.checkAll();
                axios.post(`${base}/virtualdellall`)
                .then(() => {
                    this.cart.totalQuantity = 0;
                    this.cart.totalPrice = 0;
                    Object.values(this.cart.products).forEach(item => {
                        this.cart.totalQuantity += item.quantity;
                        this.cart.totalPrice += item.price;
                    })
                })
            }
            
        },
        toggleItem: function(key) {
            if(this.cart.products[key].status == true) {
                axios.post(`${base}/virtualdellitem/${key}`)
                .then(() => {
                    this.cart.status = false;
                    this.cart.products[key].status = false;
                    if(this.cart.totalPrice > 0) {
                        this.cart.totalPrice -= this.cart.products[key].price;
                        this.cart.totalQuantity -= this.cart.products[key].quantity;
                    }
                })
            }
            else {
                axios.post(`${base}/restoredellitem/${key}`)
                .then(() => {
                    this.cart.totalPrice += this.cart.products[key].price;
                    this.cart.totalQuantity += this.cart.products[key].quantity;
                    this.cart.products[key].status = true;
                    this.cart.status = true;
                    Object.values(this.cart.products).forEach(item => {
                        if(item.status == false) this.cart.status = false;
                    })
                })
            }
        },
        deleteAll: function() {
            axios.post(`${base}/dellall`)
        },
        checkExistItemCart: function() {
            let check = false;
            Object.values(this.cart.products).forEach(item => {
                if(item.status == true) check = true;
            })
            return (check == true) ? true : false;
        },
        redirectCheckout: function() {
            if(this.cart.status == true || this.checkExistItemCart()) {
                this.type = 'checkout';
                this.$root.type = 'checkout';
            }
            else {
                alert('Bạn chưa chọn sản phẩm nào trong giỏ hàng');
            } 
        },
    }
}
</script>
