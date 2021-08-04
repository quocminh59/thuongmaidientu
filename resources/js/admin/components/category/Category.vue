<template>
    <div>
        <breadcrumb :links="links"></breadcrumb>
        <div class="title">Quản lý danh mục</div>
        <div class="tool d-flex">
            <select class="form-select"  v-model="selected">
                <option value="">Toàn bộ danh mục</option>
                <option 
                    v-for="(item, index) in parentCategories"
                    :key="'parentcategory'+index"
                    :value="item.category_id"   
                >
                    {{ item.category_name }}
                </option>            
            </select>
            <div class="addnew">
                <router-link :to="{name: 'category.create'}" class="btn btn-dark">
                    <i class="fal fa-plus" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add new category"></i>
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
                        <th scope="col">Category ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Category Code</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Update At </th>
                        <th scope="col" class="local" :style="{textAlign: 'center'}">Manipulation</th>
                    </thead>
                    <tbody>
                        <tr v-for="item in pageOfItems" :key="item.id">
                            <td>{{ item.category_id }}</td>
                            <td>{{ item.category_name }}</td>
                            <td>{{ item.category_code }}</td>
                            <td>{{ item.slug }}</td>
                            <td>{{ item.status }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.updated_at }}</td>
                            <category-control :id="item.category_id" @reload="reload($event)"></category-control>
                        </tr>  
                    </tbody>
                </table>
                <div class="paginate">
                    <jw-pagination 
                        :items="categories" 
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
import CategoryControl from './CategoryControl.vue';
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
    components: { CategoryControl },
    data() {
        return {
            links: ['Home','Categories Management', 'Category'],
            loading: true,
            categories: null,
            categoriesClone: null,
            subcategories: null,
            pageOfItems: [],
            customLabels,
            customStyles,
            nameRoutes : {
                edit: 'category.edit',
                delete: ''
            },
            selected: '',
        }
    },
    computed: {
        parentCategories: function() {
            if(this.subcategories != null) {
                return this.subcategories.filter(category => category.category_code == 0)
            }
        }
    },
    watch: {
        selected: function() {
            if(this.selected != "") {
                this.categories = this.categoriesClone;
                this.filter();
                this.loading = true;
                setTimeout(()=>{
                    this.loading = false;
                },1000);
            }
            else {
                this.categories = this.categoriesClone;
                this.loading = true;
                setTimeout(()=>{
                    this.loading = false;
                },1000);
            }   
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
            axios.get(`${base}/admin/category`).then(response=>{
                this.categories = response.data;
                this.subcategories = response.data;
                this.categoriesClone = response.data;
                this.loading = false; 
            });
        },
        reload: function($event) {
            this.loading = true;
            setTimeout(()=>{
                this.loading = false;
                this.categories = $event;
            },1000)
        },
        filter: function() {
            axios.get(`${base}/admin/category/recursive/sub/${this.selected}`).then((response)=>{
                this.categories = response.data;
            });
        }
    }
}
</script>

<style>
    .test {
        height: 200px;
    }
</style>