<template>
    <div>
        <breadcrumb :links="links"></breadcrumb>
        <div class="title">Thêm thương hiệu</div>
        <notification :type="message.type" :content="message.content" :show="display"></notification>
        <div class="brand-create">
            <form @submit.prevent="save()">
                <div class="row mb-4 ">
                    <label for="brand_name" class="col-sm-2 col-form-label">Tên thương hiệu</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="brand.brand_name" id="brand_name" class="form-control">
                    </div>
                    <label class="col-sm-2"></label>
                    <strong class="col-sm-10" v-if="isEmpty(errors.brand_name)" v-show="show">{{ errors.brand_name[0] }}</strong>
                </div>
               
                <div class="row mb-4">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-success add" value="Thêm mới" @click="changeDisplay()">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import base from './../../baseurl';

export default {
    data() {
        return {
            links: ['Home','Categories Management', 'Brand', 'Create'],
            brand: {},
            errors:{},
            show: true,
            message: {},
            display: null,
        }
    },
    methods: {
        save: function(){
            axios.post(`${base}/admin/brand/create`, this.brand).then(()=>{
                this.show = false;
                this.brand = {};
                this.message.type = 'success';
                this.message.content = 'Thêm thương hiệu thành công';
            }).catch((error)=>{
                this.show = true;
                this.errors = error.response.data.errors;
                this.message.type = 'error';
                this.message.content = "Thêm thương hiệu thất bại";
            })
            
        },

        isEmpty: function(a = new Array()) {
            if(a.length == 0) {
                return false;
            }
            return true;
        },
        changeDisplay: function() {
            this.display = true;
            this.message = {};
            setTimeout(()=> {
                this.display = false;
            },2000);
        }
    },
}
</script>

<style>
    .brand-create {
        position: absolute;
        width: 94%;
        height: 50rem;
        top: 20rem;
        left: 3%;
        border: 1px solid;
        border-radius: 6px;
        padding: 3rem 3rem;
        color: white;
        font-size: 1.6rem;
    }

    .brand-create input,select {
        width: 70%;
        height: 3.5rem;
        border-radius: 5px;
        font-size: 1.5rem;
    }

    .brand-create label {
        color: #6ab1d69e;
        font-weight: bold;
    }

    .add {
        font-size:1.5rem;
        width: 15% !important;
    }

    strong{
        color: red
    }

</style>