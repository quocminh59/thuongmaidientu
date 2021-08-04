<template>
    <div>
        <breadcrumb :links="links"></breadcrumb>
        <div class="title">Quản lý danh sách thương hiệu</div>
        <div class="tool d-flex">
            <div class="addnew">
                <router-link :to="{name: 'brand.create'}" class="btn btn-dark">
                    <i class="fal fa-add" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add new category"></i>
                </router-link>
            </div>
        </div>
        <div class="category template">
            <div v-if="loading">
                <spinner :type="'flicker'" :size="'large'"></spinner>
            </div>
            <div v-else>
                <table class="table table-dark table-bordered">
                    <thead>
                        <th scope="col">Brand ID</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Slug</th>   
                        <th scope="col">Created At</th>
                        <th scope="col">Update At </th>
                        <th scope="col" class="local" :style="{textAlign: 'center'}">Manipulation</th>
                    </thead>
                    <tbody>
                        <tr v-for="item in pageOfItems" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.brand_name }}</td>
                            <td>{{ item.slug }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.updated_at }}</td>
                            <brand-control :id="item.id" @reload="reload($event)"></brand-control>
                        </tr>
                    </tbody>
                </table>
                <div class="paginate">
                    <jw-pagination 
                        :items="brands" 
                        :pageSize="8"
                        :labels="customLabels"
                        :styles="customStyles" 
                        @changePage="onChangePage">
                    </jw-pagination>
                </div>
            </div>       
        </div>
    </div>
</template>

<script>
import BrandControl from './BrandControl.vue';
import base from './../../baseurl';

const customLabels = {
    first: '<<',
    last: '>>',
    previous: '<',
    next: '>'
};

const customStyles = {
    a: {
        color: 'white',
        background: '#222526',
    }
};

export default {
    components: {
      BrandControl
    },
    data() {
        return {
            links: ['Home','Categories Management', 'Brand'],
            loading: true,
            pageOfItems: [],
            brands: null,
            customLabels,
            customStyles,
        }
    },
    created () {
        this.reset();
    },
    methods: {
        onChangePage(pageOfItems) {
            this.pageOfItems = pageOfItems;
        },
        reset: function() {
            axios.get(`${base}/admin/brand`).then(response=>{
                this.brands = response.data;
                this.loading = false; 
                
            });
        },
        reload: function($event) {
            this.loading = true;
            setTimeout(()=>{
                this.loading = false;
                this.brands = $event;
            },1000)
        }
    },
}
</script>

<style>
    .addnew {
        margin-left: 0;
    }
</style>