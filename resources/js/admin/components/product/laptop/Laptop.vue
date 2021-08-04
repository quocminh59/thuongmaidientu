<template>
  <div>
      <breadcrumb :links="links"></breadcrumb>
      <div class="title">Danh sách Laptop</div>
      <div class="tool d-flex">
          <select class="form-select"  >
            <option value="">Toàn bộ danh mục</option>      
        </select>
        <div class="addnew">
            <router-link :to="{name: 'laptop.create'}" class="btn btn-dark">
                <i class="fal fa-plus" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Thêm mới laptop"></i>
            </router-link>
        </div>
      </div>
      <div class="laptop template">
          <div v-if="loading">
              <spinner :type="'flicker'" :size="'large'"></spinner>
          </div>
          <div v-else>
              <table class="table table-dark table-bordered">
                  <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sales</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Access time</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Update At </th>
                        <th scope="col" class="local" :style="{textAlign: 'center'}">Manipulation</th>
                  </thead>
                  <tbody>
                        <tr v-for="(item,index) in pageOfItems" :key="'laptop'+index">
                            <td>{{ item.id }}</td>
                            <td><img :src="base + item.feature_image" style="width: 7rem; height:auto"></td>
                            <td>{{ item.name }}</td>
                            <td>{{ showBrand(item.brand_id) }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.sales_percent }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.access_times }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.updated_at }}</td>
                            <laptop-control :id="item.id" style="width: 18rem;"></laptop-control>
                        </tr>
                  </tbody>
              </table>
                <div class="paginate">
                    <jw-pagination 
                        :items="laptops" 
                        :pageSize="3"
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
import LaptopControl from './LaptopControl.vue';
import base from './../../../baseurl';

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
    components: {LaptopControl },
    data() {
        return {
            links: ['Home', 'Product Management', 'Laptop'],
            loading: true,
            customStyles,
            customLabels,
            laptops: [],
            brands:[],
            pageOfItems: [],
            base: base
        }
    },
    created() {
        this.reset();
    },
    methods: {
        onChangePage(pageOfItems) {
            this.pageOfItems = pageOfItems;
        },
        reset: function() {
            axios.get(`${base}/admin/product/1`).then(response=>{
                this.laptops = response.data;
                this.loading = false; 
            });
        },
        showBrand: function($id) {
            axios.get(`${base}/admin/brand`)
            .then((response)=>{
                this.brands=  response.data;
            });
            for (let i = 0; i < this.brands.length; i++) {
                if(this.brands[i].id == $id) {
                    return this.brands[i].brand_name;
                }
            }
        }
    },
}
</script>

<style>

</style>