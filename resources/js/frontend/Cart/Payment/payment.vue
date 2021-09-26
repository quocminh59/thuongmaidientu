<template>
    <div class="payment">
        <div class="pm-left">
            <div class="wrap-order">
                <h3>Hình thức giao hàng</h3>
                <div class="delivery">
                    <span>
                        <input type="radio" name="" checked>
                        <strong>Giao hàng tiêu chuẩn</strong>
                    </span>
                    <h4>Miễn phí</h4>
                </div>
                <h3>Thông tin đơn hàng</h3>
                <div class="detail">
                    <p>{{ cart.totalQuantity }} sản phẩm</p>
                    <span @click="show = !show">Xem chi tiết <i class="fas fa-caret-down"></i></span>
                </div>
                <div class="info-order" v-if="show">
                    <div 
                        class="item-order"
                        v-for="(item, index) in cart.products"
                        :key="index"
                    >
                        <div class="item-info" v-if="item.status == true">          
                            <img :src="baseURL + item.productInfo.feature_image" alt="">
                            <span>
                                <p>{{ item.productInfo.name }}</p>
                                <p><strong>SL: {{ item.quantity }}</strong></p>
                            </span> 
                        </div>
                        <div class="item-price">{{ format(item.price) }}</div>
                    </div>
                </div>
                <div class="totalall">
                    <span>
                        <p>Thành tiền</p>
                        <p>
                            <strong>{{ format(cart.totalPrice) }}</strong>
                            <br>
                            <i>(Đã bao bồm VAT nếu có)</i>
                        </p>
                    </span>
                    
                </div>
            </div>

            <div class="payment-methods">
                <h3>Phương thức thanh toán</h3>
                <p>Thông tin thanh toán của bạn sẽ luôn được bảo mật</p>
                <div class="wrap-pm">
                    <div class="pm">
                        <input type="radio" name="" id="">
                        <span>
                            <strong>Thanh toán qua VNPAY</strong>
                            <p>Thanh toán qua Internet Banking, Visa, Master, JCB, VNPAY-QR</p>
                        </span>
                    </div>
                    <div class="pm">
                        <input type="radio" name="" id="">
                        <span>
                            <strong>Thanh toán khi nhận hàng</strong>
                            <p>Thanh toán bằng tiền mặt khi nhận hàng tại nhà hoặc showroom</p>
                        </span>
                    </div>
                </div> 
            </div>
        </div>

        <div class="pm-right">
            <div class="address-ship">
                <div class="add-header">
                    <span>Địa chỉ giao hàng</span>
                    <button>Sửa</button>
                </div>
                <div class="add-bottom">
                    <strong>Quan Quoc Minh</strong>
                    <p>114 Phan Dang Luu</p>
                    <p>Huyen Gia Lam, Ha Noi</p>
                    <p>Dien thoai: 0981098963</p>
                </div>
            </div>
            <div class="payment-order">
                <div class="separate">
                    <p>Tạm tính</p>
                    <strong>11.990.000 đ</strong>
                </div>
                <div class="separate">
                    <p>Phí vận chuyển</p>
                    <strong>0 đ</strong>
                </div>
                <div class="separate">
                    <p>Thành tiền</p>
                    <span>11.990.000đ</span>
                </div>
                <div class="separate">
                    <p></p>
                    <p>(Đã bao gồm VAT)</p>
                </div>
                <div class="btn-payment">
                    <div class="btn bp">ĐẶT HÀNG NGAY</div>
                    <p>(Xin vui lòng kiểm tra lại đơn hàng trước khi đặt mua)</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import base from '../../../admin/baseurl'
export default {
    props: ['data'],
    data() {
        return {
            show: false,
            cart: this.data,
            baseURL: base
        }
    },
    methods: {
        format: function(value) {
           value =  new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
           return value;
        },
    }
}
</script>

<style scoped src="./payment.css">
</style>