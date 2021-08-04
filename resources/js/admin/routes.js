import VueRouter from 'vue-router';


import Dashboard from './components/Dashboard.vue';
import Category from './components/category/Category.vue';
import CategoryCreate from './components/category/CategoryCreate.vue';
import CategoryEdit from './components/category/CategoryEdit.vue';
import Brand from './components/brand/Brand.vue';
import BrandCreate from './components/brand/BrandCreate.vue';
import BrandEdit from './components/brand/BrandEdit';
import Laptop from './components/product/laptop/Laptop.vue';
import LaptopCreate from './components/product/laptop/LaptopCreate.vue';
import LaptopEdit from './components/product/laptop/LaptopEdit.vue';
import Linhkien from './components/product/linhkienmaytinh/Linhkien.vue';
import PC from './components/product/PC/PC.vue';

const routes = [
    {
        path:  '/',
        component: Dashboard,
        name: 'home',
    },
    {
        path: '/test',
        component:Dashboard,
        name: 'test',
    },
    {
        path:  '/categories',
        component: Category,
        name: 'category',
    },
    {
        path:'/categories/create',
        component: CategoryCreate,
        name: 'category.create'
    },
    {
        path: '/categories/edit/:id',
        component: CategoryEdit,
        name: 'category.edit'
    },
    {
        path: '/brands',
        component: Brand,
        name: 'brand'
    },
    {
        path: '/brands/create',
        component: BrandCreate,
        name: 'brand.create'
    },
    {
        path: '/brands/edit/:id',
        component: BrandEdit,
        name: 'brand.edit'
    },
    {
        path: '/products/laptop',
        component: Laptop,
        name: 'laptop'
    },
    {
        path: '/products/laptop/create',
        component: LaptopCreate,
        name: 'laptop.create'
    },
    {
        path: '/products/laptop/edit/:id',
        component: LaptopEdit,
        name: 'laptop.edit'
    },
    {
        path: '/products/linhkien',
        component: Linhkien,
        name: 'linhkien'
    },
    {
        path: '/products/PC',
        component: PC,
        name: 'PC'
    }
   
];

const router = new VueRouter({
    base: '/qmcomputer/public/administrator',
    mode: 'history',
    routes: routes,
});

export default router;