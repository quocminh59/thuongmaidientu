<template>
    <div>
        <breadcrumb :links="links"></breadcrumb>
        <div class="title">Chỉnh sửa thương hiệu</div>
        <notification :type="message.type" :content="message.content" :show="display"></notification>
        <div class="category-edit">
            <form @submit.prevent="update">
                <div class="row mb-4 ">
                    <label for="brand_name" class="col-sm-2 col-form-label">Tên thương hiệu</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="brand.brand_name" id="brand_name" class="form-control" >
                    </div>
                    <label class="col-sm-2"></label>
                    <spinner :type="'line-up'" :size="'small'" v-if="loading"></spinner>      
                    <strong class="col-sm-10 ml-80" v-if="isEmpty(errors.category_name)" v-show="show">{{ errors.category_name[0] }}</strong>
                </div>
               
                <div class="row mb-4">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-danger add" value="Cập nhật" @click="changeDisplay()">
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
            links: ['Home','Categories Management', 'Brand', 'Edit'],
            brand: {},
            list_categories: {},
            errors:{},
            show: true,
            message: {
                type:'',
                content:''
            },
            display: null,
            loading: true
        }
    },
    methods: {
        update: function(){
            axios.post(`${base}/admin/brand/update/${this.$route.params.id}`, this.brand)
            .then( () => {
                this.show = false;
                this.message.type = 'success';
                this.message.content = 'Chỉnh sửa danh mục thành công';
                console.log(this.message);
                setTimeout(()=> {
                    this.$router.push({name: 'brand'});
                },1500);
            })
            .catch(error=>{
                this.show = true;
                this.errors = error.response.data.errors;
                this.message.type = 'error';
                this.message.content = "Chỉnh sửa danh mục thất bại";
            })
            
        },
        getDataForm: function() {
            axios.get(`${base}/admin/brand/show/${this.$route.params.id}`).then(response => {
                this.brand = response.data;
                this.loading = false;
            }).catch(error => {
                console.log(error);
            });
        },
        isEmpty: function(a = new Array()) {
            if(a.length == 0) {
                return false;
            }
            return true;
        },
        changeDisplay: function() {
            this.display = true;
            setTimeout(()=> {
                this.message = {};
            },2000);
            setTimeout(()=> {
                this.display = false;
            },2000);
        }

    },   
    created() {
        this.loading = true;
        this.getDataForm();
    }

}
</script>

<style>
    .category-edit {
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

    .category-edit input, select {
        width: 70%;
        height: 3.5rem;
        border-radius: 5px;
        font-size: 1.5rem;
    }

    .category-edit label {
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