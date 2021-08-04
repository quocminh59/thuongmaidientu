<template>
    <div>
        <div class="select content" @click="show = !show">
            <i class="fal fa-folder" v-if="show == false"></i>
            <i class="fal fa-folder-open" v-else></i>
            <span>Product Management</span>
            <i class="fal fa-chevron-right" v-if="show == false" :style="style"></i>
            <i class="fal fa-chevron-down" v-else :style="style"></i>
            <br>   
        </div>
        <div class="list" v-if="show == true">
            <router-link :to="{name: 'laptop'}" class="content">Laptop</router-link>
            <router-link :to="{name: 'linhkien'}" class="content">Linh kien may tinh</router-link>
            <router-link :to="{name: 'PC'}" class="content">PC</router-link>
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
