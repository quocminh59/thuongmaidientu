<template>
    <div class="sidebar">
        <div class="sidebar-head">
            <router-link :to="{name: 'home'}">QUOCMINH-PC</router-link>
        </div>
        <simplebar class="component" data-simplebar-auto-hide="true">
            <router-link to="" class="content" :style="{background: '#2F3A4D'}">
                <i class="fal fa-home"></i>
                <span>Dashboard</span>
            </router-link>

            <div class="separate">COMPONENTS</div>
                
            <category-route></category-route>
            <product-route></product-route>
        
        </simplebar>
        
        
    </div>
</template>

<script>
import Category from '../components/category/Category.vue'
import CategoryRoute from '../route-components/CategoryRoute.vue'
import ProductRoute from '../route-components/ProductRoute.vue'

export default {
  components: { Category, CategoryRoute, ProductRoute },
    
}
</script>,
    ProductRoute

<style>
@import url('https://fonts.googleapis.com/css2?family=Oxanium:wght@500&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    .sidebar {
        width: 18%;
        height: 100%;
        background-color:#3C4B64;
        position: fixed;
    }

    .sidebar-head {
        height: 9%;
        background-color:#263043;
        display: flex;
        justify-content:center;
        align-items:center;
    }
    .sidebar-head a {
        font-family: 'Oxanium', cursive;
        font-size: 3rem;
        color:white;
        text-decoration: none;
    }

    .component {
        height:91%;
    }

    .simplebar-scrollbar::before {
        background:#aaa;
        width: 0.5rem;
    }

    .simplebar-track.simplebar-vertical {
        right: -1px;
        width: 8px;
    }

    .content {
        width: 100%;
        height: 5rem;
        position: relative;
        display: flex;
        align-items: center;
        padding: 2rem;
        color: white;
        font-size: 1.5rem;
        font-family: 'Titillium Web', sans-serif;
        cursor: pointer;
    }

    a.content {
        text-decoration: none;
    }

    a.content:hover {
        color: white;
        background-color: red;
    }

    .content span {
        margin-left: 1.5rem;
    }

    .separate {
        width: 100%;
        height: 6rem;
        font-family: 'Lato', sans-serif;
        font-size: 1.3rem;
        color: darkgray;
        font-weight: 600;
        display: flex;
        align-items: center;
        padding: 2rem;
    }

    .list a {
        padding-left: 5.9rem;
    }

    

</style>