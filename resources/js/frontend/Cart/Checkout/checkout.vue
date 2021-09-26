<template>
    <div>
        <div class="checkout" v-if="type == 'checkout'">
            <div class="chkout-part">
                <h1><strong>Thông tin người nhận hàng</strong></h1>
                <label for="">Họ tên</label><br>
                <input type="text" name="fullname" id="" class="ck-form">
                <div class="section">
                    <div class="section-part first">
                        <label for="">Số điện thoại</label> <br>
                        <input type="text" name="" id="" class="ck-form-sm">
                    </div>
                    <div class="section-part">
                        <label for="">Email</label> <br>
                        <input type="email" name="" id="" class="ck-form-sm">
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
                                :value="item.WardID"
                            >
                                {{ item.WardName }}
                            </option>
                        </select>
                    </div>
                    <div class="section-part">
                        <label for="">Địa chỉ cụ thể</label> <br>
                        <input type="email" name="" id="" class="ck-form-sm">
                    </div>
                </div>
            </div>
            <div class="manipulation">
                <div class="btn btn-next" @click="next()">Tiếp tục</div>
                <div class="btn btn-out" @click="turnback()">Hủy bỏ</div>
            </div>
        </div>
        <payment v-if="type == 'payment'" :data="cart"></payment>
    </div> 
</template>

<script>
import Payment from '../Payment/payment.vue'
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
        }
    },
    mounted() {
        axios.get('https://provinces.open-api.vn/api', {
            withCredentials: true,
        }).then((response) => {
            console.log(response.data);
        })
    },
    methods: {
        turnback: function() {
            this.$root.$refs.cart.type = 'cart';
            
        },
        next: function() {
            this.type = 'payment';
        },
        getApiAddress: function(api, type) {
            axios.get(`${api}`, {
                headers: {'token': 'e1eae69c-1910-11ec-b8c6-fade198b4859'}
            }).then((response) => {  
                if(type == 'province') {
                    this.dataApi.province = response.data.data;
                    this.dataApi.district = null;
                    this.districtStatus = false;      
                }
                else if(type == 'district') {
                    this.dataApi.district = response.data.data;
                    this.dataApi.ward = null; 
                    this.wardStatus = false;
                }     
                else {
                    this.dataApi.ward = response.data.data;      
                }
            });
        },

    },
}
</script>

<style scoped src="./checkout.css"></style>