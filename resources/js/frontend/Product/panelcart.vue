<template>
    <a class="giohang function">
        <i class="fal fa-shopping-cart cd" id="btn-cart"></i>
        <span class="ct">Giỏ hàng</span>
        <div class="panal-cart hidden">
            <div class="cart-pd" v-if="issetCart">
                <div 
                    class="cart-pd-item"
                    v-for="(item, index) in cart.products"
                    :key="index"
                >
                    <img :src="base + item.productInfo.feature_image" alt="" class="cpd-img">
                    <div>
                        <p class="cart-pd-name">{{ item.productInfo.name }}</p>
                        <p class="cart-pd-number">Số lượng: {{ item.quantity }}</p>
                        <strong class="cart-pd-price">{{ format(item.price) }}</strong>
                    </div>
                </div>
            </div>
            <div class="cart-footer" v-if="issetCart">
                <div class="totalprice">
                    <p>Tổng tiền ({{  cart.totalQuantity }} sản phẩm)</p>
                    <strong>{{  format(cart.totalPrice) }}</strong>
                </div>
                <button @click="goToCart()">Xem giỏ hàng</button>
            </div>
            <div v-if="!issetCart">
                <h1>Giỏ hàng trống</h1>
            </div>
        </div>
        <div class="number-cart">{{ cart.totalQuantity }}</div>
    </a>
</template>

<script>
import base from './../../admin/baseurl'
export default {
    props: ['data'],
    data() {
        return {
            cart: this.data,
            base: base
        };
    },
    computed: {
        issetCart: function() {
            if(this.data.products == null) return false;
            return true;
        }
    },
    methods: {
        format: function(value) {
           value =  new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
           return value;
        },
        goToCart: function() {
            location.href = this.base + '/cart';
        },
        lengthObject: function(object) {
            return Object.keys(object).length;
        },
        getInfoProduct: function(id) {
            for(let i = 0; i < this.lengthObject(this.cart.productList); i++) {
                if(this.cart.productList[i].id == id) {
                    console.log(this.cart.productList[i]);
                    return this.cart.productList[i];
                }
            }
        },
        changeNumberCart: function(value) {
            this.cart.totalQuantity = value;
        },
        ajaxCart: function(id) {
            try {
                var newItem = this.getInfoProduct(id);
                var checkExist = false;
                // Case1: The cart is empty
                if(this.cart.products == null) { 
                    this.cart.products = {};
                    this.cart.products[id] = {
                        price: newItem.lastprice,
                        productInfo: newItem,
                        quantity: 1,
                        status: true      
                    };
                    this.cart.totalPrice += newItem.lastprice;
                    this.cart.totalQuantity++;
                 
                }
                // Case2: The cart has products
                else {
                    Object.values(this.cart.products).forEach(item => {
                        // The product exist in the cart
                        if(id == item.productInfo.id) {
                            item.quantity++;
                            item.price += item.productInfo.lastprice;
                            this.cart.totalQuantity++;
                            this.cart.totalPrice += item.productInfo.lastprice;
                            checkExist =  true;
                            return true;
                        }
                    })
                    // The product don't exist in the cart
                    if(checkExist == false) {
                         this.cart.products[id] = {
                             price: newItem.lastprice,
                             productInfo: newItem,
                             quantity: 1,
                             status: true
                         };
                         this.cart.totalQuantity++;
                         this.cart.totalPrice += newItem.lastprice;
                    }
                }
                alert('Thêm sản phẩm vào giỏ hàng thành công');
            }
            catch(error) {
                alert("Thêm sản phẩm vào giỏ hàng thất bại"+ error);
            }
        }
    }
}
</script>

<style>
.panal-cart {
    position: absolute;
    bottom: -322px;
    width: 40rem;
    height: 31rem;
    border-radius: 5px;
    background: white;
    right: 0;
    z-index: 100;
    padding: 1rem;
    box-shadow: 2px 0px 4px  -1px black;
}

.cart-pd {width: 38rem;height: 20rem;overflow-y: scroll;}

.cpd-img {
    width: 20%;
    height: 20%;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 1rem;
}

.cart-pd-item {
    width: 100%;
    display: flex;
}

p.cart-pd-name {
    font-size: 1.4rem;
    height: 4rem;
    overflow: hidden;
}

p.cart-pd-number {
    font-size: 1.3rem;
    height: 1rem;
}

.cart-pd-price {
    font-size: 1.5rem;
    color: black;
}

.cart-footer {
    width: 95%;
    position: absolute;
    bottom: 0;
    display: flex;
    margin: auto;
    flex-wrap: wrap;
}

.totalprice {
    width: 100%;
    height: 5rem;
    display: flex;
    color: black;
    justify-content: space-between;
    align-items: baseline;
    border-top: 1px solid #ddd;
    border-top-style: dashed;
    padding-top: 1rem;
}

.totalprice p {
    font-size: 1.4rem;
}

.totalprice strong {
    font-size: 2rem;
    color: red;
}

.panal-cart button {
    width: 100%;
    height: 3rem;
    margin-bottom: 1rem;
    background-color: #2f2fc7;
    border: none;
    border-radius: 5px;
    font-size: 1.5rem;
    color: white;
    cursor: pointer;
}
</style>