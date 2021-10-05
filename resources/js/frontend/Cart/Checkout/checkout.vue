<template>
    <div>
        <div class="checkout" v-if="type == 'checkout'">
            <form @submit.prevent="fetchData()">
                <div class="chkout-part">
                    <h1><strong>Thông tin người nhận hàng</strong></h1>
                    <label for="">Họ tên</label><br>
                    <input type="text" name="name" v-model="dataRequest.name" class="ck-form">
                    <p v-if="errors.name">{{ errors.name[0] }}</p>
                    <div class="section">
                        <div class="section-part first">
                            <label for="">Số điện thoại</label> <br>
                            <input type="text" name="phone" v-model="dataRequest.phone" class="ck-form-sm">
                            <p v-if="errors.phone">{{ errors.phone[0] }}</p>
                        </div>
                        <div class="section-part">
                            <label for="">Email</label> <br>
                            <input type="email" name="email" v-model="dataRequest.email" class="ck-form-sm">
                            <p v-if="errors.email">{{ errors.email[0] }}</p>
                        </div>
                    </div>
                </div>

                <div class="chkout-part last">
                    <h1><strong>Địa chỉ nhận hàng</strong></h1>
                    <div class="section">
                        <div class="section-part first">
                            <label for="">Tỉnh/Thành phố</label> <br>
                            <select 
                                name="province" 
                                class="form-select"
                                v-model="dataRes.province" 
                                @click="getApiAddress('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province', 'province')"
                            >
                                <option v-if="dataApi.province == null" selected>Chọn tỉnh/thành phố</option>
                                <option
                                    v-else
                                    v-for="(item, index) in dataApi.province"
                                    :key="index" 
                                    :value="item.ProvinceID"
                                    
                                >
                                    {{ item.ProvinceName }}
                                </option>
                            </select>
                            <p v-if="errors.province">{{ errors.province[0] }}</p>               
                        </div>
                        <div class="section-part">
                            <label for="">Quận/Huyện</label> <br>
                            <select 
                                name="district"
                                class="form-select"
                                v-model="dataRes.district"
                                @click="getApiAddress(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=${dataRes.province}`, 'district')"
                                :disabled = "districtStatus"
                            >
                                <option v-if="dataApi.district == null" selected>Chọn quận/huyện</option>
                                <option
                                    v-else
                                    v-for="(item, index) in dataApi.district"
                                    :key="index + 'district'" 
                                    :value="item.DistrictID"
                                >
                                    {{ item.DistrictName }}
                                </option>
                            </select>
                            <p v-if="errors.district">{{ errors.district[0] }}</p>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section-part first">
                            <label for="">Phường/Xã</label> <br>
                            <select 
                                name="ward"
                                class="form-select"
                                v-model="dataRes.ward"
                                @click="getApiAddress(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=${dataRes.district}`, 'ward')"
                                :disabled = "wardStatus"
                            >
                                <option v-if="dataApi.ward == null" selected>Chọn phường/xã</option>
                                <option
                                    v-else
                                    v-for="(item, index) in dataApi.ward"
                                    :key="index + 'ward'" 
                                    :value="item.WardCode"
                                >
                                    {{ item.WardName }}
                                </option>
                            </select>
                            <p v-if="errors.ward">{{ errors.ward[0] }}</p>
                        </div>
                        <div class="section-part">
                            <label for="">Địa chỉ cụ thể</label> <br>
                            <input type="text" name="" v-model="dataRequest.address" class="ck-form-sm">
                            <p v-if="errors.address">{{ errors.address[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="manipulation">
                    <input type="submit" value="Tiep tuc" class="btn btn-next" >
                    
                    <div class="btn btn-out" @click="turnback()">Hủy bỏ</div>
                </div>
            </form>    
            </div>
        <payment v-if="type == 'payment'" :cart="cart" :data="dataPass" @back="BackToCheckout($event)"></payment>
    </div> 
</template>

<script>
import Payment from '../Payment/payment.vue'
import base from '../../../admin/baseurl'
export default {
    props: ['data'],
    components: {Payment},
    data() {
        return {
            type: 'checkout',
            cart: this.data,
            dataApi: {
                province: null,
                district: null,
                ward: null
            },
            dataRes: {
                province: "Chọn tỉnh/thành phố",
                district: 'Chọn quận/huyện',
                ward: 'Chọn phường/xã'
            },
            districtStatus: true,
            wardStatus: true,
            dataRequest: {},
            dataPass: null,
            errors: {},
        }
    },
    mounted() {
        if(this.$session.get('Info')) {
            this.dataRequest = this.$session.get('Info');
        }
    },
    methods: {
        turnback: function() {
            this.$root.$refs.cart.type = 'cart';
            
        },
        next: function() {
            this.type = 'payment';
        },
        getNameAddress: function(id, type) {
            if(type == 'province' ) {
                this.dataApi.province.forEach(item => {
                    if(item.ProvinceID == id) 
                        this.dataRequest.province = item.ProvinceName;
                })
            }
            else if(type == 'district') {
                this.dataApi.district.forEach(item => {
                    if(item.DistrictID == id)
                        this.dataRequest.district = item.DistrictName;
                })
            }
            else {
                this.dataApi.ward.forEach(item => {
                    if(item.WardCode == id)
                        this.dataRequest.ward = item.WardName;
                })
            }
        },
        getApiAddress: function(api, type) {
            axios.get(`${api}`, {
                headers: {'token': 'e1eae69c-1910-11ec-b8c6-fade198b4859'}
            }).then((response) => {  
                if(type == 'province') {
                    this.dataApi.province = response.data.data;
                    this.dataApi.district = null;
                    this.districtStatus = false;
                    this.getNameAddress(this.dataRes.province, 'province');
                   
                }
                else if(type == 'district') {
                    this.dataApi.district = response.data.data;
                    this.dataApi.ward = null; 
                    this.wardStatus = false;
                    this.getNameAddress(this.dataRes.district, 'district');
                }     
                else{
                    this.dataApi.ward = response.data.data;
                    this.getNameAddress(this.dataRes.ward, 'ward');      
                }
            });
        },
        fetchData: function() {
            axios.post(`${base}/payment/validate-info`, this.dataRequest)
            .then(() => {
                this.dataPass = this.dataRequest;
                this.$session.start();
                this.$session.set('Info', this.dataRequest);
            })
            .then(() => {
                this.next();
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
        BackToCheckout: function(value) {
            this.type = value;
        },
        

    },
}
</script>

<style scoped src="./checkout.css"></style>