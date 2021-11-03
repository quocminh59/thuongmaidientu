<template>
    <div>
        <div class="select content" @click="show = !show">
            <i class="fal fa-folder" v-if="show == false"></i>
            <i class="fal fa-folder-open" v-else></i>
            <span>Catagories Management</span>
            <i class="fal fa-chevron-right" v-if="show == false" :style="style"></i>
            <i class="fal fa-chevron-down" v-else :style="style"></i>
            <br>   
        </div>
        <div class="list" v-if="show == true">
            <router-link :to="{name: 'category'}" class="content">Category</router-link>
            <router-link :to="{name: 'brand'}" class="content">Brand</router-link>
        </div>  
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            style: {
                position: 'absolute',
                right: '1rem'
            }
        };
    },
}
</script>
